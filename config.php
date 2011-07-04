<?php

/**
* SinZBot Configuration File
*
* Please change the name of this file from default-config.php to config.php
* 
*/
$config['plugins'] = array(
    'channel_commands',
    'minecraft',
    'google'
);

$config['network'] = 'irc.esper.net';
$config['port']    = '6667';
$config['ssl']     = false; // NOT READY YET
$config['nick']    = 'cloneBot';
$config['ident']   = 'cloneBot';
$config['realname']= 'cloneBot';
$config['command'] = '.';

$config['channels']= array('#sinzbot');
$config['admins']  = array('clone1018');
						

/* Nick Server */
$config['ns_enabled'] = false;
$config['ns_nickserv'] = 'NickServ';
$config['ns_nick'] = 'MCABot';
$config['ns_pass'] = 'qwertyuiop';
$config['ns_sla'] = false;

/* CTCP */
$config['ctcp_ping']    = 'default';
$config['ctcp_version'] = 'cloneBot';

/* Experimental */
$config['host']    = 'axxim.net';