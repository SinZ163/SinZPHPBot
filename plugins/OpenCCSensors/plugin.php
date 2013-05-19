    <?php
    class OpenCCSensors {
        private $bot = null;
        public function plugin_registered($bot) {
            $this->bot = $bot;
        }
        
        public function command_ocs($user, $channel, $args) {
            if (!$args[0]) {
                $args[0] = "0.1%";
            }
            $msg = file_get_contents("http://www.openccsensors.info/feed?version=".urlencode($args[0]));
            $array = json_decode($msg, true);
            
            $i = count($array["feed"]);
            $count = 0;
            foreach($array["feed"] as $date) {
                $count = $count + $date["count"];
            }
            
            $this->bot->privmsg($channel, "Server count: ".$array["server"]." Client count: ".$array["client"]);
            $this->bot->privmsg($channel, "There have been a total of ".$array["feed"][$i-1]["count"]." installs today out of ".$count);
        }
    }