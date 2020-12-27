<?php
include ("myfunctions.php");
include("account.php");
$path = "/~ad828/download/";
session_set_cookie_params(0,"$path");
session_start();
//if logged not true then redirect to html 
if (!isset ($_SESSION["pin"])) {
	echo "<br><br> Redirecting to pin1.php";
	header("refresh: 6; url = pin1.php" );
 exit(); 
 }
 
 
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
include("account.php");
$db = mysqli_connect($hostname,$username,$password,$project);
if(mysqli_connect_errno()){
	echo "Failed to Connect to MySQL:".mysqli_connect_error();
	exit();
}
print "Sucessfully Connected to MySQL. <br><br><br>";
mysqli_select_db($db,$project);

$pin = safe("pin"); echo "<br>pin: $pin"; $pin= mysqli_real_escape_string($db,$pin);
$pinreal = $_SESSION["pin"];

if($pinreal != $pin){
	echo "<br><br>Bad Pin redirect to pin1.php";
	header ("refresh: 6, url =  pin1.php");
	exit();
}else{
	//redirect to service.php
	echo "<br><br> Redirect to service1.php";
	header ("refresh: 6; url =  service1.php");
	$_SESSION["pinpassed"] = true;
	exit();
}

echo "<br>PIN is $pin <br>";


?>
