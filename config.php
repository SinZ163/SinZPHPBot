<?php
/* Config for SinZBot!
 *
 */

$config['network'] = 'irc.synirc.net';
$config['port']    = '6667';
$config['ssl']     = false; // NOT READY YET
$config['nick']    = 'MCABot`';
$config['ident']   = 'SinZBot';
$config['realname']= 'cloneBot';
$config['command'] = '`';

$config['channels']= array('#bottest', '#sinzbot');
$config['admins']  = array('SinZ', 'clone1018');
						

/* Nick Server */
$config['ns_user'] = 'cloneBot';
$config['ns_pass'] = 'test';
$config['ns_sla'] = false;  // Whatever that shit is called.

/* CTCP */
$config['ctcp_ping']    = 'default';
$config['ctcp_version'] = 'SinZBot';

/* Experimental */
$config['host']    = 'axxim.net';