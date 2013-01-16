<?php
class mcquery {
	public function query($ip, $port) {
		$output = null;
		$path = realpath('.');
		$path .= '/plugins/Minecraft2';
		if (php_uname('s') == "Windows NT") { $python = "C:\\Python27\\python.exe ";}
		else $python = "python ";
		exec($python.$path.'/demo.py '.$ip.' '.$port, $output); //
		return json_decode($output[0]);
	}
}
?>