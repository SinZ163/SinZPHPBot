<?php

class command {

    private $bot = null;

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function command_debug($user, $channel, $args) {
        if (!(user::IPhasPermission("core.command.debug", $user))) {
            $this->bot->privmsg($user, "You dont have permission to use this command.");
        } else {
            $this->bot->privmsg($channel, json_encode(array($user, $channel, $args)));
        }
    }

    public function command_rickroll($user, $channel, $args) {
        if (!(user::IPhasPermission("core.command.rickroll", $user))) {
            $this->bot->privmsg($user, "You dont have permission to use this command.");
        } else {
            if (!(user::IPhasPermission("core.command.rickroll.admin", $args[0]))) {
                if (!(user::IPhasPermission("core.command.rickroll.admin", $user))) {
                    $this->bot->privmsg($user, "You dont have permission to rickroll my master, bitch!!!");
                } else {
                    $this->bot->privmsg($args[0], "Never going to Give you up, Never going to Let you down, never going to run android and, desert you!");
                    $this->bot->privmsg($channel, $args[0] . " Just got rickrolled!");
                }
            } else {
                $this->bot->privmsg($args[0], "Never going to Give you up, Never going to Let you down, never going to run android and, desert you!");
                $this->bot->privmsg($channel, $args[0] . " Just got rickrolled!");
            }
        }
    }

    public function command_join($user, $channel, $args) {
        if (!(user::IPhasPermission("core.command.join", $user))) {
            $this->bot->privmsg($user, "You dont have permission to use this command.");
        } else {
            if ($args[0][0] == "#") {
                $this->bot->send_message("", "JOIN", $args[0]);
            }
        }
    }

    public function command_part($user, $channel, $args) {
        if (!(user::IPhasPermission("core.command.join", $user))) {
            $this->bot->privmsg($user, "You dont have permission to use this command.");
        } else {
            $this->bot->send_message("", "PART", $args[0]);
        }
    }

    public function command_say($user, $channel, $args) {
        $echo = implode(" ", $args);
        $this->bot->privmsg($channel, $echo);
    }

    public function command_title($user, $channel, $args) {
        $url = $args[0];
        $str = file_get_contents($url);
        $pattern = "/<title ?.*>(.*)<\/title>/";
        preg_match($pattern, $str, $txt);
        $this->bot->privmsg($channel, $txt[1] . " (" . $args[0] . ")");
    }

    public function command_eval($user, $channel, $args) {
        if (!($this->bot->user->isAdmin($user))) {
            $this->bot->notice($user, "You are not authorized to use eval");
        }
        else {
            $message = implode(" ", $args);
            $this->bot->privmsg($channel, eval(substr($message, 0)));
        /*require_once("eval.php");
        $message = implode(" ", $args);
        $evaluate = new evaluate($message);
        $return = $evaluate->start();
        $this->bot->privmsg($channel, $message);*/
		}
    }

    public function command_port($user, $channel, $args) {
        $fp = fsockopen($args[0], $args[1], $errno, $errstr, 10);
        if (!$fp) {
            $msg = "Cannot connect to server";
        } else {
            $msg = "Connect was successful - no errors on Port " . $args[1] . " at " . $args[0];
            fclose($fp);
        }
        $this->bot->privmsg($channel, $msg);
    }

    public function command_admins($user, $channel, $args) {
        $list = implode(", ", $this->bot->config['admins']);
        $this->bot->privmsg($channel, $list);
    }
    public function command_pastebin($user, $channel, $args) {
        require_once("/plugins/pastebin/plugin.php");
        $this->bot->privmsg($channel, sinz_pastebin($args));
    }

   /* public function command_addplugin($user, $channel, $args) {
        include_once $args[0];
        $this->bot->plugin_register(new $args[1]());
    }*/

    /* public function command_reload($user, $channels, $args) {
      if(user::isAdmin($args[0])) {
      // Figure out how to reload
      }
      } */


    /* TEMPORARY SPOT FOR PLUGIN COMMANDS */

    public function command_loadedplugins($user, $channel, $args) {
		$this->bot->privmsg($channel, implode(", ", $this->config['plugins']));
    }

    public function command_pluginload($user, $channel, $args) {
        include_once "./plugins/$args[0]/plugin.php";
        $this->bot->plugin_register(new $args[0]($this->config));
    }
	
	public function command_reload($user, $channel, $args) {
		$this->bot->pluginload();
		$this->bot->privmsg($channel, "Reloaded.");
	}

}