<?php

class Notes {

    private $bot = null;

    public function plugin_registered($bot) {
        $this->bot = $bot;
    }

    public function notes_getDB() {
        $db = json_decode(file_get_contents('./notes.json'));
        return $db;
    }
    public function readNote() {
    }

}

?>