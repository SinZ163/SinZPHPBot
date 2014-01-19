<?php
class wolfram {
    private $bot = null;
    public function plugin_registered($bot) {
        $this->bot = $bot;
        //include_once("WolframAlphaEngine.php");
        //$this->wolfram = new WolframAlphaEngine("LV28TW-RA783QRGUK");
    }
    public function Parse($url) {
        $fileContents= file_get_contents($url);
        $simpleXml = simplexml_load_string($fileContents);

        return $simpleXml;
    }
    public function getResults($args) {
        $url = "http://api.wolframalpha.com/v1/query.jsp";
        $appID = "LV28TW-RA783QRGUK";
        $input = implode(" ",$args);
        $xml = $this->Parse($url."?appid=".urlencode($appID)."&input=".urlencode($input));
        $results = array();
        foreach($xml->pod as $pod) {
            // skip input pod
            if($pod['id'] == "Input") continue;

            foreach($pod->subpod as $subpod) {
                if(!empty($subpod->plaintext)) {
                    $text = $subpod->plaintext;
                    if(strpos($subpod->plaintext, ': ') === false)
                        $text = str_replace(' | ', ': ', $text);
                    $text = str_replace(array("\r", "\n"), ' | ', $text);
                    $text = trim($text, ' |');
                    $results[] = "\002{$pod['title']}:\002 {$text}";
                    break;
                }
            }
        }
        return $results;
    }
    public function command_wolfram($user, $channel, $args) {
        $results = $this->getResults($args);
        
        print_r($results);
        foreach($results as $line)
            $this->bot->privmsg($channel, $line);
    }
}