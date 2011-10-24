<?php
class SpiderNight {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
    public function command_Ping($user, $channel, $args) {
        $this->bot->privmsg($channel, "Pong");// sends a PRIVMSG and sets the channel to $channel and the message to arguments put into a string
    }
}
?>