<?php
/**
 * Core
 *
 * A simple plugin to help opers with their tedious tasks.
 *
 * @author		ylt, SinZ, clone1018
 * @version             2.0
 */
class Core extends Bot {

    function __construct() {
        $this->config = $config;
    }
    
    /*
     * Network Ping
     * 
     * On Ping return Pong
     * 
     * @return string
     */
    public function ping($server) {
        $this->bot->raw("PONG ", $server);
    }
    
    public function privmsg() {
        $message = explode(" ", $args[1]);
        if ($message[0][0] == $this->config['command']) { //command
            //args: user, channel, arguments
            $this->bot->plugin_event("command_" . substr($message[0], 1), $prefix, $args[0], array_splice($message, 1));
        } else {
            //cba
            //$this->bot->plugin_event("message);
        }
    }
}
