<?php require_once("session.php");

	if(! isset($_SESSION['myusername'])) {
			$user = $_COOKIE['LoggedInAs'];
				if(empty($_COOKIE['LoggedInAs']) ){
					$user = $_SERVER['REMOTE_ADDR'];
				}
	}
		else{
			$user = $_SESSION['myusername'];
		}
if(isset($_POST['id'])) {
	   $con = mysql_connect("localhost","root","Isi_supp0rt") or die(mysql_error());
		mysql_select_db("dbase", $con);

			$id = $_POST['id'];
		
			mysql_query("UPDATE dbase.tickets SET Deleted='X', Removed_Datetime = NOW(), removedby='$user'  WHERE Ticket=$id") or die("Could not remove your ticket. <br>".mysql_error());
		// mysql_query("DELETE FROM tickets where Ticket=$id") or die("Could not remove your ticket");
		mysql_close($con);
	}
	else {
	echo "Could not remove your ticket,Please <a href='javascript: history.go(-1)'>go back</a> and make sure you enter the correct ticket number.";
	}
?>