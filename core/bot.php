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

    public function _construct($config) {
        include('../config.php');
        $this->config = $config;
    }

    function __autoload($class) {
        include './'.$class.'.php';
    }

    /*
     * Init Function
     * 
     * @returns void
     */

    public function init() {
        $plugin = new Plugin();
        $plugin->register(new core($this->config));
        $plugin->register(new core($this->config));
        $plugin->register(new core($this->config));
        $plugin->register(new core($this->config));

        /*
         * foreach ($this->config['plugins'] as $plugin) {
         * include "../plugins/$plugin/plugin.php";
         *      $plugin->register(new $plugin($this->config));
         *  }
         * 
         */
            
    }

    private function parse_message($line) {
        $line = explode(" ", trim($line));
        $cont = false;

        $prefix = "";
        $command = "";
        $args = array();

        foreach ($line as $index => $arg) {
            if ($arg[0] == ":") {
                if ($index == 0) {
                    $prefix = substr($arg, 1);
                } else {
                    $cont = true;
                    break;
                }
            } elseif ($command == "") {
                $command = $arg;
            } else {
                $args[] = $arg;
            }
        }
        if ($cont) {
            $line = array_splice($line, $index);
            $args[] = substr(implode(" ", $line), 1);
        }
        //usable results: list($prefix, $args)
        return array($prefix, $command, $args);
    }

    private $sock = null;

    public function connect() {
        $this->sock = fsockopen('pandora.cwictech.net', 3306, $errno, $errstr, 32768);
        stream_set_timeout($this->sock, 2);
        $errorlevel = stream_get_meta_data($this->sock);

        $this->send_message("", "NICK", $this->config['nick']);
        $this->send_message("", "USER", $this->config['user'], "8", "*", $this->config['realname']);
        if ($errorinfo['timed_out']) {
            echo 'Connection timed out!';
        }
        //$this->send_message("","PRIVMSG", "#bottest", "FUCK YOU!");
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

    public function say_message($who, $msg) {
        $this->send_message("", "PRIVMSG", $who, ":" . $msg);
    }

    public function start() {
        $plugin = new Plugin();
        if (!$this->sock) {
            $this->connect();
        }
        /* This is where the magic happens */
        while (!feof($this->sock)) {
            $line = fgets($this->sock);
            list($prefix, $command, $args) = $this->parse_message($line);
            //echo "prefix: {$prefix}, args: ",json_encode($args),"\n";
            echo json_encode(array($prefix, $command, $args)), "\n";
            $plugin->event("network_{$command}", $prefix, $command, $args);
            $this->flush_message();
        }
    }

}

