<?php
include("config.php");

function __autoload($class_name) {
	include 'core/'. $class_name .'.php';
}
function __pluginload($plugin) {
    include "plugins/".$plugin.'/plugin.php';
    $this->plugin_register(new $plugin());
}
$core = new core($config);
$command = new command($config);
$user = new user($config);

$bot = new bot($config['network'],$config['port'],$config['nick'],$config['ident'],$config['realname']); //start bot and use defaults.
$bot->plugin_register(new core($config));
$bot->plugin_register(new command($config));
$bot->plugin_register(new user($config));
$bot->plugin_register(new CTCP($config));
/* Load Other Plugins */
foreach($config['plugins'] as $plugin){
    include "./plugins/$plugin/plugin.php";
    $bot->plugin_register(new $plugin($config));
}

$bot->start();
?>
