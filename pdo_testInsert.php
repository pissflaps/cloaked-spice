<?php 

function Submit() {
	// configuration
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "dbase";
$dbuser		= "root";
$dbpass		= "";

	// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

	// new data
$ticket = $_POST['ticket'];
$siteName = $_POST['siteName'];
$priority = $_POST['priority'];
$comments = filter_var($_POST['Comments'], FILTER_SANITIZE_STRING);
$removed = "";
$siteName = filter_var($_POST['siteName'], FILTER_SANITIZE_STRING); 

	// query
$sql = "INSERT INTO tickets (Ticket,Date,STime,ETA,Priority,Site,Comments,Deleted,Removed_Datetime,removedby) VALUES (:ticket, DATE_FORMAT(CURDATE(),'%c/%e/%Y'), CURTIME(),ADDTIME(CURTIME(),'02:00:00'), :priority, :siteName, :Comments, :removed, NOW(),'' )";

$q = $conn->prepare($sql);
	
$q->execute(array(':ticket'=>$ticket, 
					':priority'=>$priority,
					':siteName'=>$siteName,
					':Comments'=>$comments,
					':removed'=>$removed,
		));
		echo '1';	
};	

	if ($_POST['siteName'] == 'Site Name'){
		echo "<strong>Invalid Site Name.</strong> Please go back and check your information.";
		echo "<br><br> Please use <a href='http://tac-alert01/tickadd.php' target='_NEW' >Tac's Ticket Adder</a> if your ticket needs to be re-added to the queue. <br> Or <a href='javascript: history.go(-1)'>go back</a> and make sure you enter the correct ticket number.<p style='display:none;'>";
	}
	if ( empty($_POST['ticket'] ) || (strlen($_POST['ticket']) < 6) ){
			echo "<strong>Sorry</strong>, you did not enter a valid ticket number.";
			echo "<br><br> Please use <a href='http://tac-alert01/tickadd.php' target='_NEW' >Tac's Ticket Adder</a> if your ticket needs to be re-added to the queue. <br> Or <a href='javascript: history.go(-1)'>go back</a> and make sure you enter the correct ticket number.";
	}		
	else {
			Submit();
	};
?>
