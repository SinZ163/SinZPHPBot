<?php

class core {

    private $bot = null;

    public function core($config) {
        $this->config = $config;
    }

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

	/*START SASL*/
	public function network_CAP($prefix, $command, $args) {
		$this->bot->send_message("", "AUTHENTICATE", "PLAIN");
	}
	public function network_AUTHENTICATE($prefix, $command, $args) {
		if ($this->config["ns_user"] == "") {
			$nick = $this->config["nick"];
		}
		else $nick = $this->config["ns_user"];
		$base_64 = base64_encode($nick."\0".$nick."\0".$this->config["ns_pass"]);
		$this->bot->send_message("", "AUTHENTICATE", $base_64);
	}
	public function network_903($prefix, $command, $args) {
		$this->bot->send_message("", "CAP", "END");
	}
	/*END SASL*/
	
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
            //$this->bot->plugin_event("message");
        }
    }
    
    //END MOTD
    public function network_376($prefix, $command, $args) {
    	foreach ($this->config['channels'] as $chan) {
			$this->bot->send_message("", "JOIN", $chan);
		}
		if ($this->config['ns_enabled']) {
			$ns_msg = "IDENTIFY " . $this->config['ns_pass'];
			$this->bot->privmsg($this->config['ns_nickserv'], $ns_msg);
		} 
    }

}

?>
