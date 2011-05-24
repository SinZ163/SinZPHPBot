<?php
function sinz_google_search($args) {
	$search = implode("+", $args);
	$url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".$search;
	$result = json_decode($url, true);
	echo $test;
	return $result;
}
?>