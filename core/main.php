<?php

class bot {
	private $server = "";
	private $port = 0;
	private $user = "";
	private $realname = "";
	public function ylt_bot($server, $port, $nick, $user, $realname, $startchan) {
		
		$this->server = $server;
		$this->port = $port;
		$this->nick = $nick;
		$this->user = $user;
		$this->realname = $realname;
		$this->startchan = $startchan;
	}
	private $modules = array();
	public function plugin_register($class) {
		$this->modules[] = $class;
		$class->plugin_registered($this);
	}
	public function plugin_event($name) {
		$name = strtolower($name);
		
		$args = func_get_args();
		$args = array_splice($args,1);
		foreach($this->modules as $module) {
			if (method_exists($module, $name)) {
				call_user_func_array(array($module,$name), $args);
			}
		}
	}
	private function parse_message($line) {
		$line = explode(" ",trim($line));
		$cont = false;
		
		$prefix = "";
		$command = "";
		$args = array();

		foreach($line as $index => $arg) {
			if ($arg[0] == ":") {
				if ($index == 0) { $prefix = substr($arg,1); }
				else { $cont = true; break; }
			}
			elseif ($command == "") {
				$command = $arg;
			}
			else {
				$args[] = $arg;
			}
		}
		if ($cont) {
			$line = array_splice($line,$index);
			$args[] = substr(implode(" ",$line),1);
		}
		//usable results: list($prefix, $args)
		return array($prefix,$command,$args);
	}
	private $sock = null;
	public function connect() {
		$this->sock = fsockopen($this->server, $this->port, $errno, $errstr, 32767);
		
		$this->send_message("","NICK", $this->nick);
		$this->send_message("","USER", $this->user,"8","*",$this->realname);
		$this->send_message("","JOIN", $this->startchan);
		//$this->send_message("","PRIVMSG", "#bottest", "FUCK YOU!");
	}
	private $buffer = "";
	public function send_message($prefix) {
		$args = func_get_args();
		$out = array();
		if ($prefix) { $out[] = ":{$prefix}"; }
		$cont = false;
		foreach($args as $index => $arg) {
			if (strpos($arg, " ") !== true) { $out[] = $arg; }
			else { $cont = true; break; }
		}
		if ($cont) {
			$out[] = ':'.implode(" ",array_splice($args, $index));
		}
		$this->buffer .= implode(" ",$out)."\n";
		echo "sent: ".implode(" ",$out)."\n";
	}
	public function flush_message() {
		if(strlen($this->buffer) > 0) {
			fwrite($this->sock, $this->buffer);
			$this->buffer = "";
		}
	}
	public function say_message($who, $msg) {
		$this->send_message("","PRIVMSG", $who, ":".$msg);
	}
	public function start() {
		if (!$this->sock) { $this->connect(); }
		while ($line = fgets($this->sock)) {
			list($prefix,$command,$args) = $this->parse_message($line);
			//echo "prefix: {$prefix}, args: ",json_encode($args),"\n";
			echo json_encode(array($prefix,$command,$args)),"\n";
			$this->plugin_event("network_{$command}", $prefix, $command, $args);
			$this->flush_message();
		}
	}
}

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
		if ($message[0][0] == ".") { //command
			//args: user, channel, arguments
			$this->bot->plugin_event("command_".substr($message[0],1), $prefix, $args[0], array_splice($message,1));
		}
		else {
			//cba
			//$this->bot->plugin_event("message);
		}
	}
}
class command {
	private $bot = null;
	public function plugin_registered($bot) {
		$this->bot = $bot;
	}
	public function command_debug($user, $channel, $args) {
		$this->bot->say_message($channel, json_encode(array($user, $channel, $args)));
	}
	public function command_rickroll($user, $channel, $args) {
		if ($this->user->isadmin($args[0])) {
			$this->bot->say_message($channel, "Dont rickroll my master, BITCH");
		}
		else {
			$this->bot->say_message($args[0], "Never going to Give you up, Never going to Let you down, never going to run android and, desert you!");
			$this->bot->say_message($channel, $args[0]." Just got rickrolled!");
		}
	}
	public function command_join($user, $channel, $args) {
		$this->bot->send_message("","JOIN", $args[0]);
	}
	public function command_part($user, $channel, $args) {
		$this->bot->send_message("","PART", $args[0]);
	}
	public function command_op($user, $channel, $args) {
		$this->bot->send_message("","MODE +o", $args[0]);
	}
	public function command_voice($user, $channel, $args) {
		$this->bot->send_message("","MODE +v", $args[0]);
	}
	public function command_say($user, $channel, $args) {
		$echo = implode(" ",$args);
		$this->bot->say_message($channel, $echo);
	}
	public function command_calc($user, $channel, $args) {
		$calc = implode(" ",$args);
		$data = file_get_contents("http://www.google.com/ig/calculator?hl=en&q=".urlencode($calc));
		$data = preg_replace("/([,{])(.*?):/", '$1"$2":', $data); //hack, convert js to json.
		$data = stripcslashes($data);
		$data = preg_replace("/<sup>(.*?)<\/sup>/", '^$1', $data);
		$data = json_decode($data,1);
		foreach ($data as &$node) { $node = html_entity_decode($node); }
		$this->bot->say_message($channel, $data["lhs"]." = ".$data["rhs"]);	
	}
	public function command_rss($user, $channel, $args) {
		require_once("/plugins/sinz/rss/plugin.php");
		$rssarray = SinZ_RSS($args[0], $channel);
		foreach($rssarray as $rss) {
			$msg = $msg.$rss['title'].' || ';
		}
		$this->bot->say_message($channel, $msg);
		
	}
	public function command_title($user, $channel, $args) {
		$url = $args[0];
		$str = file_get_contents($url);
		$pattern = "/<title ?.*>(.*)<\/title>/";
		preg_match($pattern, $str, $txt);
		$this->bot->say_message($channel, $txt[1]." (".$args[0].")");
	}
	public function command_eval($user, $channel, $args) {
		$this->bot->say_message($channel, eval("return ".substr($message,5)));
	}
	public function command_countdown($user, $channel, $args) {
		require_once("countdown.php");
		$this->bot->say_message($channel, countdown($args[4], $args[3], $args[2], $args[1], $args[0]));
	}
	public function command_reload($user, $channels, $args) {
		if($this->user->isAdmin($args[0])) {
			// Figure out how to reload	
		}
	}
}