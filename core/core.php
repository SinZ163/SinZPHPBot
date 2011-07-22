<?php

class core {

    private $bot = null;

    public function core($config) {
        $this->config = $config;
    }

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function network_MODE($prefix, $command, $args) {

        foreach ($this->config['channels'] as $chan) {
            $this->bot->send_message("", "JOIN", $chan);
        }
        if ($this->config['ns_enabled']) {
            $ns_msg = "IDENTIFY " . $this->config['ns_pass'];
            echo $ns_msg;
            $this->bot->say_message($this->config['ns_nickserv'], $ns_msg);
        }
        foreach ($this->config['startup'] as $cmd) {
            $this->bot->send_message("", $cmd);
        }
    }

    public function network_ping($prefix, $command, $args) {
        $this->bot->send_message("", "PONG", $args[0]);
    }

    public function network_privmsg($prefix, $command, $args) {
        $message = explode(" ", $args[1]);
        if ($message[0][0] == $this->config['command']) { //command
            //args: user, channel, arguments
            $this->bot->plugin_event("command_" . substr($message[0], 1), $prefix, $args[0], array_splice($message, 1));
        } else {
            //cba
            //$this->bot->plugin_event("message);
        }
    }

}

?>
