<?php	
function MakeOpts() {
$dbtype= "mysql";
$dbhost= "localhost";
$dbname= "dbase";
$dbuser= "infortel";
$dbpass= "T3lemanagement";
global $CREATOR;
global $COUNTER;

	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname","infortel","T3lemanagement");
	$res= "SELECT DISTINCT(Creator) as Creator from tickets where Creator is not null ORDER BY Creator"; 
	$stmt = $dbh->query($res);
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC) )    {
     echo '<option value="'.$result['Creator'].'">'. $result['Creator'].'</option>';
    }
}


	function NoTicket() {
		$CREATOR = "";
		echo "<center><h3>Please select a ticket creator from the drop-down menu.</h3></center>";

		
}

	function MakeFields() {	
			$dbtype		= "mysql";
			$dbhost 	= "localhost";
			$dbname		= "dbase";
			$dbuser		= "infortel";
			$dbpass		= "T3lemanagement";
			$CREATOR = $_GET['Creator'];

			$con = mysql_connect("localhost", "infortel", "T3lemanagement");

			$mysql2 = "Select DISTINCT(Ticket), Site as 'Site Name', Date, Stime as 'Start Time', Comments from dbase.tickets where Creator='$CREATOR' ";
			$Fakeout = mysql_query($mysql2, $con);
	while ($tableRow = mysql_fetch_assoc($Fakeout)) {
        echo "<TR><td>". $tableRow['Ticket']. "</td><td>" .$tableRow['Site Name']. "</td><td>" .$tableRow['Date']. "</td><td>" .$tableRow['Start Time']. "</td><td>" .$tableRow['Comments']. "</td></tr>"; 
	}

}
/*					while($row = mysql_fetch_assoc($Fakeout)){ 
			foreach ($row as $key => $value) { // Loops 6 times because there are 6 columns
echo "<tr><td id='ticket'>".$row['Ticket']."</td><td id='date'>".$row['Date']."</td><td id='stime'>" .$row['Stime']."</td><td id='ETA'>".$row['ETA']."</td><td id='Priority'>".$row['Priority']."</td><td id='comments'>".$row['Comments']."</td></tr>";

						}
			 }
			 
}
*/


/*
	function MakeRow(){
			$dbtype		= "mysql";
			$dbhost 	= "localhost";
			$dbname		= "dbase";
			$dbuser		= "root";
			$dbpass		= "";
			$CREATOR = $_POST['Creator'];

			$con = mysql_connect($dbhost, $dbuser, $dbpass);
			
}*/
?>