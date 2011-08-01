<?php

class user {

    private $bot = null;

    public function __construct() {
        
    }

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function explodeIP($ip) { // turns $ip which is a string, nick!ident@hostmark into $result which is an array, 0 = nick, 1 = ident, 2 = hostmark
        $address = explode("@", $ip);
        $hostmark = $address[1];
        $nick_ident = explode("!", $address[1]);
        $result = array($nick_ident[0], $nick_ident[1], $hostmark);
        return $result;
    }

    public function implodeIP($result) { // turns $result which is an array, 0 = nick, 1 = ident, 2 = hostmark into $ip which is a string, nick!ident@hostmark
        $nick_ident_A = array($result[0], $result[1]);
        $nick_ident = implode("!", $nick_ident_A);
        $address = array($nick_ident, $result[2]);
        $ip = implode("@", $address);
        return $ip;
    }

    public function getDB() {
        require_once "/core/YAML/spyc.php"; // to get YAML Libarys
        $db = Spyc::YAMLLoad('permissions.yml'); // Now we have the whole thing inside an array, we can have some fun!
        return $db;
    }

    public function writeDB($request) {
        require_once "/core/YAML/spyc.php"; // to get YAML Libarys
        $yaml_db = Spyc::YAMLLoad('permissions.yml'); // Now we have the whole thing inside an array, we can have some fun!
        file_put_contents("test.yml", Spyc::YAMLDump($array)); //Would also work
    }

    public function hasPermission($node, $ip) {
        $user = explodeIP($ip);
        $nick = $user[0];
        $ident = $user[1];
        $hostmark = $user[2];

        return true; // temp fix until finished
    }

    public function IPhasPermission($node, $IP) { // only here untill its all finished.
        return true;
    }

    public function getPassword($user, $attempt) {
        $DB = getDB();
        $password = $DB['users']['SinZ']['Password'];
        if (md5($attempt) == $password) {
            return true;
        }
        else
            return false;
    }

    public function getUser($ip) {
        $DB = getDB();
        foreach ($DB['users'] as $user) {
            
        }
    }

    /* Command Interface for Bans, and group/account controlling */

    public function command_login($user, $channel, $args) { // Syntax: `login USER PASSWORD
        $DB = getDB();
        $ip = explodeIP($hostmark);
        $user = getUser($ip);
    }

}