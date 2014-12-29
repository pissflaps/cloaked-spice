<?php
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
$comments = filter_var($_POST['comments'], FILTER_SANITIZE_STRING);
$removed = "N";
$siteName = filter_var($_POST['siteName'], FILTER_SANITIZE_STRING); 
 
// query
$sql = "INSERT INTO tickets (Ticket,Date,STime,ETA,Priority,Site,Comments,Deleted,Removed_Datetime,removedby) VALUES (:ticket, DATE_FORMAT(CURDATE(),'%c/%e/%Y'), CURTIME(),ADDTIME(CURTIME(),'02:00:00'), :priority, :siteName, :comments, :removed, NOW(),'' )";

$q = $conn->prepare($sql);
	
	 if ($_POST['siteName'] == 'Site Name'){
?><html><head><title>Failure: Incorrect Site Name!</title></head><body>
<?php	 
		echo "<strong>Invalid Site Name.</strong> Please go back and check your information.";
		echo "<br><br> Please use <a href='http://tac-alert01/tickadd.php' target='_NEW' >Tac's Ticket Adder</a> if your ticket needs to be re-added to the queue. <br> Or <a href='javascript: history.go(-1)'>go back</a> and make sure you enter the correct ticket number.<p style='display:none;'>";
		}
		if ( (!$_POST['ticket'] ) || (strlen($_POST['ticket']) < 6) ){
		?><html><head><title>Failure: Incorrect Ticket Information!</title></head><body>
		<?php
			echo "<strong>Sorry</strong>, you did not enter a valid ticket number.";
			echo "<br><br> Please use <a href='http://tac-alert01/tickadd.php' target='_NEW' >Tac's Ticket Adder</a> if your ticket needs to be re-added to the queue. <br> Or <a href='javascript: history.go(-1)'>go back</a> and make sure you enter the correct ticket number.";
		}		
		else {
?><html><head><title>Success: Ticket Posted!</title></head><body>
<?php
$q->execute(array(':ticket'=>$ticket, 
					':priority'=>$priority,
					':siteName'=>$siteName,
					':comments'=>$comments,
					':removed'=>$removed,
				));
		//IF POSTED
print "<span class='text-center panel'><h1>Awesome<small class='subheader'>, your ticket posted!</small></h1>";
print "<br>Getting you back to the Alert system...<br>".
"<img src='/img/loadingAnimation.gif' border='0' alt='' /> </span>";

header("refresh:2; url='index.php'");
}
?>

</p></body>
</html>









