<?php
include ("myfunctions.php");
include("account.php");
$path = "/~ad828/download/";
session_set_cookie_params(0,"$path");
session_start();
if (!isset ($_SESSION["pinpassed"])) {
	echo "<br><br> Redirecting to pin1.php";
	header("refresh: 6; url = pin1.php" );
 exit(); 
 }
?>
<html>
<style>
	form  { border:  3px  solid red;  width: 50%; 
			margin: auto;  margin-top: 5em;}
	#account, #amount {display:none;}
</style>
<form action = "service2.php">

<select name = "menu" id = "menu">
<option value = "S"> Select </option>
<option value = "LT"> List Transaction </option>
<option value = "LA"> List Accounts </option>
<option value = "C"> Clear Account </option>
<option value = "D"> Deposit </option>
<option value = "W"> Widthdraw </option>
</select><br><br>

<div id = "account"><input type = text name = "account"> account </div>
<div id = "amount"><input type = text name = "amount"> amount </div>

<input type = submit>
<script>
var ptrMenu = document.getElementById("menu")
	ptrMenu.addEventListener("change", F)
	
var ptrAccount = document.getElementById("account")
var ptrAmount = document.getElementById("amount")

function F(){
	var v = this.value
if(v == "C") {ptrAccount.style.display = "block"; }
if(v == "D") {ptrAccount.style.display = "block"; ptrAmount.style.display = "block"; }
if(v == "W") {ptrAccount.style.display = "block"; ptrAmount.style.display = "block";}
if(v == "LT") {ptrAccount.style.display = "none"; ptrAmount.style.display = "none";}
if(v == "LA") {ptrAccount.style.display = "none"; ptrAmount.style.display = "none";}
}
</script>
</form>
</html>