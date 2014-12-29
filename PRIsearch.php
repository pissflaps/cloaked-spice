<!DOCTYPE html>
<html lang="en">
<head>
<title>TAC.APP: Search Tickets by Priority</title>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
			<link rel="alternate stylesheet" href="css/start2/jquery-start2.css" type="text/css" />
			<link rel="stylesheet" href="css/Base.css">
	<script src="jQuery/jquery-1.8.0.js"></script>
		<script src="jquery/jquery-ui-1.8.23.min.js"></script>
			<link rel="shortcut icon" href="favicon2.ico" type="image/x-icon" />



<?php
error_reporting(E_ALL ^ E_NOTICE); 
			// list out our first-accessed variables for connecting to the database.
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'dbase';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$DATE = date('n/j/Y');
$today = date('l, F jS');


	$con = mysql_connect($dbhost, $dbuser, $dbpass);
if(!mysql_select_db($database))   die ("Can't select database");

?>
<style>

	.bgcolor {
	background: #FFFF00;
	background-color: #FFFF00;
	color: #000000;
	}
	td:hover {	
	background: #ffffff;
	color:#000000;
	cursor: pointer;
	}
	
	body {
	background: #3333333;
	color: #000000;
	padding: 10px;
	}
	#top, input{
	border-radius: 10px;
	}	
	#wrapper {
	padding:50px;
	background: #eeeeee;
	}
	#top {
	padding: 25px;
	background: #778899;
	color: #dadada;
	}

	#bottom {
	padding: 25px;
	background: #cccccc;
	color: #778899;
	border-radius: 15px;
	}
	
	.tblOclr {
	background: #000066;
	color: #ffffff;
	}
	.tblEclr {
	background: #A5DBEB;
	color: #000000;
	}

	table{ 
	padding: 5px;
	border: 5px solid #778899;
	border-radius: 5px;
	}
	
	td, tr{
	padding: 5px;
	border:1px solid #808080;
	}
	
	input {
	padding:10px;
	clear:both;
	}
	
	.tblFclr {
	background: #ffffff;
	color: #00008B;
	}
	
	#resultName {
	padding: 10px;
	background: #ffffcc;
	color: #000000;
	border-radius: 5px;
	}
</style>
		<script>
$(document).ready(function() {
				$('table#results tr:odd').addClass('tblOclr');
				$('table#results tr:even').addClass('tblEclr');
				$('table#results tr:first').addClass('tblFclr');
				
			});

	   $(function () {
        $("button").button();
	   });
			$(function () {
				$("#buttonDiv").buttonset();
			});

</script>
		</head>
		
		<body>
	<div id="wrapper">	
	<center>
	<h1>Search for tickets by Priority!</h1>
		<div id="top">
		<form name="Lookup" id="form1" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
		
<span id='buttonDiv' >
<input type="radio" NAME="Priority" id="radio1" VALUE="2" checked onchange="valueChanged()" /><label for="radio1">2</label>
<input type="radio" NAME="Priority" id="radio2" VALUE="4" onchange="valueChanged()" /><label for="radio2">4</label>
<input type="radio" NAME="Priority" id="radio3" VALUE="9" onchange="valueChanged()" /><label for="radio3">9</label>
</span>
		<button type="Submit" id="buttone">Submit</button>
		</div>
<?php
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

	if (!empty ($_GET['Priority'])) {
			//$stmt = $dbh->prepare("SELECT Ticket, Date, Stime, ETA, Priority, Site, Priority FROM tickets where Priority LIKE ?");
	$Priority = filter_var($_GET['Priority'], FILTER_SANITIZE_STRING);
	$stmt = $dbh->prepare("SELECT Ticket, Date, Priority, Site, Comments,Removed_Datetime,removedby FROM tickets where Priority = ?");
	$stmt->execute(array($Priority));
		$countoff = $stmt->rowCount();
?>

		<hr width="50%">
	
		<div id="bottom">
		<span id="resultName">Your search for <u>&nbsp; <b><?php echo $Priority; ?></b> &nbsp;</u> returned the following <?php echo $countoff; ?> tickets:</span>
		<br><br/>
	<?php 
		if ($stmt->execute(array($Priority))) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);	
$time_start = microtime(true);			
				$res = "SELECT Ticket, Date, Priority, Site, Comments,Removed_Datetime,removedby FROM tickets";
					$result = mysql_query($res, $con);
						$colcount = $stmt->columnCount();
					echo "<table  cellpadding='3' cellspacing='2' id='results' ><tr>";				
						for($i=0; $i<$colcount; $i++){ 
							$field = mysql_fetch_field($result);
							echo "<td id='fields'><b>{$field->name}</b></td>";
						}
					echo "</tr>\n";
		echo "<tbody>";
			while ($row = $stmt->fetch()) {
				echo "<tr>";	
					foreach ($row as $cell) 
						echo "<td>$cell</td>";
					echo "</tr>";    
				}
		echo "</tbody>";
		echo "</table>";
		

// Sleep for a while
mysql_query("SELECT * from Tickets where Priority= $Priority");

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "Query executed in $time seconds\n";
		}
		else {
			echo "Query returns an empty result. <br> Please try again.";
		}
	}
	else {
		echo "No Priority name to search yet!";
	}
?>


	
		</div>
			
		</center>
	</div>
<span style="float:right;"><button id="hilite" name="highlight">Remove Highlighting</button></span>

	<script>
$(document).ready( function() {
	
	$('table#results td').live("click", function() {
			$(this).toggleClass("bgcolor");
		return false;
	});
		$('#hilite').live("click", function() {
				$('*').removeClass("bgcolor");
				return false;
		});

});
</script>

</body>
</html>