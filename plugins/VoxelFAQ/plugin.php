<?php
class VoxelFAQ {
    private $bot = null;
	private $FAQs = array();
    public function plugin_registered($bot) {
        $this->bot = $bot;
		$this->initDB();
    }
    private function updateDB($URL = "http://mcfaq.hfbgaming.com/faqdatabase") {
        
    }
    private function initDB( $filename = './plugins/VoxelFAQ/faqdatabase.txt', $moddb = './plugins/VoxelFAQ/moddatabase.txt') {
        $file       =  file($filename);
        $modfile    =  file( $moddb);
		if (!$file or !$modfile) {
			print("~~~~~~~ERROR~~~~~~~\r\n");
			print("~~ DATABASE ERROR ~~\r\n");
			print("~~~~~~~ERROR~~~~~~~\r\n");
			return false;
		}
        $db = array();
        foreach( $file as $line ) {
            $bits = explode( '|', $line ); 
            $db[strtolower($bits[0])] = $bits[1]; //notice: undefined offset: 1 (php5.4)
        }
        foreach( $modfile as $line ) {
            $bits = explode( '|', $line ); 
            $db[strtolower($bits[0])] = $bits[1]; //notice: undefined offset: 1 (php5.4)
        }
        $this->FAQs = $db;
        return true;
    }

    private function readDB( $needle = "" ) {
		$needle = strtolower($needle);
        if ($this->FAQs[$needle]) {
			return explode(";;", $this->FAQs[$needle]);
		}
        return False;
    }
    public function network_PRIVMSG($prefix, $command, $args) {
        $user = $prefix;
        $channel = $args[0];
        $message = explode(" ", $args[1]);
        if ($message[0][0] == "@") {
            $target = substr($message[0], 1);
            $args= array_splice($message, 1);
            $bold = chr(2);
            $msg = $this->readDB($args[0]);
            if ($msg) {
                foreach ($msg as $output) {
                    if ($target != "" and $target != "@") {
                        $this->bot->privmsg($channel, $bold.$target.": ".$bold."(".$args[0].") ".$output);
                    } else {
                        $this->bot->privmsg($channel, $bold.$args[0].": ".$bold.$output);
                    }
                }
            } else {
                $this->bot->privmsg($channel, "Unknown factoid: ".$bold.$args[0].$bold);
            }
        }
    }
	public function command_voxelhead($user, $channel, $args) {
		$bold = chr(2);
		$msg = $this->readDB($args[0]);
		if ($msg) {
			foreach ($msg as $output) {
				$this->bot->privmsg($channel, $bold.$args[0].": ".$bold.$output);
			}
		} else {
			$this->bot->privmsg($channel, "Unknown factoid: ".$bold.$args[0].$bold);
		}
	}
    public function command_addFactoid($user, $channel, $args) {
        $moddb = './plugins/VoxelFAQ/moddatabase.txt';
        $modfile = file($moddb);
        if (!$modfile) {
            $this->bot->privmsg($channel, "Failed to access database");
            return;
        }
        
    }
    public function command_reloadDB($user, $channel, $args) {
        $this->initDB();
    }
}