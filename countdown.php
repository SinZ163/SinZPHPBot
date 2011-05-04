<?php
// countdown function
// parameters: (year, month, day, hour, minute)
countdown(2010,1,1,0,0);

//--------------------------
// author: Louai Munajim
// website: www.elouai.com
//
// Note:
// Unix timestamp limitations 
// Date range is from 
// the year 1970 to 2038
//--------------------------
function countdown($year, $month, $day, $hour, $minute)
{
  // make a unix timestamp for the given date
  $the_countdown_date = mktime($hour, $minute, 0, $month, $day, $year, -1);

  // get current unix timestamp
  $today = time();

  $difference = $the_countdown_date - $today;
  if ($difference < 0) $difference = 0;

  $days_left = floor($difference/60/60/24);
  $hours_left = floor(($difference - $days_left*60*60*24)/60/60);
  $minutes_left = floor(($difference - $days_left*60*60*24 - $hours_left*60*60)/60);
  
  // OUTPUT
  $msg1 =  "Today's date ".date("F j, Y, g:i a")."<br/>";
  $msg2 =  "Countdown date ".date("F j, Y, g:i a",$the_countdown_date)."<br/>";
  $msg3 =  "Countdown ".$days_left." days ".$hours_left." hours ".$minutes_left." minutes left";
  $this->bot->send_message("","PRIVMSG", $channel, $msg1, $msg2, $msg3);
}
?>