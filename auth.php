<?php
//start session and variables
$path = "/~ad828/download/";
session_set_cookie_params(0,"$path");
session_start();
include ("myfunctions.php");
include("account.php");

$captcha = $_SESSION["captcha"];
$captchapassed = $_SESSION["captchapassed"];
$guess = $_GET["guess"];
$pass = $_GET["pass"];
//barrier on captchapassed
if($captchapassed){
	echo "Good Captcha";
}
else{
	echo "Bad redirect";
	header("refresh:3;url = captchatest-reentrant.php");
	exit();
}
;
//usual DB, error report
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
$db = mysqli_connect($hostname,$username,$password,$project);
if(mysqli_connect_errno()){
	echo "Failed to Connect to MySQL:".mysqli_connect_error();
	exit();
}
print "<br><br> Sucessfully Connected to MySQL. <br><br><br>";
mysqli_select_db($db,$project);



//new authenticate function
if(isset($_GET["ucid"])) {
$ucid = safe("ucid");
$pass = safe("pass");
if(!authenticate ($ucid,$pass,$db)) {
echo "Invalid Credentials";
}else{
	//redirect to pin1.php
	$_SESSION["logged"] = true;
	$_SESSION["ucid"] = $ucid;
	echo "Redirecting to pin1.php";
	header ("refresh: 6; url =  pin1.php");
}
}
//new safe function (in service 2)
?>
<html>
<!-- auth.html from previous -->
<style>
	form  { border:  3px  solid red;  width: 50%; 
			margin: auto;  margin-top: 5em; padding: 20px; }
</style>
<!-- reentrant auth with sticky creds-->
<form action="auth.php" >

<input type = text name = "ucid" autocomplete = "off" value = ""> ucid <br>
<input type = text name = "pass" 
value = "<?php echo $pass; ?>">password<br>

<input type = submit value = "Submit">
</form>

</html>