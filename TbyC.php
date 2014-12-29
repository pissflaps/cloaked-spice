<!DOCTYPE html>
<?php require('TAC_functions.php'); ?>
<html>
	<head>	
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
<script type="text/javascript" src="js/jQuery_Plugins.js"></script>
<!-- // Compressed version of all related vendor plug-ins used in jQuery -->
  <link rel="stylesheet" href="Foundation/css/foundation.min.css" type="text/css">
		<title>TAC Tickets by Creator</title>
	<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="css/tbyc.css" >
</head>
<body >

<h1>TAC Tickets:</h1>
<h2> - Please choose the Ticket creator:</h2>
<form name="userpick"  method="GET" >
	<span id='formbar'>	<div class='picker'>
<select name='Creator'>
<option value='null' selected>Please Choose... </option>
<?php
MakeOpts();
?>
</select> </div> <button id="subbutt" type="submit" class='medium button secondary'>Submit!</button>
	</span>
</form>
<br>

<div id="Second_Half">

<?php 
if(!isset($_REQUEST['Creator'])) {
		NoTicket();
	}
else {
$CREATOR = $_GET['Creator'];
$dbh = new PDO("mysql:host=localhost;dbname=dbase",'infortel','T3lemanagement');			
$mysql = $dbh->prepare("Select DISTINCT(Ticket), Site as 'Site Name', Date, Stime as 'Start Time', Comments from dbase.tickets where Creator='$CREATOR' ");
$mysql->execute();


$COUNTER = $mysql->rowCount();
			   echo "<table id='listed' align='center' cellpadding=2><THEAD><tr><th id='customer'> <u> ". ucwords($CREATOR) ." </u> </th>".
			   "<th id='total' align='center' cellpadding=2>Total: ". $COUNTER ." tickets</th></tr></THEAD><br>";
			   echo "<tr id='headers'><td>Ticket </td><td> Site </td><td> Date </td><td> Start Time </td><td> Comments</td></tr><TBODY>";
MakeFields();
 	echo "</TBODY></table>";
}
?>



</div>

</body>
</html>
