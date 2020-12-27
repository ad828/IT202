<?php

$zip = $_GET["zip"];

sleep(2);

$url = //apikey hidden

$fp = fopen($url, "r"); //file open read
$contents = ""; 

while ($more = fread($fp, 1000)){
	$contents .= $more;
}

echo $contents;
?>
