<?php
$path = "/~ad828/download/";
session_set_cookie_params(0,"$path");
session_start();

$captcha = $_SESSION["captcha"];
$guess = $_GET["guess"];

if(isset($_GET["guess"])) {
	
if($captcha == $guess){
	echo "Good Redirect";
	$_SESSION["captchapassed"] = true;
	header("refresh:3;url = auth.php");
	exit();
}
else{
	echo "Bad redirect";
	header("refresh:3;url = captchatest-reentrant.php");
	exit();
}
;}
?>
<img src = "captcha.php"><br><br>
<form action = "captchatest-reentrant.php">
<input type = text name = "guess" value = "" autocomplete = "off" >Reentrant Captcha<br>
<input type = submit>
</form>
