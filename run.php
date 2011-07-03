<?php
include("config.php");

function __autoload($class_name) {
	include 'core/'. $class_name .'.php';
}
function __pluginload($plugin) {
    include "plugins/".$plugin.'/plugin.php';
    $this->plugin_register(new $plugin());
}
$core = new core();
$command = new command();
$user = new user();

$bot = new bot($config['network'],$config['port'],$config['nick'],$config['ident'],$config['realname'],$config['channels']); //start bot and use defaults.
$bot->plugin_register(new core($config['channels']));
$bot->plugin_register(new command());
$bot->plugin_register(new user());
$bot->plugin_register(new CTCP());
$bot->start();
?>
