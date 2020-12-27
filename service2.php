<?php
$path = "/~ad828/download/";
session_set_cookie_params(0,"$path");
session_start();
include ("myfunctions.php");
include("account.php");
if (!isset ($_SESSION["pinpassed"])) {
	echo "<br><br> Redirecting to pin1.php";
	header("refresh: 6; url = pin1.php" );
 exit(); 
 }
$db = mysqli_connect($hostname,$username,$password,$project);
if(mysqli_connect_errno()){
	echo "Failed to Connect to MySQL:".mysqli_connect_error();
	exit();
}
print "Sucessfully Connected to MySQL. <br><br><br>";
mysqli_select_db($db,$project);
$ucid = $_SESSION["ucid"];
echo "ucid is $ucid";
 $menu = safe("menu");

 if($menu == "LT"){list_transactions($ucid,$db);}
  if($menu == "LA"){list_accounts($ucid,$db);}
   if($menu == "C"){$account = safe("account");clear($ucid,$account,$db);}
    if($menu == "D"){$account = safe("account"); $amount = safeamount("amount"); preform_transaction($ucid, $account, $amount, $db);}
	if($menu == "W"){$account = safe("account"); $amount = safeamount("amount"); $amount = -abs($amount);preform_transaction($ucid, $account, $amount, $db);}
?>

<br><br>
<a href= "service1.php">Back</a>
<br><br>
<a href= "logout.php">Log Out</a>
