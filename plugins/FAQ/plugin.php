<?php

class FAQ {

    private $bot = null;

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function faq($subject) {
        $subject = ucwords(strtolower(implode(" ", $subject)));
        $file = file("faq/".$subject.".txt");
        foreach ($file as $faq) {
            $this->bot->notice($user,$faq);
        }
    }
    public function command_faqadd($user, $channel, $args) {
		echo $user;
		if (faq::isAllowed($user)) {
			$subject = $args[0];
			$this->bot->notice($user,"Added FAQ Entry for ".$subject.".");
			$fp=fopen("faq/".ucwords(strtolower($subject)).".txt","a");
			fwrite($fp,$subject.": ".implode(" ",array_splice($args, 1))."\r\n");
			fclose($fp);
		}
		else $this->bot->notice($user,"You are not authorised to add FAQ Entrys");
    }
	public function isAllowed($user) {
		$hostmark = user::explodeIP($user);
		echo $hostmark[0];
		if ($this->config['faq_admin'][1]) {
			foreach ($this->config['faq_allowed'] as $allowed) {
				if ($hostmark[0] == $allowed) {
					return true;
				}
			}
		}
		elseif ($hostmark[0] == $this->config['faq_admin']) {
			return true;
		}
		return;
	}

}

?>	