<?php
$db_host = 'localhost';
$db_user = 'infortel';
$db_pwd = 'T3lemanagement';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$C4= $_POST['TicNum']; 
 
	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");
$result = "UPDATE tickets SET Deleted='R' WHERE Ticket='$C4'";

if(mysql_query($result, $con)){
	echo '1';
 }

?>