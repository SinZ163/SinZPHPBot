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

    function _construct() {
        $this->config = $config;
    }
    
    /*
     * Startup Functions
     * 
     * Commands to run after bot is connected to network.
     * 
     * @return bool
     */
    private function startup() {
        
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
    /*
     * @TODO Make this not stupid
     */
    public function network_MODE($prefix, $command, $args) {

        foreach ($this->config['channels'] as $chan) {
            $this->bot->send_message("", "JOIN", $chan);
        }
        if ($this->config['ns_enabled']) {
            $ns_msg = "IDENTIFY " . $this->config['ns_pass'];
            echo $ns_msg;
            $this->bot->say_message($this->config['ns_nickserv'], $ns_msg);
        }
        foreach ($this->config['startup'] as $cmd) {
            $this->bot->send_message("", $cmd);
        }
    }

    public function network_privmsg($prefix, $command, $args) {
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

?>
