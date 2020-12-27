<?php

$path = "/~ad828/download/";
session_set_cookie_params(0,"$path");
session_start();
//if logged not true then redirect to html 
if (!isset ($_SESSION["logged"])) {
	echo "<br><br> Redirecting to auth.php";
	header("refresh: 6; url = auth.php" );
 exit(); 
 }
 
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

//pin handling

$pin = mt_rand(10000, 99999);
$_SESSION["pin"] = $pin;

$to = "ad828@njit.edu";
$subject = "pin";
$message = $pin;

mail($to, $subject, $message);

echo "<br> PIN is $pin. <br>";

echo "<br> Hello, reached pin.php";

?>
<form action = "pin2.php">
<input type = text name = "pin"> Enter PIN <br>
<input type = submit>
</form>
