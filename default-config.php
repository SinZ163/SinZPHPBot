<?php

/**
* SinZBot Configuration File
*
* Please change the name of this file from default-config.php to config.php
* 
*/
$config['plugins'] = array(
    'plugin1',
    'plugin2',
    'plugin3'
);

$config['network'] = 'irc.network.tld';
$config['port']    = '6667';
$config['ssl']     = false; // NOT READY YET
$config['nick']    = 'SinZBot';
$config['ident']   = 'SinZBot';
$config['realname']= 'SinZBot';
$config['command'] = '!';

$config['channels']= array('#sinzbot');
$config['admins']  = array('SinZ');
						

/* Nick Server */
$config['ns_enabled'] = false;
$config['ns_nickserv'] = 'NickServ';
$config['ns_pass'] = 'qwertyuiop';
$config['ns_sla'] = false;

/* FAQ */
$config['faq_enabled'] = false;
$config['faq_prefix'] = "?";
$config['faq_admin'] = array("SinZ");

/* CTCP */
$config['ctcp_ping']    = 'default';
$config['ctcp_version'] = 'SinZBot';

/* Experimental */
$config['host']    = 'axxim.net';