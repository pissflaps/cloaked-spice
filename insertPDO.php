<?php 
global $VAL;
 
function Checkup() {
	// configuration
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";

	// database connection
$con = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

	// new data
$ticket = $_POST['ticket'];
$siteName = $_POST['siteName'];
$priority = $_POST['priority'];
$cPreference = $_POST['ContactPref'];
$comments = filter_var($_POST['Comments'], FILTER_SANITIZE_SPECIAL_CHARS);
$removed = "N";
$siteName = filter_var($_POST['siteName'], FILTER_SANITIZE_STRING);
$CREATOR = $_POST['Creator'];

	if ($_POST['ticket'] !=null )   {
	
	$SEL = "SELECT Ticket FROM tickets where Ticket = '$ticket' ";
		/*** fetch into an PDOStatement object ***/
    $stmt = $con->query($SEL);
		/*** echo number of columns ***/
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $VAL = $result[0];
		/*** close the database connection ***/
    $con = null;
    };

			if ($_POST['ticket'] == 0 )   {
				echo "<strong>Invalid Ticket Number!</strong> Is the ticket number really <strong style='color:#FF0000;'><u> #0 </u></strong>?";
				echo "<br><br> This module will refresh automatically in six seconds.";
				exit;
			}
				if ($_POST['siteName'] == 'Site Name'){
					echo "<strong>Invalid Site Name.</strong> Please go back and check your information.";
					echo "<br><br> This module will refresh automatically in six seconds.";
						exit;
				}
				
      if ($_POST['ticket'] == $VAL )   {
	    Submit();	
		  echo "2";
      }  
	    else {
          echo '1';
        }	
}; 
function Submit() {
	// configuration
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";

	// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

	// new data
$ticket = $_POST['ticket'];
$siteName = $_POST['siteName'];
$priority = $_POST['priority'];
$cPreference = $_POST['ContactPref'];
$comments = filter_var($_POST['Comments'], FILTER_SANITIZE_SPECIAL_CHARS);
$removed = "N";
$siteName = filter_var($_POST['siteName'], FILTER_SANITIZE_STRING);
$CREATOR = $_POST['Creator'];
	

	// query
$sql = "INSERT INTO tickets (Ticket,Date,STime,ETA,Priority,Site,Comments,Deleted,Removed_Datetime,removedby,Creator,ContactPref) VALUES (:ticket, DATE_FORMAT(CURDATE(),'%c/%e/%Y'), CURTIME(),ADDTIME(CURTIME(),'04:00:00'), :priority, :siteName, :Comments, :removed, NOW(),'',:creator,:contactPref ) ON DUPLICATE KEY UPDATE Deleted='$removed' ";

$q = $conn->prepare($sql);

$q->execute(array(':ticket'=>$ticket, 
					':priority'=>$priority,
					':siteName'=>$siteName,
					':Comments'=>$comments,
					':removed'=>$removed,
					':creator'=>$CREATOR,
					':contactPref'=>$cPreference,
				)); 
	
};	


		Checkup();
			Submit();

?>