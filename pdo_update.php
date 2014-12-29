<?php
// configuration
error_reporting(E_ALL ^ E_NOTICE); 

$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
				
// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

if(empty($_GET['check1'])){
	 $Zticket1 = null;
	 }	
	 else {
		$Zticket1 = $_GET['check1'];
	 }
	if (empty($_GET['check2'])){
		$Priority1 = null;
		}
		else {
			$Priority1 = $_GET['check2'];
			}
		if(empty($_GET['check3'])){
				$Comments1 = null;
				}
				else {
					$Comments1 = $_GET['check3'];
					}
				if(empty($_GET['check4'])){
					$Sname1 = null;
					}
					else {
						$Sname1 = $_GET['check4'];
						}
	


// new data

$Zticket = $Zticket1;
$priority = $Priority1;
$comments = filter_var($Comments1, FILTER_SANITIZE_STRING);
$Rdatetime = " ";
$removed = "";
$siteName = filter_var($Sname1, FILTER_SANITIZE_STRING); 
$deleted = "R"; 
 
// query
$sql = "UPDATE tickets 
        SET Ticket=?, Priority=?, Site=?, Comments=?, Deleted=?, Removed_Datetime=?, removedby=?,
		WHERE Ticket=?";
$q = $conn->prepare($sql);
$q->execute(array($Zticket,$Priority,$Sname,$Comments, $deleted, $Rdatetime, $removed, $Aticket));


?>
