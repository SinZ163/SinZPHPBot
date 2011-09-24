<?php

class bot {

    public function bot($server, $port, $nick, $user, $realname) {

        $this->server = $server;
        $this->port = $port;
        $this->nick = $nick;
        $this->user = $user;
        $this->realname = $realname;
    }

    private $modules = array();

    public function plugin_register($class) {
        $this->modules[] = $class;
        $class->plugin_registered($this);
    }

    public function plugin_event($name) {
        $name = strtolower($name);

        $args = func_get_args();
        $args = array_splice($args, 1);
        foreach ($this->modules as $module) {
            if (method_exists($module, $name)) {
                call_user_func_array(array($module, $name), $args);
            }
        }
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
        $this->sock = fsockopen($this->server, $this->port, $errno, $errstr, 32768);
        stream_set_timeout($this->sock, 2);
        $errorlevel = stream_get_meta_data($this->sock);

        $this->send_message("", "NICK", $this->nick);
        $this->send_message("", "USER", $this->user, "8", "*", $this->realname);
        if ($errorinfo['timed_out']) {
            echo 'Connection timed out!';
        }
        //$this->send_message("","PRIVMSG", "#bottest", "FUCK YOU!");
    }

    private $buffer = "";

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
        $this->send_message("", "PRIVMSG ", $who, ":" . $msg);
    }
    public function notice($who, $msg) {
        $this->send_message("", "NOTICE" , $who, ":" . $msg);
    }

    public function start() {
        if (!$this->sock) {
            $this->connect();
        }
        while (!feof($this->sock)) {
            $line = fgets($this->sock);
            list($prefix, $command, $args) = $this->parse_message($line);
            //echo "prefix: {$prefix}, args: ",json_encode($args),"\n";
            echo json_encode(array($prefix, $command, $args)), "\n";
            $this->plugin_event("network_{$command}", $prefix, $command, $args);
            $this->flush_message();
        }
    }

    public function __autoload($class) {
        include "plugins/" . $class . '/plugin.php';
        $this->plugin_register(new $class());
    }

}

