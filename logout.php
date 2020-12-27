<?php
$path = "/~ad828/download/";
session_set_cookie_params(0,"$path","web.njit.edu");
session_start();

$sid = session_id();
echo  "<br>Session on $path started with session id $sid.";

$SESSION = array();
session_destroy();
setcookie("PHPSESSID","",time()-3600,$path,"",0,0);

echo "Session Terminated";
echo "<br> To see effect reconnect to site";
?>