<?php

class user {
	private $bot = null;
	public function plugin_registered($bot) {
		$this->bot = $bot;
	}

	public function explodeIP($ip) { // turns $ip which is a string, nick!ident@hostmark into $result which is an array, 0 = nick, 1 = ident, 2 = hostmark
		$address = explode("@", $ip);
		$hostmark = $address[1];
		$nick_ident = explode("!", $address[0]);
		$result = array($nick_ident[0], $nick_ident[1], $hostmark);
		return $result;
	}
	public function implodeIP($result) { // turns $result which is an array, 0 = nick, 1 = ident, 2 = hostmark into $ip which is a string, nick!ident@hostmark
		$nick_ident_A = array($result[0], $result[1]);
		$nick_ident = implode("!", $nick_ident_A);
		$address = array($nick_ident, $result[2]);
		$ip = implode("@", $address);
		return $ip;
	}
	public function hasPermission($node, $ip, $default = false) {
		$user = $this->bot->user->explodeIP($ip);
		$nick = $user[0];
		$ident = $user[1];
		$hostmark = $user[2];
		
		return true; // temp fix until finished
	}
	public function IPhasPermission($node, $IP) { // only here untill its all finished.
		return true;
	}
    public function isAdmin($user){
        return true;
		$address = explode("@", $user);
		$hostmark = $address[1];
		$nick_ident = explode("!", $address[0]);
        $nick = $nick_ident[0];
        $admins = $this->bot->config['admins'];
        $this->bot->privmsg("#SinZationalMinecraft", json_encode($this->bot->config['admins']));
        if (count($admins) == 1) {
            $this->bot->privmsg("#SinZationalMinecraft", $nick."|".$admins[0]);
            if ($nick == $admins[0]) {
                return true;
            }
        } else {
            foreach ($admins as $admin) {
                $this->bot->privmsg("#SinZationalMinecraft", $nick."|".$admin);
                if ($nick == $admin) {
                    return true;
                }
            }
        }
        return false;
    }
	/*public function getDB() {
		$DB = file_get_contents("permissions.json");
		return json_decode($DB);
	}
	public function setDB($change) {
    }
	public function getPassword($network, $user, $attempt) {
		$DB = getDB();
        $password = $DB['users'][$network][$user]["password"];
        if($password == crypt::decode($attempt, $user)) {
            return true;
        }
		else return false;
	}
	public function getUser($ip) {
		$DB = getDB();
		foreach ($DB['users'] as $user) {
			
		}
	}
	/*Command Interface for Bans, and group/account controlling */
	/*public function command_login($hostmark, $channel, $args) { // Syntax: `login USER PASSWORD
		if ($attempts[$user[2]] == 3) {
			$this->bot->say_message($channel, "You have allready been banned, Please try again in a day or so.");
		}
		$DB = getDB();
		$ip = explodeIP($hostmark);
		$user = getUser($ip); // $user[0] = nick, $user[1] = ident, $user[2] = hostmark
		$pass_test = getPassword($this->config['network'], $args[0], $args[1]);
		if (!($pass_test)) {
			if (($attempts[$user[2]]) == 1) {
				$attempts[$user] = 2;
				$this->bot->say_message($channel, "You have given an invalid user/pass, You have used 2 of 3 attempts.");
			}
			elseif (($attempts[$user[2]]) == 2) {
				$attempts[$user] = 3;
				$this->bot->say_message($channel, "You have given an invalid user/pass, You have used 3 of 3 attempts, You have been locked out of the system for 1 day.");
			}
			$attempts[$user] = 1;
			$this->bot->say_message($channel, "You have given an invalid user/pass, You have used 1 of 3 attempts.");
		}
        else {
            
        }
	}*/
}