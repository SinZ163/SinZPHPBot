<?php
function rss($url, $channel) {
	$RSS_Content = array();
	$doc  = new DOMDocument();
	$doc->load($url);
	$channels = $doc->getElementsByTagName("channel");
	foreach($channels as $channel)
	{
		$items = $channel->getElementsByTagName("item");
		foreach($items as $item)
		{
			$y = array();
			//Title tag
			$tnl = $item->getElementsByTagName("title");
			$tnl = $tnl->item(0);
			$title = $tnl->firstChild->textContent;
			//Link tag
			$tnl = $item->getElementsByTagName("link");
			$tnl = $tnl->item(0);
			$link = $tnl->firstChild->textContent;
			//pubDate tag
			$tnl = $item->getElementsByTagName("pubDate");
			$tnl = $tnl->item(0);
			$date = $tnl->firstChild->textContent;		
			//Description tag
			$tnl = $item->getElementsByTagName("description");
			$tnl = $tnl->item(0);
			$description = $tnl->firstChild->textContent;
			//Lets put it into an array
			$y["title"] = $title;
			$y["link"] = $link;
			$y["date"] = $date;		
			$y["description"] = $description;
			$y["type"] = $type;
			//Now add it into the scripts database
			array_push($RSS_Content, $y);
		}
	}
	//Now we have downloaded the rss feed, and got everything we want out of it, lets send it
	return $RSS_Content;
}
?>