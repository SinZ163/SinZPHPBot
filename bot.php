<?php
include("config.php");

function __autoload($class_name) {
	include 'core/'. $class_name .'.php';
}
$core = new core();
$command = new command();

$bot = new bot($config['network'],$config['port'],$config['nick'],$config['ident'],$config['realname'],$config['channels']); //start bot and use defaults.
$bot->plugin_register(new core());
$bot->plugin_register(new command());
$bot->start();
?>
