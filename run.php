<?php
include("config.php");

function __autoload($class_name) {
	include 'core/'. $class_name .'.php';
}
function __pluginload() {
    foreach($config['plugins'] as $plugin){
        include "./plugins/".$plugin."/plugin.php";
        $bot->plugin_register(new $plugin($config));
    }
}
$core = new core($config);
$command = new command($config);
$user = new user($config);
//$crypt = new crypt($config);

$bot = new bot($config['network'],$config['port'],$config['nick'],$config['ident'],$config['realname']); //start bot and use defaults.
$bot->plugin_register(new core($config));
$bot->plugin_register(new command($config));
$bot->plugin_register(new user($config));
include "./plugins/Minecraft2/plugin.php";
$bot->plugin_register(new Minecraft2($config));
//$bot->plugin_register(new CTCP($config));
//$bot->plugin_register(new crypt($config));
/* Load Other Plugins */

$bot->start();
?>
