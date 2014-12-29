<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>OOP in PHP</title>
        <?php include("class_lib.php"); ?>
</head>
<style>
body{
background: #444;
color: #f5fffa;
padding: 5px;
margin: 10px auto;
}
	#table, #results {
	clear:both;
	background: #000;
	color: #f5fffa;
	padding: 5px;
	border-radius: 4px;
	}
		#table td, #results td{
			padding: 5px;
			background: #444;
			border-radius: 2px;
			}
				#form1{
				clear:both;
				float:right;
				padding: 5px;
				}
#title{
width: 40%;
float:left;
padding: 2px;
}

h3{
display:inline-block;
color: #ffffcc;
background: #222;
padding: 10px;
border-radius: 15px;
opacity:0.75;
}
</style>
<body>
	<?php 
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "db2";
$dbuser		= "root";
$dbpass		= "";	
			$con = mysql_connect($dbhost, $dbuser, $dbpass);
										//	$ID, $Date, $Stime, $ETA, $Priority, $Site, $Comments
									$Header = new Ticket;
									$Header->add_ticket("Ticket","Date","Start Time","ETA","Priority","Site Name","Comments");
		$Ticket = new Ticket;
			$Ticket->add_ticket("111111", "08/21/2012","12:41:00","14:41:00","2","Test Ticket", "This is a test!");
		$Sticket = new Ticket;
			$Sticket->add_ticket("222222", "08/22/2012","11:41:00","13:41:00","9","PRIORITY Test Ticket", "This is a PRIORITY test!");
							
function print_form() {
    echo <<<END
		<form id="form1" METHOD="POST" Action="$_SERVER[PHP_SELF]">
		<label for="Ticket">Ticket</label><input name="Ticket" id="in1"> <br>
		<label for="Date">Date</label><input name="Date" id="in2"> <br>
		<label for="Stime">Start Time</label><input name="Stime" id="in3"> <br>
		<label for="ETA">ETA </label><input name="ETA" id="in4"> <br>
		<label for="Priority">Priority</label><input name="Priority" id="in5"> <br>
		<label for="Site">Site Name</label><input name="Site" id="in6"> <br>
		<label for="Comments">Comments</label><textarea name="Comments" id="in7"> </textarea>
		<br>
		<button id="submitit" name="Submit">Submit!</button>
		</form>
END;
}	
?>	
	<center>
	<br>
	<?php 
		print_form();
	?>
	<span id="title">
	<hr>
	<h1>Submit a ticket</h1>
	<sup><h2> and see what comes out!</h2></sup>
	<hr>
	</span>
	<table id="table">
	<?php
	global $Nticket;
	$Header->get_ticket();
				if(isset( $_POST['Ticket'])) {
								$Nticket= new ticket;
								$Removedby=null;
							$Nticket->add_ticket($_POST['Ticket'], $_POST['Date'],$_POST['Stime'],$_POST['ETA'],$_POST['Priority'],$_POST['Site'],$_POST['Comments']);	
						$Nticket->get_ticket();
				}
					else { 
						$Nticket = null; 
							$Removedby=null;
						echo "<h3>A new ticket has not been created yet!</h3>";
					}
							$Ticket->get_ticket();
							$Sticket->get_ticket();
								echo "<br> <hr> <br>";
		function show_tickets() {
		$dbtype		= "mysql";
		$dbhost 	= "localhost";
		$dbname		= "db2";
		$dbuser		= "root";
		$dbpass		= "";	
				$Removedby=null;
	$con = mysql_connect($dbhost, $dbuser, $dbpass);
			$DBG = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
				$stmt = $DBG->prepare("SELECT Ticket, Date, Priority, Site, Comments,removedby FROM tickets where removedby = ?");
				$stmt->execute(array("$Removedby"));
				$countoff = $stmt->rowCount();
					$stmt->setFetchMode(PDO::FETCH_ASSOC);		
						$res = ("SELECT Ticket, Date, Priority, Site, Comments,removedby FROM tickets where 1");
							$result = mysql_query($res, $con);
print "<br>". $result ."<br>";
							$fields_num = $DBG->exec("SELECT Ticket, Date, Priority, Site, Comments, removedby FROM tickets");
							
									echo "<table  cellpadding='3' cellspacing='2' id='results' ><tr>";				
										for($i=0; $i<$fields_num; $i++){ 
											$field = mysql_fetch_field($fields_num);
											echo "<td id='fields'><b>{$field->name}</b></td>";
										}
									echo "</tr>\n";
							while ($row = $stmt->fetch()) {
								echo "<tr>";	
									foreach ($row as $cell) 
										echo "<td>$cell</td>";
									echo "</tr>";    
								}
		}	
		
			show_tickets();
			

	?>
	</table>
	</center>
</body>
</html>