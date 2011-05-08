<?php
/*
 *
 */

$config['network'] = 'irc.esper.net';
$config['port']    = 3306;
$config['ssl']     = false; // NOT READY YET
$config['nick']    = 'cloneBot';
$config['ident']   = 'cloneBot';
$config['realname']= 'cloneBot';

$config['channels']= array('#bottest', '#sinzbot');
$config['admins']  = array('SinZ','clone1018');
						

/* Nick Server */
$config['ns_user'] = 'cloneBot';
$config['ns_pass'] = 'test';
$config['ns_sla'] = false;  // Whatever that shit is called.

/* CTCP */
$config['ctcp_ping']    = 'default';
$config['ctcp_version'] = 'SinZBot';

/* Experimental */
$config['host']    = 'axxim.net';