<?php

/**
 * Bot
 *
 * The main file.
 *
 * @author		ylt, SinZ, clone1018
 * @version             2.0
 */
class Bot {

    private $sock = null;

    public function _construct($config) {
        
    }

    function __autoload($class) {
        include $class . '.php';
    }

    /*
     * Init Function
     * 
     * @returns void
     */

    public function init() {
        global $config;
        $this->plugin = new Plugin();
        $this->plugin->register(new Core($this->config));
        $this->plugin->register(new CTCP($this->config));
        $this->plugin->register(new Colors($this->config));

        /*
         * foreach ($this->config['plugins'] as $plugin) {
         * include "../plugins/$plugin/plugin.php";
         *      $plugin->register(new $plugin($this->config));
         *  }
         * 
         */
        if (count($config['plugins']) == 0) {
            echo "Loading 0 plugins. \n";
        } elseif (count($config['plugins']) == 1) {
            include "./plugins/" . $config['plugins'][0] . "/plugin.php";
            $this->plugin->register(new $config['plugins'][0]($this->config));
            echo "Loading " . count($config['plugins']) . " plugins.\n";
        } else {
            foreach ($config['plugins'] as $plugin) {
                include "./plugins/" . $plugin . "/plugin.php";
                $this->plugin->register(new $plugin($this->config));
                $count++;
            }
            echo "Loading " . $count . " plugins.\n";
        }
    }

    /*
     * Startup Functions
     * 
     * Commands to run after bot is connected to network.
     * 
     * @return bool
     */

    public function startup() {
        global $config;
        if ($config['ns_enabled'])
            $this->raw("PRIVMSG " . $config['ns_nickserv'] . " IDENTIFY " . $config['ns_pass']);
        if ($config['channels']) {
            foreach ($config['channels'] as $channel) {
                $this->raw("JOIN " . $channel);
            }
        }
        if ($config['startup']) {
            foreach ($config['startup'] as $cmd) {
                $this->raw($cmd);
            }
        }
    }

    /*
     * RAW
     * 
     * Sends RAW messages to the server
     * 
     * @return void
     */

    public function raw() {
        $this->colors = new Colors();
        $args = func_get_args();
        $out = array();
        if ($prefix) {
            $out[] = ":{$prefix}";
        }
        $cont = false;
        foreach ($args as $index => $arg) {
            if (strpos($arg, " ") !== true) {
                $out[] = $arg;
            } else {
                $cont = true;
                break;
            }
        }
        if ($cont) {
            $out[] = ':' . implode(" ", array_splice($args, $index));
        }
        $this->buffer .= implode(" ", $out) . "\n";
        echo $this->colors->getColoredString("RAW: ", "blue");
        echo implode(" ", $out) . "\n";
    }

    /*
     * Parse Message
     * 
     * Converts the message to .class function args
     */
    private function parse_message($line) {
        $line = explode(" ",$line);   
        return $line;
    }

    public function connect() {
        global $config;
        $this->colors = new Colors();
        echo $this->colors->getColoredString("Connecting to " . $config['network'] . " on port " . $config['port'] . "\n", "red");
        $this->sock = fsockopen($config['network'], $config['port'], $errno, $errstr, 32768);
        stream_set_timeout($this->sock, 2);
        $errorlevel = stream_get_meta_data($this->sock);

        $this->send_message("", "NICK", $config['nick']);
        $this->send_message("", "USER", $config['ident'], "8", "*", $config['realname']);
        if ($errorinfo['timed_out']) {
            echo 'Connection timed out!';
        }
        $this->startup();
    }

    public function send_message($prefix) {
        $args = func_get_args();
        $out = array();
        if ($prefix) {
            $out[] = ":{$prefix}";
        }
        $cont = false;
        foreach ($args as $index => $arg) {
            if (strpos($arg, " ") !== true) {
                $out[] = $arg;
            } else {
                $cont = true;
                break;
            }
        }
        if ($cont) {
            $out[] = ':' . implode(" ", array_splice($args, $index));
        }
        $this->buffer .= implode(" ", $out) . "\n";
        echo "sent: " . implode(" ", $out) . "\n";
    }

    public function flush_message() {
        if (strlen($this->buffer) > 0) {
            fwrite($this->sock, $this->buffer);
            $this->buffer = "";
        }
    }

    public function privmsg($who, $msg) {
        $this->raw("PRIVMSG" . $who . ":" . $msg);
    }

    public function start() {
        $this->plugin = new Plugin();
        $this->colors = new Colors();
        if (!$this->sock) {
            $this->connect();
        }
        while (!feof($this->sock)) {
            $line = fgets($this->sock);
            list($prefix, $plugin, $command, $args) = $this->parse_message($line);
            //echo "prefix: {$prefix}, args: ",json_encode($args),"\n";
            echo json_encode(array($prefix, $command, $args)), "\n";
            if ($command == "PING") {
                $this->raw("PONG " . $args[0]);
            }
            $this->plugin->event($prefix, $plugin, $command, $args);
            //echo $prefix.$command.$args;
            $this->flush_message();
        }
    }

}

