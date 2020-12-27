<?php
session_start();

$font = 'LaBelleAurore.ttf';

header('Content-Type: image/png');

$im = imagecreatetruecolor(310,80);

$white = imagecolorallocate($im, 255,255,255);
$black = imagecolorallocate($im, 0,0,0);
$blue = imagecolorallocate($im, 77,166,255);
$yellow = imagecolorallocate($im, 243,255,77);
$red = imagecolorallocate($im, 255,0,0);
$green = imagecolorallocate($im, 0,255,0);

imagefilledrectangle($im, 0,0,310,80, $blue);
imagefilledrectangle($im, 8,8,300,68, $yellow);

$text = substr(str_shuffle(md5(time())),0,4);
$text2 = substr($text,0,2);
$text3 = substr($text,2,4);

$_SESSION["captcha"] = $text;
imagettftext($im, 32, 10, 105, 50, $red,$font, $text2);
imagettftext($im, 32, -9, 185, 50, $green,$font, $text3);
imagestring($im, 0, 8, 60, "Session ID:".session_id(), $black);
imagestring($im, 0, 8, 52, "Captcha:".$text, $black);

imagepng($im);
imagedestroy($im);

?>