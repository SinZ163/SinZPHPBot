<?php
class mcping {
    public function ping($host, $port=25565, $timeout=30) {
        $fp = fsockopen($host, $port, $errno, $errstr, $timeout);
        if (!$fp) return false;

        fwrite($fp, "\xFE\x01");
        $d = fread($fp, 256);
        if ($d[0] != "\xFF") return false;
        $d = substr($d, 3);
        $d = mb_convert_encoding($d, 'auto', 'UCS-2');
        $d = substr($d, 3);
        $d = explode("\x00", $d);
        return array(
            'protocolVersion'   =>  $d[0],
            'minecraftVersion'  =>  $d[1],
            'motd'              =>  $d[2],
            'playerCount'       =>  intval($d[3]),
            'maxPlayers'        =>  intval($d[4])
        );
    }
}
?>