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
        $ctcp = explode(chr(1), $message);
        $type = explode(" ", $ctcp[1]);
        $this->bot->plugin_event("ctcp_".$type[0], $prefix, array_splice($type, 1));
    }
    
    public function ctcp_VERSION($user) {
        $hostmark = $this->bot->user->explodeIP($user);
        $this->bot->notice($hostmark[0], chr(1)."VERSION SinZBot".chr(1));
    }
    
    public function ctcp_PING($user, $args) {
        $hostmark = $this->bot->user->explodeIP($user);
        $this->bot->notice($hostmark[0], chr(1)."PING ".implode(" ", $args).chr(1));
    }
}