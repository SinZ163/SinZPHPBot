<?php
function bot_ranks($user, $channel, $network) {
	$userdb = array();
	$config = "ops.txt";
	$doc  = new DOMDocument();
	$doc->load($config);
	$users = $doc->getElementsByTagName("user");
	foreach($users as $person) {
		$persondb = array();
		$id = $person->getElementsByTagName("id");
		$server = $person->getElementsByTagName("network");
		$chan = $person->getElementsByTagName("channel");
		$persondb["id"] = $id;
		$persondb["network"] = $server;
		$persondb["channel"] = $chan;
		array_push($userdb, $persondb);
	}
	foreach ($userdb as $person) {
		if ($person["network"] == $network) {
			if ($person["channel"] == $channel) {
				if ($person["id"] == $user) {
					$output = true;
				}
				else $output = false;
			}
			else $output = false;
		}
		else $output = false;
		$test = implode(" ", $person);
		echo $test;
	}

	return $output;
}
?>