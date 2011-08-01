<?php
class CTCP {
    private $bot = null;
    
    public function __construct() {
        
    }
    public function plugin_registered($bot) {
	$this->bot = $bot;
    }
    public function CTCP_ACTION($user, $msg) {
        $msg = implode(" ", $msg);
        $this->bot->say_message($user, chr(1)."ACTION ".$msg, chr(1));
    }
}
?>
