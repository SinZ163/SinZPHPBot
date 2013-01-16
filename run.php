<?php
require_once("config.php");

function __autoload($class_name) {
    include 'core/'. $class_name .'.php';
}
$core = new core($config);
$command = new command($config);
$user = new user($config);
$bot = new bot($config, $user); //start bot and use defaults.
$bot->plugin_register(new core($config));
$bot->plugin_register(new command($config));
$bot->plugin_register(new user($config));
$bot->start();
?>
