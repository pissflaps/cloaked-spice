<?php
global $id;

$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "CDRMS";
$dbuser		= "root";
$dbpass		= "";
$con = mysql_connect($dbhost, $dbuser, $dbpass);

$mysql = "Select ClientID as' Client ID' , ClientName as 'Client Name', Server as 'Server Location', PBX as 'PBX Type' from CDRMS.customers where ClientName='$id'";
	$Fakeout = mysql_query($mysql, $con);
		$colcount = mysql_num_fields($Fakeout);
echo "<table id='hi' cellpadding='8' cellspacing='5'><tr><h3>CDRMS Customer: ". ucwords($id) ."</h3></tr>";
			for($i=0; $i<$colcount; $i++){ 
					$field = mysql_fetch_field($Fakeout);
				echo "<td id='fields'><b> {$field->name}</b></td>";
			}
		echo "</tr><tbody id='listing'>";


function MakeRow() {
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "CDRMS";
$dbuser		= "root";
$dbpass		= "";



$SEL = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

    /*** The SQL SELECT statement ***/
    $sql = "Select ClientID,ClientName, Server, PBX from customers where ClientName='$id'";

    /*** fetch into an PDOStatement object ***/
    $ANS = $SEL->query($sql);

    /*** echo number of columns ***/
    $sult = $ANS->fetch(PDO::FETCH_ASSOC);

    /*** close the database connection ***/
 
	
		while($ANS->fetch(PDO::FETCH_ASSOC)){ 
		$CLIENT = $ANS['ClientID'];
		$NAME = $ANS['ClientName'];
		$SERVER = $ANS['Server'];
		$PBX = $ANS['PBX'];
		echo json_encode(array("CLIENT" => $CLIENT , "NAME" => $NAME , "SERVER" => $SERVER , "PBX" => $PBX ) );
			}	
		
}

	
function NoTicket() {
	$id = "";
	echo "<h3>You do not have a Client selected.</h3>";
	}
	

if(!isset($_GET['id'])) {
	NoTicket();
	}
	else {
	$id = $_POST['id'];
	MakeRow();
}
?>