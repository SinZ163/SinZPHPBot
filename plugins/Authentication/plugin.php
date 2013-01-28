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
        $this->bot->send_message("", "WHOIS", $args[0]);
    }
	public function network_330($prefix, $command, $args) {
		$this->bot->privmsg($this->chan, $args[1]." is authenticated via nickserv.");
	}
}	