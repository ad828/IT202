<?php

$zip = $_GET["zip"];

sleep(2);

$url = "http://api.openweathermap.org/data/2.5/weather?zip=$zip,us&units=imperial&appid=be56faaf8c137922eb311ef5a990c7d5";

$fp = fopen($url, "r"); //file open read
$contents = ""; 

while ($more = fread($fp, 1000)){
	$contents .= $more;
}

echo $contents;
?>
