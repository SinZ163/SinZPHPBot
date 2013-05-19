<?php

class Authentication {

    private $bot = null;
    private $chan = null;

    public function Authentication($config) {
        $this->config = $config;
    }

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
	public function command_hasNSAuth($user, $channel, $args) {
        $this->chan = $channel;
        $this->bot->privmsg("NickServ", "ACC ".$args[0]);
    }
	public function network_NOTICE($prefix, $command, $args) {
        $message = explode(" ", $args[1]);
        if ($message[1] == "ACC") {
            if ($message[2] == 3) {
                $this->auth[$message[0]] = true;
            }
        }
        
        if ($this->auth[$message[0]] == true) {
            $this->bot->privmsg($this->chan, $message[0]. " has authed via NickServ");
        }
	}
}	