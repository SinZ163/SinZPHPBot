<?php
class mcping {
    public function ping($host, $port=25565, $timeout=30) {
    	$fp = fsockopen($host, $port, $errno, $errstr, $timeout);
    	if (!$fp) return false;
    
    	fwrite($fp, "\xFE");
    	$d = fread($fp, 256);
    	if ($d[0] != "\xFF") return false;
    	$d = substr($d, 3);
    	$d = mb_convert_encoding($d, 'auto', 'UCS-2');
    	$d = explode("\xA7", $d);
    	return array(
    		'motd'        =>        $d[0],
    		'players'     => intval($d[1]),
    		'max_players' => intval($d[2]));
    }
}
?>