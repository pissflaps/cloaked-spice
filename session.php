<?php include("database.php"); 
session_start();
	$OneYear= time()+(60*60*24*365);
$sessid = session_id(); 
// increment a session counter
	$_SESSION['counter']++;
	

	$LoggedIn = True;
	
// echo "You have viewed this page " . $_SESSION['counter'] . " times";

?>