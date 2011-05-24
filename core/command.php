<?php
class command {
	private $bot = null;
	public function plugin_registered($bot) {
		$this->bot = $bot;
	}
	public function command_debug($user, $channel, $args) {
		$this->bot->say_message($channel, json_encode(array($user, $channel, $args)));
	}
	public function command_rickroll($user, $channel, $args) {
		if ($this->bot->isadmin($args[0]) == true) {
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
		//foreach ($data as &$node) { $node = html_entity_decode($node); }
		$this->bot->say_message($channel, $data["lhs"]." = ".$data["rhs"]);	
		$this->bot->say_message($channel, json_encode(array($data[error], $data[icc], $calc)));
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
		$message = implode(" ", $args);
		$this->bot->say_message($channel, eval("return ".substr($message,0)));
	}
	public function command_countdown($user, $channel, $args) {
		require_once("countdown.php");
		$this->bot->say_message($channel, countdown($args[4], $args[3], $args[2], $args[1], $args[0]));
	}
		public function command_playerlist($user, $channel, $args) {
		require_once("/plugins/sinz/Minecraft/Minequery.php");
		if ($args[0] == "") {
			$url = "MCSteamed.net";
		}
		else $url = $args[0];
		if ($args[1] == "") {
			$port = 25566;
		}
		else $port = $args[1];
		$array = Minequery::query($url, $port, $timeout = 30);
		$char = chr(2);
		$msg = implode($char." || ".$char, $array["playerList"]);
		$this->bot->say_message($channel, $msg);
	}
	public function command_online($user, $channel, $args) {
		require_once("/plugins/sinz/Minecraft/Minequery.php");
		if ($args[0] == "") {
			$url = "MCSteamed.net";
		}
		else $url = $args[0];
		if ($args[1] == "") {
			$port = 25566;
		}
		else $port = $args[1];
		$array = Minequery::query($url, $port, $timeout = 30);
		$char = chr(3);
		$onlineplayers = $array['playerCount'];
		$maxplayers = $array['maxPlayers'];
		$maxplayers = preg_replace("/Char/", '', $maxplayers);
		$this->bot->say_message($channel, "There are currently".$char."21 ".$onlineplayers."".$char." of".$char."21 ".$maxplayers."".$char." players on ".$url." right now.");
	}
	public function command_paid($user, $channel, $args) {
		$url = file("http://www.minecraft.net/haspaid.jsp?user=".urlencode($args[0]));
		echo ("|".$url[3]."|");
		$this->bot->say_message($channel, $args[0]."'s paid status for Minecraft is: ".$url[3]);
		if ($url[3] == "false") { $this->bot->say_message($channel, $args[0]." hasn't paid for Minecraft!, That bastard!"); }
		elseif ($url[3] == "turn") { $this->bot->say_message($channel, $args[0]." hasn paid for Minecraft!, I r give him hugz later!"); }
	}
	public function command_port($user, $channel, $args) {
		$fp = fsockopen($args[0],$args[1],$errno,$errstr,10);
		if(!$fp) { $msg = "Cannot connect to server"; }
		else {
			$msg = "Connect was successful - no errors on Port ".$args[1]." at ".$args[0];
			fclose($fp);
		}
		$this->bot->say_message($channel, $msg);
	}
	public function command_google($user, $channel, $args) {
		require_once("/plugins/sinz/google_search/plugin.php");
		$this->bot->say_message($channel, sinz_google_search($args));
	}
	/*public function command_reload($user, $channels, $args) {
		if($this->user->isAdmin($args[0])) {
			// Figure out how to reload	
		}
	}*/
}