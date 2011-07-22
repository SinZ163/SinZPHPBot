<?php

set_time_limit(0);
ini_set('display_errors', 'on');

include("config.php");

function __autoload($class_name) {
    include 'core/' . $class_name . '.php';
}

$bot = new Bot($config);
$bot->init();
$bot->start();
