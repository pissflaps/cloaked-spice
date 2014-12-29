<?php
session_start();
session_destroy();

if( isset($_COOKIE['LoggedInAs']) ) {
$user = $_COOKIE['LoggedInAs'];
setcookie("logbar", "", time()-3600);		
setcookie("LoggedInAs", "", time()-3600);		
setcookie("LoginPass", "", time()-3600);		
header("refresh:1; url=". $_SERVER['HTTP_REFERER']);
require('database.php'); 		
	date_default_timezone_set('America/Chicago');
		$IP = $_SERVER['REMOTE_ADDR'];
		$LastLogged = "L_".date('n/j/Y \@ g:i A');
		?>

<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>		
<script type="text/javascript">
				$.removecookie('LoggedInAs');
</script>
<?php
mysql_query("UPDATE dbase.members SET IP='$IP', LastLoggedIn='$LastLogged' WHERE username='$user'") or die("Could not update LastLoggedIn!". mysql_error() );
}

else {
setcookie("logbar", "", time()-3600);		
header("refresh:1; url=". $_SERVER['HTTP_REFERER']);
}
?>