<?php
class Minecraft2 {

    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
        include_once("ping.php");
        $this->mcping = new mcping;
		include_once("query.php");
		$this->mcquery = new mcquery;
    }
    public function command_paid($user, $channel, $args) {
        if (!(user::IPhasPermission("plugin.minecraft.paid", $user))) {
            $this->bot->say_notice($user, "You dont have permission to use this command.");
        } else {
            $url = file_get_contents("http://www.minecraft.net/haspaid.jsp?user=" . urlencode($args[0]));

            if ($url == "true") {
                $this->bot->privmsg($channel, $args[0] . " has paid for Minecraft.");
            } else {
                $this->bot->privmsg($channel, $args[0] . " hasn't paid for Minecraft!");
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
        $hostmark = $this->getIP_Port($args[0], $args[1]);
        $ip = $hostmark[0];
        $port = $hostmark[1];
        $srvinfo = $this->mcping->ping($ip, $port);
        $motd = $srvinfo["motd"];
        $this->bot->privmsg($channel, "The MOTD for ".$ip." is ".$motd);
    }
    
    public function command_mcping($user, $channel, $args) {
        $hostmark = $this->getIP_Port($args[0], $args[1]);
        $ip = $hostmark[0];
        $port = $hostmark[1];

        $srvinfo = $this->mcping->ping($ip, $port);
        if ($srvinfo) {
            $motd = $srvinfo['motd'];
            $players = $srvinfo["playerCount"];
            $max_players = $srvinfo["maxPlayers"];
            $version = $srvinfo['minecraftVersion'];
            $protocol = $srvinfo['protocolVersion'];
            $bold = chr(2);
            $reds = chr(3) . "04";
            $rede = chr(3);
            $this->bot->privmsg($channel, $motd. $bold." (".$bold.$reds.$players.$rede.$bold."/".$bold.$reds.$max_players.$rede.$bold.")".$bold." | Minecraft Version: ".$reds.$version.$rede.", Protocol Version: ".$reds.$protocol.$rede);
        }
        else $this->bot->privmsg($channel, "Cannot connect to ".$ip.":".$port);
    }
    
    public function command_mcplayers($user, $channel, $args) {
        $hostmark = $this->getIP_Port($args[0], $args[1]);
        $ip = $hostmark[0];
        $port = $hostmark[1];
        $srvinfo = $this->mcping->ping($ip, $port);
        $players = $srvinfo["players"];
        $max_players = $srvinfo["max_players"];
        $this->bot->privmsg($channel, "Their is currently ".$players."/".$max_players." on ".$ip);
    }


    public function command_mcquery($user, $channel, $args) {
        $hostmark = $this->getIP_Port($args[0], $args[1]);
        $ip = $args[0];
        $port = $args[1];
        $info = $this->mcquery->query($ip, $port);
        if ($info) {
            $this->bot->privmsg($channel, "Server: ".$info->hostname.":".$info->hostport." running on ".$info->version);
        }
        else $this->bot->privmsg($channel, "Cannot connect to udp://".$ip.":".$port.".");
    }
    public function command_mclist($user, $channel, $args) {
        $hostmark = $this->getIP_Port($args[0], $args[1]);
        $ip = $args[0];
        $port = $args[1];
        $info = $this->mcquery->query($ip, $port);
        if ($info) {
            if ($info->players) {
                foreach ($info->players as $index=>$player) {
                    $msg .= $player.chr(2)." || ".chr(2);
                }
                $msg = substr($msg, 0, -4);
				$this->bot->privmsg($channel, $msg);
			}
			else $this->bot->privmsg($channel, "No players on udp://".$ip.":".$port.".");
		}
		else $this->bot->privmsg($channel, "Cannot connect to udp://".$ip.":".$port.".");
	}
	
	public function getIP_Port($arg1, $arg2) {
		// Check for a colon
		$host = explode( ':', $arg1 );
		if( count( $host ) == 2 ) {
			// There was a colon
			$ip = $host[0];
			$port = $host[1];
		} else if( count( $host ) == 1 ) {
			$ip = $host[0];
			$port = 25565;
		//} else if( count( $host ) > 2 ) {
		//	die( "What the hell kind of host i? this?\n".print_r( $host ) );
		}
		if( $arg2 ) {
			$port = $arg2;
		}
		//$this->bot->privmsg($channel, json_encode( array( $ip, $port ) ));
		return array( $ip, $port );
	}
}

?>