<?php
class channel_commands {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
    public function command_op($user, $channel, $args) {
		if (!(user::hasPermissions("plugin.channel_commands.op", $user, false)) {
			$this->bot->say_message($channel, "You are not authorised to use this command.");
		}
		else {
			$this->bot->send_message("", "MODE ".$channel." +o ".$args[0]);
		}
    }
    public function command_deop($user, $channel, $args) {
		if (!(user::hasPermissions("plugin.channel_commands.deop", $user, false)) {
			$this->bot->say_message($channel, "You are not authorised to use this command.");
		}
		else {
			$this->bot->send_message("", "MODE ".$channel." -o ".$args[0]);
		}
    }
    public function command_voice($user, $channel, $args) {
		if (!(user::hasPermissions("plugin.channel_commands.voice", $user, false)) {
			$this->bot->say_message($channel, "You are not authorised to use this command.");
		}
		else {
			$this->bot->send_message("", "MODE ".$channel." +v ".$args[0]);
		}
    }
    public function command_devoice($user, $channel, $args) {
		if (!(user::hasPermissions("plugin.channel_commands.devoice", $user, false)) {
			$this->bot->say_message($channel, "You are not authorised to use this command.");
		}
		else {
			$this->bot->send_message("", "MODE ".$channel." -v ".$args[0]);
		}
    } 
    public function command_admin($user, $channel, $args) {
		if (!(user::hasPermissions("plugin.channel_commands.admin", $user, false)) {
			$this->bot->say_message($channel, "You are not authorised to use this command.");
		}
		else {
			$this->bot->send_message("", "MODE ".$channel." +a ".$args[0]);
		}
    }
    public function command_deadmin($user, $channel, $args) {
		if (!(user::hasPermissions("plugin.channel_commands.deadmin", $user, false)) {
			$this->bot->say_message($channel, "You are not authorised to use this command.");
		}
		else {
			$this->bot->send_message("", "MODE ".$channel." -a ".$args[0]);
		}
    }
    public function command_owner($user, $channel, $args) {
		if (!(user::hasPermissions("plugin.channel_commands.owner", $user, false)) {
			$this->bot->say_message($channel, "You are not authorised to use this command.");
		}
		else {
			$this->bot->send_message("", "MODE ".$channel." +q ".$args[0]);
		}
    }
    public function command_deowner($user, $channel, $args) {
		if (!(user::hasPermissions("plugin.channel_commands.deowner", $user, false)) {
			$this->bot->say_message($channel, "You are not authorised to use this command.");
		}
		else {
			$this->bot->send_message("", "MODE ".$channel." -q ".$args[0]);
		}
    }
}
?>