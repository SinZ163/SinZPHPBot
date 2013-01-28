<?php

class CTCP {

    private $bot = null;

    public function CTCP($config) {
        $this->config = $config;
    }
    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
    
    public function network_PRIVMSG($prefix, $command, $args) {
        $channel = $args[0];
        $message = $args[1];
        if ($message[0][0] == chr(1)) {
            
        }
    }
}