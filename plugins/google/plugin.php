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
    public function command_calc($user, $channel, $args) {
		$calc = implode(" ",$args);
		$data = file_get_contents("http://www.google.com/ig/calculator?hl=en&q=".urlencode($calc));
		$data = preg_replace("/([,{])(.*?):/", '$1"$2":', $data); //hack, convert js to json.
		$data = stripcslashes($data);
		$data = preg_replace("/<sup>(.*?)<\/sup>/", '^$1', $data);
		$data = json_decode($data,1);
		//foreach ($data as &$node) { $node = html_entity_decode($node); }
		$this->bot->say_message($channel, $data["lhs"]." = ".$data["rhs"]);	
		$this->bot->say_message($channel, json_encode(array($data[error], $data[icc], $calc)));
	}
}
?>