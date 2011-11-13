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
            $this->bot->privmsg($this->config['ns_nickserv'], $ns_msg);
        }
    }
	
	/*START SASL*/
	public function network_CAP($prefix, $command, $args) {
		$this->bot->send_message("", "AUTHENTICATE", "PLAIN");
	}
	public function network_AUTHENTICATE($prefix, $command, $args) {
		if ($this->config["ns_user"] != true) {
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
        $name = user::implodeIP($prefix);
        if ($message[0][0] == $this->config['command']) { //command
            //args: user, channel, arguments
            $this->bot->plugin_event("command_" . substr($message[0], 1), $prefix, $args[0], array_splice($message, 1));}
        /*elseif ($message[0][0] == $this->config['notes_prefix']) { //notes prefix
            //args: user, channel, arguments
            $this->bot->plugin_event("readNote"), substr($message[0], 1), substr($message[0], 1), $prefix, $args[0], array_splice($message, 1));} */
		elseif ($message[0][0] == $this->config['faq_prefix'] && $this->config['faq_enabled'] == true) {
			$this->bot->plugin_event("faq", array_splice($message, 1));
		}
        elseif ($name[0] == $this->config['craftirc'] && $this->config['craftirc_enabled']) {
            $user = $message[0];
            $parameters = array_splice($message, 1);
            $this->bot->plugin_event("command_" . substr($message[0], 1), $user, $args[0], array_splice($parameters, 1));
            
        }
        else {
            //cba
            //$this->bot->plugin_event("message);
        }
    }

}

?>
