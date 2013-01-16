<?php

class operhelper {

    private $bot = null;

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function operhelper($config) {
        $this->config = $config;
    }

    public function command_defcon($user, $channel, $args) {
        if ($this->isAdmin($user)) {
            $defcon = "DEFCON " . $args[0];
            $this->bot->say_message("OPERSERV", $defcon);
            echo $this->bot->say_message("OPERSERV", $defcon);
        }
    }

    function isAdmin($user) {
        foreach ($this->config['admins'] as $admin) {
            if ($user == $admin) {
                return true;
            } else {
                return false;
            }
        }
    }

}

?>