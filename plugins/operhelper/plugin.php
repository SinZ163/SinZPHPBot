<?php

/**
 * OperHelper
 *
 * A simple plugin to help opers with their tedious tasks.
 *
 * @author		clone1018
 * @copyright           Copyright (c) 2008 - 2011, Axxim
 * @link		http://axxim.net/
 * @since		Version 1.0
 */
class operhelper {

    public function __construct() {
        $this->config = $config;
        $this->bot = $bot;
        $this->user = $user;
        //$this->plugin = json_decode(file_get_contents('plugin.json'));
    }

    /**
     * Defcon Command
     *
     * @return	void
     */
    public function defcon($user, $channel, $args) {
        if ($this->isAdmin($user)) {
            $defcon = "DEFCON " . $args[0];
            $this->bot->say_message("OPERSERV", $defcon);
            echo $this->bot->say_message("OPERSERV", $defcon);
        }
    }

    /**
     * hasoper Function
     *
     * @return	boolean
     */
    private function hasoper() {
        if ($this->user->oper($user)) {
            return true;
        } else {
            return false;
        }
    }

}