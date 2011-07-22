<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of plugin
 *
 * @author clone1018
 */
class general {

    private $bot = null;

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

}

?>
