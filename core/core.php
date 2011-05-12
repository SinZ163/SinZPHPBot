<?php
class core {
	private $bot = null;
	public function plugin_registered($bot) {
		$this->bot = $bot;
	}
	public function network_ping($prefix, $command, $args) {
		$this->bot->send_message("","PONG", $args[0]);
	}
	public function network_privmsg($prefix, $command, $args) {
		$message = explode(" ",$args[1]);
		if ($message[0][0] == "`") { //command
			//args: user, channel, arguments
			$this->bot->plugin_event("command_".substr($message[0],1), $prefix, $args[0], array_splice($message,1));
		}
		else {
			//cba
			//$this->bot->plugin_event("message);
		}
	}
}
?>
