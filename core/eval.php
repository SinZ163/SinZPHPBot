<?php
Class evaluate extends Thread {
    private $message = null;
    public function evaluate($message) {
        $this->message = $message;
    }
	public function run() {
        return eval("return ".$this->message);
	}
}