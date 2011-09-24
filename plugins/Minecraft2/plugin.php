<?php

class Minecraft2 {

    private $bot = null;

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function command_paid($user, $channel, $args) {
        if (!(user::IPhasPermission("plugin.minecraft.paid", $user))) {
            $this->bot->say_notice($user, "You dont have permission to use this command.");
        } else {
            $url = file("http://www.minecraft.net/haspaid.jsp?user=" . urlencode($args[0]));

            if ($url[3]) {
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
    
    public function command_mcping($user, $channel, $args) {
        $ip = $args[0];
        $port = $args[1];
        $srvinfo = $this->ping($ip, $port);
        $motd = $srvinfo["motd"];
        $this->bot->privmsg($channel, "The MOTD for ".$ip." is ".$motd);
    }
    
    public function command_mcplayers($user, $channel, $args) {
        $ip = $args[0];
        $port = $args[1];
        $srvinfo = $this->ping($ip, $port);
        $players = $srvinfo["players"];
        $max_players = $srvinfo["max_players"];
        $this->bot->privmsg($channel, "Their is currently ".$players."/".$max_players." on ".$ip);
    }
    
    public function ping($ip, $port) {
        $fp = fsockopen($ip, $port, $errno, $errstr, 5); // Socket for connecting to server
    
        if (!$fp) { 
            echo "Error";
        } else {
            $out = "\xFE"; // Hex needed for server info
        
            fwrite($fp, $out);
            while (!feof($fp)) {
                $result .= fgets($fp, 128);
            }
            fclose($fp);
            
            // Remove extra spaces between characters
            $result = str_replace("\x00", "", $result); 
            $result = str_replace("\x1A", "", $result); 
            $result = str_replace("\xFF", "", $result);
            
            $srvinfo = explode("\xA7",$result); 
            
            return array("motd" => $srvinfo[0], "players" => $srvinfo[1], "max_players" => $srvinfo[2]);
            echo "motd: " . $srvinfo[0] . "\n";
            echo "players: " . $srvinfo[1] . "\n";
            echo "max_players: " . $srvinfo[2] . "\n";
        }
    }
}

?>