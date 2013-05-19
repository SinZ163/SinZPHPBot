<?php
class Leetify {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
	
	public function command_1337($user, $channel, $args) {
        $patterns = array();
        $patterns[00] = "/a/";
        $patterns[01] = "/b/";
        $patterns[02] = "/c/";
        $patterns[03] = "/d/";
        $patterns[04] = "/e/";
        $patterns[05] = "/f/";
        $patterns[06] = "/g/";
        $patterns[07] = "/h/";
        $patterns[08] = "/i/";
        $patterns[09] = "/j/";
        $patterns[10] = "/k/";
        $patterns[11] = "/l/";
        $patterns[12] = "/m/";
        $patterns[13] = "/n/";
        $patterns[14] = "/o/";
        $patterns[15] = "/p/";
        $patterns[16] = "/q/";
        $patterns[17] = "/r/";
        $patterns[18] = "/s/";
        $patterns[19] = "/t/";
        $patterns[20] = "/u/";
        $patterns[21] = "/v/";
        $patterns[22] = "/w/";
        $patterns[23] = "/x/";
        $patterns[24] = "/y/";
        $patterns[25] = "/z/";
        $patterns[26] = "/ /";
        
        $replacements = array();
        $replacements[00] = "@";
        $replacements[01] = "|3";
        $replacements[02] = "<";
        $replacements[03] = "<|";
        $replacements[04] = "3";
        $replacements[05] = "|=";
        $replacements[06] = "6";
        $replacements[07] = "|-|";
        $replacements[08] = "1";
        $replacements[09] = "_|";
        $replacements[10] = "|<";
        $replacements[11] = "1";
        $replacements[12] = "/\\/\\";
        $replacements[13] = "|^|";
        $replacements[14] = "0";
        $replacements[15] = "|O";
        $replacements[16] = "&";
        $replacements[17] = "|2";
        $replacements[18] = "$";
        $replacements[19] = "7";
        $replacements[20] = "|_|";
        $replacements[21] = "\\/";
        $replacements[22] = "\\/\\/";
        $replacements[23] = "><";
        $replacements[24] = chr(253);
        $replacements[25] = "2";
        $replacements[26] = " ";
        
        $msg = preg_replace($patterns, $replacements, strtolower(implode("", $args)));
		$this->bot->privmsg($channel, $msg);
	}
	
}