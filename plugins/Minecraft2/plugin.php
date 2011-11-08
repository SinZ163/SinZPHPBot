<?php
class Minecraft2 {

    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
        include("ping.php");
        $this->mcping = new mcping;
    }
    public function command_paid($user, $channel, $args) {
        if (!(user::IPhasPermission("plugin.minecraft.paid", $user))) {
            $this->bot->say_notice($user, "You dont have permission to use this command.");
        } else {
            $url = file_get_contents("http://www.minecraft.net/haspaid.jsp?user=" . urlencode($args[0]));

            if ($url == "true") {
                $this->bot->privmsg($channel, $args[0] . " has paid for Minecraft, I'll give him a hug some other time!");
            } else {
                $this->bot->privmsg($channel, $args[0] . " hasn't paid for Minecraft!, That bastard!");
            }
        }
    }

    public function command_id($user, $channel, $args) {
        require_once("Blocks.php");
        if ($args[1]) {
            $block = implode('', $args);
        } else {
            $block = $args[0];
        }
        $result = Blocks::GetID($block);
        echo $result;
		if ($result) {
			$this->bot->privmsg($channel, "The ID for " . $block . " is " . $result . ".");
		}
		else {
			$this->bot->privmsg($channel, "Either you typed it wrong, or it doesn't exist (Or we haven't added that name yet)");
		}
    }
    
    public function command_mcmotd($user, $channel, $args) {
        $port = $args[1];
        $info = $this->mcping->ping($ip, $port);
        $motd = $srvinfo["motd"];
        $this->bot->privmsg($channel, "The MOTD for ".$ip." is ".$motd);
    }
    
    public function command_mcping($user, $channel, $args) {
        // ip check
        foreach ($args[0] as $letter) {
            if ($letter == ":") {
                $q = true;
            }
        }
        if ($q) {
            $address = explode(":", $args[0]);
            $ip = $address[0];
            $port = $address[1];
        }
        else $ip = $args[0];
        // port check
        if ($args[1] && $port == false) {
            $port = $args[1];
        }
        elseif ($port == false) {
            $port = 25565;
        }
        // actual script
        $srvinfo = $this->mcping->ping($ip, $port);
        if ($srvinfo) {
        	$motd = $srvinfo['motd'];
        	$players = $srvinfo["players"];
        	$max_players = $srvinfo["max_players"];
            $bold = chr(2);
            $reds = chr(3) . "05";
            $rede = chr(3);
        	$this->bot->privmsg($channel, $motd. $bold." (".$bold.$reds.$players.$rede.$bold."/".$bold.$reds.$max_players.$rede.$bold.")".$bold);
        }
        else $this->bot->privmsg($channel, "Cannot connect to ".$ip.":".$port);
    }
    
    public function command_mcplayers($user, $channel, $args) {
        $ip = $args[0];
	$port = $args[1];
        $srvinfo = $this->mcping->ping($ip, $port);
        $players = $srvinfo["players"];
        $max_players = $srvinfo["max_players"];
        $this->bot->privmsg($channel, "Their is currently ".$players."/".$max_players." on ".$ip);
    }
}

?>