<?php
require('database.php');

if(isSet($_COOKIE['LoggedInAs']))
{
$cookie_name = $_COOKIE['LoggedInAs'];
$usr = $_COOKIE['LoggedInAs'];
$hash = $_COOKIE['LoginPass'];

	// Check if the cookie exists
if(isSet($_COOKIE[$cookie_name]))
	{
	parse_str($_COOKIE['LoggedInAs']);

	// Make a verification

	if(isset($usr ) && (isset($hash ) ) )
		{
		// Register the session
		$_SESSION['myusername'] = $usr;
		$_SESSION['auth'] = 1;
		$UPDATE= mysql_query("UPDATE members SET IP='$IP', LastLoggedIn='$LastLogged' WHERE username='$user'") or die("Could not update LastLoggedIn" . mysql_error() );
				if($UPDATE == 1){
						$Uuser = ucwords($user);
				$do_login = true;
				$_POST['username'] = $_COOKIE['LoggedInAs'];
				$_POST['password'] = $_COOKIE['LoginPass'];
				include_once 'do_login.php';
				}
				else {
				header("Location: index.php");
				}
		exit;
		}
	}
}
?>