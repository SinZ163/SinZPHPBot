<?php
class google {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
    }
    public function command_g($user, $channel, $args) {
        $key = "AIzaSyCHdXQAsYQwspXqS-POLh9RTSv0xlwUO1o";
        $data = file_get_contents("https://www.googleapis.com/customsearch/v1?key=".$key."&cx=017576662512468239146:omuauf_lfve&q=".implode("+",$args)."&callback=hndlr");
        $this->bot->privmsg($channel, $data);
    }
    public function command_calc($user, $channel, $args) {
		$calc = implode(" ",$args);
		$data = file_get_contents("http://www.google.com/ig/calculator?hl=en&q=".urlencode($calc));
        
        $this->bot->privmsg($channel, "0|".$data);
        $data = mb_convert_encoding($data, 'UTF-8', mb_detect_encoding($data, 'UTF-8, ISO-8859-1', true));
        //print("1|".$data . "\n");
        $this->bot->privmsg($channel, "1|".$data);
		$data = preg_replace("/([,{])(.*?):/", '$1"$2":', $data); //hack, convert js to json.
        //print("2|".$data . "\n");
        $this->bot->privmsg($channel, "2|".$data);
		$data = stripcslashes($data);
        //print("3|".$data . "\n");
        $this->bot->privmsg($channel, "3|".$data);
		$data = preg_replace("/<sup>(.*?)<\/sup>/", '^$1', $data);
        //print("4|".$data . "\n");
        $this->bot->privmsg($channel, "4|".$data);
        $data = preg_replace("/&#215;/", '\u00d7', $data);
        //print("5|".$data . "\n");
        $this->bot->privmsg($channel, "5|".$data);
		$data = json_decode($data,1);
		//foreach ($data as &$node) { $node = html_entity_decode($node); }
        //print_r($data);
        $this->bot->privmsg($channel, "6|".json_encode($data));
		$this->bot->privmsg($channel, $data["lhs"]." = ".$data["rhs"]);	
		//$this->bot->privmsg($channel, json_encode(array($data[error], $data[icc], $calc))); //DEBUG
	}
    public function command_urlShort($user, $channel, $args) {
        $ch = curl_init("https://www.googleapis.com/urlshortener/v1/url");
        curl_setopt($ch, CURLOPT_HTTPHEADER, "['Content-Type: application/json']");
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"longUrl": "{$args[0]}"}');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $msg = curl_exec($ch);
        $result = json_decode($msg);
        $this->bot->privmsg($channel, $result['id']);
    }
}
?>