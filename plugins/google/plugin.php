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
		$data = preg_replace("/([,{])(.*?):/", '$1"$2":', $data); //hack, convert js to json.
		$data = stripcslashes($data);
		$data = preg_replace("/<sup>(.*?)<\/sup>/", '^$1', $data);
		$data = json_decode($data,1);
		//foreach ($data as &$node) { $node = html_entity_decode($node); }
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