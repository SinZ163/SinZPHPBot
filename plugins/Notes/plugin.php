<?php

class Notes {

    private $bot = null;

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function command_read($user, $channel, $args) {
        $nick = user::explodeIP($user);
        if ($args[0]){
            $auser = $args[0];
        }
        else $auser = $nick[0];
        $player = ucwords(strtolower($auser));
		$this->bot->notice($user,"| Notes about ".$player." |");
        $file = file("notes/".$player.".txt");
        foreach ($file as $note) {
            $this->bot->notice($user,$note);
        }
		$this->bot->notice($user,"| End of Notes |");
    }
    public function command_note($user, $channel, $args) {
        $player = $args[0];
		$writer=user::explodeIP($user);
		$this->bot->notice($user,"Written note about ".$player.".");
		$fp=fopen("notes/".ucwords(strtolower($player)).".txt","a");
		fwrite($fp,"From ".$writer[0].": ".implode(" ",array_splice($args, 1))."\r\n");
		fclose($fp);
    }

}

?>	