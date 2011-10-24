<?php
class mcping {
    public function ping($host, $port=25565, $timeout=30) {
        //Set up our socket
        $fp = fsockopen($host, $port, $errno, $errstr, $timeout);
        if (!$fp) return false;

        //Send 0xFE: Server list ping
        fwrite($fp, "\xFE");

        //Read as much data as we can (max packet size: 241 bytes)
        $d = fread($fp, 256);

        //Check we've got a 0xFF Disconnect
        if ($d[0] != "\xFF") return false;

        //Remove the packet ident (0xFF) and the short containing the length of the string
        $d = substr($d, 3);

        //Decode UCS-2 string
        $d = mb_convert_encoding($d, 'auto', 'UCS-2');

        //Split into array
        $d = strreplace("", "\a011", $d);
        $d = explode("\xA7", $d);

        //Return an associative array of values
        return array(
            'motd'        =>        $d[0],
            'players'     => intval($d[1]),
            'max_players' => intval($d[2]));
    }
}
?>