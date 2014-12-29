<?php
session_start();
session_destroy();

if( isset($_COOKIE['LoggedInAs']) ) {
setcookie("logbar", null);		
setcookie("LoggedInAs", null);		
setcookie("LoginPass", null);		
header("refresh:1; url='index.php'");
}

else {
setcookie("logbar", null);		
header("refresh:1; url='index.php'");
}
?>