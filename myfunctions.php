<?php
include("account.php");
//usage $ucid = safe("ucid");
function safe($fieldname){
	global $gooddata;
	global $db;
	$v = $_GET[$fieldname];
	$v = trim($v);
	echo "<br>$fieldname is $v<br>";
	
	if ($fieldname == "ucid"){
		$count = preg_match('/^[a-z]{2,4}[0-9]{0,3}$/i',$v,$matches);
		if($count == 0){
			$gooddata = false; echo "Bad Ucid<br>";
		return "Illegal ucid format";
	}
}
return $v;
}

function safeamount($fieldname){
	global $gooddata;
	global $db;
	$sa = $_GET[$fieldname];
	$sa = trim($sa);
	echo "<br>$fieldname is $sa<br>";
	
	if ($fieldname == "amount"){
		$count = preg_match('([0-9]+(\.[0-9]+)?)',$sa,$matches);
		if($count == 0){
			$gooddata = false; echo "Bad Number Format<br>";
		return "Illegal Num format";
	}
}
return $sa;
}
function authenticate($ucid,$password,$db){
	$s = " select * from Users where ucid = '$ucid' and pass = '$password'";
	echo "<br> sql select: $s <br><br>";
	($t=mysqli_query($db,$s)) or die(mysqli_error($db));
	$num = mysqli_num_rows($t);
	echo "<br>Number of Rows for ucid $ucid is: $num<br>";
	//Exit if ucid Does not Exist
		if($num==0){ echo "Bad Ucid."; return false;}
		//retrieve has for ucid after verify
			$r = mysqli_fetch_array($t, MYSQLI_ASSOC);
			$hash = $r['hash'];
			echo "<br> Retrieved hashed pw for $ucid is $hash<br><br>";
				//verify pw inputted.
				if(password_verify($password,$hash)){
				return true;
				}else{
				return false;
				}
	}
	
function list_transactions($ucid,$db) {
	$s = "select * from Transactions where ucid = '$ucid'";
	echo "<br> sql select: $s <br><br>";
	($t=mysqli_query($db,$s)) or die(mysqli_error($db));
	echo "<br> SQL list transactions";
		while ($r = mysqli_fetch_array($t,MYSQLI_ASSOC)){
		$ucid = $r["ucid"];
		$amount = $r["amount"];
		$account = $r["account"];
		$timestamp = $r["timestamp"];
		echo "<br> ucid = $ucid || acc = $account || amt = $amount || time = $timestamp";
		//good
}}

//invoke @ execute service
function preform_transaction($ucid, $account, $amount, $db){
		$s = "update Accounts set balance = balance +'$amount',mostRecentTransaction = NOW() where account = '$account' and ucid = '$ucid' and balance + '$amount' >=0 ";
		echo "<br>sql update: $s <br><br>";
		($t = mysqli_query($db,$s)) or die (mysqli_error($db));
		
	/*$count = mysqli_affected_rows($t);
	if ($count == 0){
		echo "not updated";
		return;
	}
	*/
	$s = "insert into Transactions values ('$ucid','$account','$amount',NOW() )";
	echo "<br>sql insert: $s";
	($t = mysqli_query($db,$s)) or die (mysqli_error($db));
 //update accounts
}

function widthdraw($ucid,$account,$amount,$db){
	$s = "update Accounts set balance = balance -'$amount',mostRecentTransaction = NOW() where account = '$account' and ucid = '$ucid' and balance + '$amount' >=0 ";
	echo "<br>sql update: $s <br><br>";
		($t = mysqli_query($db,$s)) or die (mysqli_error($db));
		
	$count = mysqli_affected_rows($t);
	if ($count == 0){
		echo "not updated";
		return;
	}
	$s = "insert into Transactions values ('$ucid','$account','$amount',NOW() )";
	echo "<br>sql insert: $s";
	($t = mysqli_query($db,$s)) or die (mysqli_error($db));
	
}

//once for a widthdrawal and once for deposite
function list_accounts($ucid,$db){
	$s = "select * from Accounts where ucid = '$ucid'";
	echo "<br> sql select: $s <br><br>";
	($t=mysqli_query($db,$s)) or die(mysqli_error($db));
	echo "<br> SQL list Accounts";
while ($r = mysqli_fetch_array($t,MYSQLI_ASSOC)){
	$account = $r["account"];
echo "<br> account is $account";
}
}

function clear($ucid,$account,$db){
	//delete
	$s = "delete from Transactions where ucid = '$ucid' and account = '$account'";
	echo "<br>sql delete<br>";
	($t = mysqli_query($db, $s)) or die(mysqli_error($db));
	echo"delete suceeded<br>";
	//update
	$s = "update Accounts set balance= 0.00, mostRecentTransaction = NOW() where ucid = '$ucid' and account = '$account'";
	echo "<br> sql update";
	($t = mysqli_query($db, $s)) or die(mysqli_error($db));
	echo"update suceeded<br>";
	
	
	
}

