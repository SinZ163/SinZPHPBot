<?php
class mcping {
    public function ping($ip, $port) {
        $fp = fsockopen($ip, $port, $errno, $errstr, 5); // Socket for connecting to server
        
        if (!$fp) { 
            return false;
        } else {
            $out = "\xFE"; // Hex needed for server info
        
            fwrite($fp, $out);
            while (!feof($fp)) {
                $result .= fgets($fp, 128);
            }
            fclose($fp);
            
            // Remove extra spaces between characters
            $result = str_replace("\x00", "", $result); 
            $result = str_replace("\x1A", "", $result); 
            $result = str_replace("\xFF", "", $result);
            $result = str_replace("\x0017", "", $result);
            
            $srvinfo = explode("\xA7",$result); 
            
            return array("motd" => $srvinfo[0], "players" => $srvinfo[1], "max_players" => $srvinfo[2]);
        }
    }
}
?>