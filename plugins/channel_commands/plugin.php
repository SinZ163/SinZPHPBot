<?php
class channel_commands {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
    public function command_op($user, $channel, $args) {
        $this->bot->send_message("", "MODE ".$channel." +o ".$args[0]);
    }
    public function command_deop($user, $channel, $args) {
        $this->bot->send_message("", "MODE ".$channel." -o ".$args[0]);
    }
    public function command_voice($user, $channel, $args) {
        $this->bot->send_message("", "MODE ".$channel." +v ".$args[0]);
    }
    public function command_devoice($user, $channel, $args) {
        $this->bot->send_message("", "MODE ".$channel." -v ".$args[0]);
    } 
    public function command_admin($user, $channel, $args) {
        $this->bot->send_message("", "MODE ".$channel." +a ".$args[0]);
    }
    public function command_deadmin($user, $channel, $args) {
        $this->bot->send_message("", "MODE ".$channel." -a ".$args[0]);
    }
    public function command_owner($user, $channel, $args) {
        $this->bot->send_message("", "MODE ".$channel." +q ".$args[0]);
    }
    public function command_deowner($user, $channel, $args) {
        $this->bot->send_message("", "MODE ".$channel." -q ".$args[0]);
    }
}
?>