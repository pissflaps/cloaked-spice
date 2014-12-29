<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$add = $_POST['id'];

if (($_POST['id'] = '0') || ($_POST['id'] == null)){
	die( "You need to enter the correct ticket number!");
header("refresh:1; url='index.php'");
	}


	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");
 
 // sending query
	if (($add != '0') && ($add != null)){ 
$tickadd = mysql_query("UPDATE tickets SET Deleted = 'R', Removed_Datetime = ' ' WHERE Ticket = '$add'") or die("Could not add your ticket". mysql_error());
}
header("refresh:5; url='index.php'");
?>
