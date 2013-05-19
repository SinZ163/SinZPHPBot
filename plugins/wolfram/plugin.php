<?php
class wolfram {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
        //include_once("WolframAlphaEngine.php");
        //$this->wolfram = new WolframAlphaEngine("LV28TW-RA783QRGUK");
    }
    public function Parse ($url) {
        $fileContents= file_get_contents($url);
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_encode($simpleXml);

        return $json;
    }
    public function getResults($args) {
        $url = "http://api.wolframalpha.com/v1/query.jsp";
        $appID = "LV28TW-RA783QRGUK";
        $input = implode(" ",$args);
        $json = $this->Parse($url."?appid=".urlencode($appID)."&input=".urlencode($input));
        return $json;
    }
    public function command_wolfram($user, $channel, $args) {
        $result = $this->getResults($args);
        $array = json_decode($result,true);
        
        print_r($array['pod'][1]['subpod']['plaintext']);
        $this->bot->privmsg($channel, $array['pod'][1]['subpod']['plaintext']);
    }
}