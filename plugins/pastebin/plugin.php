<?php

class pastebin {

    private $bot;

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function command_g($user, $channel, $args) {
        $api_dev_key = '854744ef013ffd6d40d88fb783cc6d79'; // your api_developer_key
        $api_msg = implode(" ", $msg);
        $api_paste_code = urlencode($api_msg);


        $url = 'http://pastebin.com/api/api_post.php';
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '?api_option=paste&api_dev_key=' . $api_dev_key . '&api_paste_code=' . $api_paste_code . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 0);

        $response = curl_exec($ch);
        return $response;
    }

}
?>
