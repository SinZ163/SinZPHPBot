<?php
class command {
	private $bot = null;
    public function command($config) {
        $this->config = $config;
    }
    
	public function plugin_registered($bot) {
		$this->bot = $bot;
	}
	public function command_debug($user, $channel, $args) {
		if (!(user::IPhasPermission("core.command.debug", $user))) {
			$this->bot->say_notice($user, "You dont have permission to use this command.");
		}
		else {
			$this->bot->say_message($channel, json_encode(array($user, $channel, $args)));
		}
	}
	public function command_rickroll($user, $channel, $args) {
		if (!(user::IPhasPermission("core.command.rickroll", $user))) {
			$this->bot->say_notice($user, "You dont have permission to use this command.");
		}
		else {
			if (!(user::IPhasPermission("core.command.rickroll.admin", $args[0]))) {
				if (!(user::IPhasPermission("core.command.rickroll.admin", $user))) {
					$this->bot->say_notice($user, "You dont have permission to rickroll my master, bitch!!!");
				}
				else {
					$this->bot->say_message($args[0], "Never going to Give you up, Never going to Let you down, never going to run android and, desert you!");
					$this->bot->say_message($channel, $args[0]." Just got rickrolled!");
				}
			}
			else {
				$this->bot->say_message($args[0], "Never going to Give you up, Never going to Let you down, never going to run android and, desert you!");
				$this->bot->say_message($channel, $args[0]." Just got rickrolled!");
			}
		}
	}
	public function command_join($user, $channel, $args) {
		if (!(user::IPhasPermission("core.command.join", $user))) {
			$this->bot->say_notice($user, "You dont have permission to use this command.");
		}
		else {
			$this->bot->send_message("","JOIN", $args[0]);
		}
	}
	public function command_part($user, $channel, $args) {
		if (!(user::IPhasPermission("core.command.join", $user))) {
			$this->bot->say_notice($user, "You dont have permission to use this command.");
		}
		else {
			$this->bot->send_message("","PART", $args[0]);
		}
	}
	public function command_say($user, $channel, $args) {
		$echo = implode(" ",$args);
		$this->bot->say_message($channel, $echo);
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
	public function command_port($user, $channel, $args) {
		$fp = fsockopen($args[0],$args[1],$errno,$errstr,10);
		if(!$fp) { $msg = "Cannot connect to server"; }
		else {
			$msg = "Connect was successful - no errors on Port ".$args[1]." at ".$args[0];
			fclose($fp);
		}
		$this->bot->say_message($channel, $msg);
	}
    public function command_pastebin($user, $channel, $args) {
            require_once("/plugins/pastebin/plugin.php");
            $this->bot->say_message($channel, sinz_pastebin($args));
    }
    public function command_addplugin($user, $channel, $args) {
            include_once $args[0];
            $this->bot->plugin_register(new $args[1]());
    }
	public function command_trollface($user, $channel, $args) {
			$this->bot->say_message($channel, "http://www.ciscolife.ca/trollface.png");
	}
	public function command_andromeda($user, $channel, $args) {
		if ($args[0] == "console") {
			$arg = implode(" ", $args);
			$msg = substr($arg, 8);
			$command = urlencode($msg);
			// Now we have found EXACTLY what we want to send as the command, lets first login.
			$user = "SinZ";
			$pass = "$!NN3d**";
			$user_agent = "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://manage.pigsaddle.com/login.php");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "?username=".$user."&password=".$pass);
			$login_output = curl_exec($ch);
			$login_info = curl_getinfo($ch);
			// Hopefully we have logged in now... we can actually "hack" into the console
			curl_setopt($ch, CURLOPT_URL, "http://manage.pigsaddle.com/include/actions/ssh_command.php");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$data = array(
			'command' => 'say',
			'text' => $command
			);

			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$output = curl_exec($ch);
			$info = curl_getinfo($ch);
			curl_close($ch);
			$this->bot->say_message($channel, $login_output." ".$login_info." ".$output." ".$info." Done");
		}
	}
	
	/*public function command_reload($user, $channels, $args) {
		if(user::isAdmin($args[0])) {
			// Figure out how to reload	
		}
	}*/
    
    
    /* TEMPORARY SPOT FOR PLUGIN COMMANDS */
    public function command_loadedplugins($user, $channel, $args) {
        foreach($this->config['plugins'] as $plugin) {
            $this->bot->say_message($channel, "$plugin");
        }
    }
    public function command_pluginload($user,$channel,$args) {
        include "./plugins/$args[0]/plugin.php";
        $this->$bot->plugin_register(new $args[0]($this->config));
    }
}