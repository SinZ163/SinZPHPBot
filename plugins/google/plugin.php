<?php
class google {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
    public function command_g($user, $channel, $args) {
        $search = implode("+", $args);
        $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".$search;
        $result = json_decode($url, true);
        echo $test;
        return $result;
        $this->bot->say_message($channel, "$result");
    }
}
?>