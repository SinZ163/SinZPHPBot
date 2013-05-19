<?php
class VoxelFAQ {
    private $bot = null;
	private $FAQs = array();
    private $voxelhead = array();
    public function plugin_registered($bot) {
        $this->bot = $bot;
		$this->initDB();
    }
    private function updateDB($url = "http://home.ghoti.me:8080/~faqbot/faqdatabase") {
        $filename = './plugins/VoxelFAQ/faqdatabase.txt';
        $newfile = file($url);
        $file = fopen($filename, 'w');
        foreach($newfile as $line) {
            fwrite($file, $line);
        }
        fclose($file);
    }
    private function initDB( $filename = './plugins/VoxelFAQ/faqdatabase.txt', $moddb = './plugins/VoxelFAQ/moddatabase.txt') {
        $file       =  file($filename);
        $modfile    =  file( $moddb);
		if (!$file or !$modfile) {
			print("~~~~~~~ERROR~~~~~~~~\r\n");
			print("~~ DATABASE ERROR ~~\r\n");
			print("~~~~~~~ERROR~~~~~~~~\r\n");
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
    private function noticeDB($message, $target) {
        $bold = chr(2);
        if ($target) {
            $msg = $this->readDB($message);
            if ($msg) {
                foreach ($msg as $output) {
                    $this->bot->notice($target, $bold.$message.": ".$bold.$output);
                }
            } else {
                $this->bot->notice($target, "Unknown factoid: ".$bold.$args[0].$bold);
            }
        }
    }
    private function privmsgDB($message, $channel, $target = false) {
        $bold = chr(2);
        $msg = $this->readDB($message);
            if ($msg) {
                if ($target) {
                    foreach ($msg as $output) {
                        $this->bot->privmsg($channel, $bold.$target.": ".$bold."(".$message.") ".$output);
                    }
                } else {
                    foreach ($msg as $output) {
                        $this->bot->privmsg($channel, $bold.$message.": ".$bold.$output);
                    }
                }
            }
    }
    public function network_PRIVMSG($prefix, $command, $args) {
        $message = explode(" ", $args[1]);
            
        $user = $prefix;
        $channel = $args[0];
        $args= array_splice($message, 1);
        
        if ($this->voxelhead[$channel] == "true") { //TODO: switch case this
            if ($message[0][0] == "?" & $message[0][1] == "?") {
                if ($message[0][2] == ">") {
                    if ($message[0][3] == ">") {
                        $this->bot->notice($user, "Sorry, that isn't implemented yet.");
                    } else {
                        $this->privmsgDB($args[1], $channel, $args[0]);
                    }
                } else if ($message[0][2] == "<") {
                    $this->noticeDB($args[0], $user);
                } else {
                    $this->privmsgDB($args[0], $channel);
                }
            }
        }
        if ($message[0][0] == "@") {
            $target = substr($message[0], 1);
            if ($target != "" and $target != "@") {
                $this->privmsgDB($args[0], $channel, $target);
            } else {
                $this->privmsgDB($args[0], $channel);
            }
        }
    }
	public function command_voxelhead($user, $channel, $args) {
        $this->privmsgDB($args[0], $channel);
	}
    public function command_addFactoid($user, $channel, $args) {
        if ($this->readDB($args[0])) {
            $this->bot->notice($user, "This factoid already exists.");
        } else {
            $moddb = './plugins/VoxelFAQ/moddatabase.txt';
            $modfile = fopen($moddb, "a");
            fwrite($modfile, $args[0]."|".implode(" ", array_splice($args, 1)));
            fclose($modfile);
            
            $this->initDB();
            $this->bot->privmsg($channel, "Successfully added this factoid to the VoxelFAQ database.");
        }
    }
    public function command_reloadDB($user, $channel, $args) {
        $this->initDB();
        $this->bot->privmsg($channel, "Successfully reloaded the VoxelFAQ Database.");
    }
    public function command_updateVoxelDB($user, $channel, $args) {
        $this->updateDB();
        $this->initDB();
        $this->bot->privmsg($channel, "Successfully redownloaded the VoxelHead Database.");
    }
    
    public function command_toggleVoxelhead($user, $channel, $args) {
        if ($this->voxelhead[$channel] == "true") {
            $this->voxelhead[$channel] = "false";
        } else {
            $this->voxelhead[$channel] = "true";
        }
    }
    
    
    public function network_QUIT($prefix, $command, $args) {
        $hostmark = $this->bot->user->explodeIP($prefix);
        if ($hostmark[0] == "VoxelHead") {
            $this->voxelhead["#minecrafthelp"] = "true";
            $this->voxelhead["##voxelhead"] = "true";
        }
    }
    public function network_JOIN($prefix, $command, $args) {
            $hostmark = $this->bot->user->explodeIP($prefix);
        if ($hostmark[0] == "VoxelHead") {
            $this->voxelhead[$args[0]] = "false";
        }
    }
}