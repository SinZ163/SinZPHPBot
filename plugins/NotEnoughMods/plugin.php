<?php
class NotEnoughMods {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
        public function command_list($user, $channel, $args) {
        $jsonOutput = file_get_contents("http://bot.notenoughmods.com/".urlencode($args[1]).".json");
        $array = json_decode($jsonOutput, true);
        //print_r($array);       
        $results = array();
        
        $i = -1;
        foreach($array as $modArray) {
            $i++;
            if (stristr($modArray["name"], $args[0])) {
                array_push($results, $i);
                continue;
                //$this->bot->privmsg($channel, $modArray["name"]." - ".$modArray["version"]." ( ".$modArray["shorturl"]." )");
            } else {
                $aliases = array();
                $aliases = explode(" ", $modArray["aliases"]);
                foreach($aliases as $alias) {
                    if (stristr($alias, $args[0])) {
                        array_push($results, $i);
                        break;
                        //$this->bot->privmsg($channel, $modArray["name"]." - ".$modArray["version"]." ( ".$modArray["shorturl"]." )");
                    }
                }
            }
        }
        $orange = 7;
        $blue = 12;
        $gray = 14;
        $lightgray = 15;
        $bold = chr(2);
        $colour = chr(3);
        
        $count = count($results);
        if ($count == 0) {
            $this->bot->privmsg($channel, "no results found.");
            return;
        }
        elseif ($count == 1) {
            $count = $count." result";
        } else {
            $count = $count." results";
        }
        $this->bot->privmsg($channel, "Listing ".$count." for \"".$args[0]."\" in ".$bold.$colour.$blue.$args[1].$colour.$bold.":");
        foreach($results as $result) {
            $alias = $colour;
            if ($array[$result]["aliases"] != "") {
                $alias = $colour." (".$colour.$gray.preg_replace("/ /", ", ", $array[$result]["aliases"]).$colour.") ";
            }
            $comment = $colour;
            if ($array[$result]["comment"] != "") {
                $comment = $colour."[".$colour.$gray.$array[$result]["comment"].$colour."] ";
            }
            $this->bot->privmsg($channel, $colour.$gray.$array[$result]["name"].$alias.$colour.$lightgray.$array[$result]["version"]." ".$comment.$colour.$orange.$array[$result]["shorturl"].$colour);
        }
    }
}