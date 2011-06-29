<?php
class minecraft {
	private $bot = null;
    public function plugin_registered($bot) {
	$this->bot = $bot;
    }
	public function command_online($user, $channel, $args) {
		if (!(user::IPhasPermission("plugin.minecraft.paid", $user))) {
			$this->bot->say_notice($user, "You dont have permission to use this command.");
		}
		else {
			require_once("/plugins/Minecraft/Minequery.php");
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
	}
	public function command_paid($user, $channel, $args) {
		if (!(user::IPhasPermission("plugin.minecraft.paid", $user))) {
			$this->bot->say_notice($user, "You dont have permission to use this command.");
		}
		else {
			$url = file("http://www.minecraft.net/haspaid.jsp?user=".urlencode($args[0]));
			echo ("|".$url[3]."|");
			$this->bot->say_message($channel, $args[0]."'s paid status for Minecraft is: ".$url[3]);
			if ($url[3] == "false") { $this->bot->say_message($channel, $args[0]." hasn't paid for Minecraft!, That bastard!"); }
			elseif ($url[3] == "true") { $this->bot->say_message($channel, $args[0]." has paid for Minecraft!, I'll give him a hug some other time!"); }
		}
	}
	public function command_playerlist($user, $channel, $args) {
		if (!(user::IPhasPermission("plugin.minecraft.playerlist"))) {
			$this->bot->say_notice($user, "You dont have permission to use this command.");
		}
		else {
			require_once("/plugins/Minecraft/Minequery.php");
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
	}
	public function command_id($user, $channel, $args) {
		require_once("/plugins/Minecraft/Blocks.php");
		$result = Blocks::GetID($args[0]);
		echo $result;
		$this->bot->say_message($channel, "The ID for ".$args[0]." is ".$result.".");
	}
}
?>