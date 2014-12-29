<?php	
function MakeOpts() {
$dbtype= "mysql";
$dbhost= "localhost";
$dbname= "CDRMS";
$dbuser= "infortel";
$dbpass= "T3lemanagement";
global $id;

	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
	$res= "SELECT ClientID, ClientName FROM customers where ClientNumber > 0  ORDER BY ClientID"; 
	$stmt = $dbh->query($res);
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC) )    {
     echo '<option value="'.$result['ClientName'].'">'. $result['ClientID']." - ".ucwords($result['ClientName']).'</option>';
    }
}


	function NoTicket() {
		$id = "";
		$CLIENT= null;
		$NAME= null;
		$SERVER= null;
		$PBX= null;
		$COLLECT = null;
		echo "<center><h3>Please select a Client ID from the drop-down menu.</h3></center>";
echo "<table id='hidden' cellpadding='1' cellspacing='0'><THEAD><tr><tbody id='listing'><tr><td id='client'>".$CLIENT."</td><td id='name'>".$NAME."</td><td id='server'><div id='rel'>" .$SERVER." <img id='bottum' src='icons/copy.gif' /></td></div><td id='pbx'>".$PBX."</td><td id='collect'>".$COLLECT."</td></tr></table>";				
		
}

	function MakeFields() {	
			$dbtype		= "mysql";
			$dbhost 	= "localhost";
			$dbname		= "CDRMS";
			$dbuser		= "infortel";
			$dbpass		= "T3lemanagement";
			$id = $_POST['id'];

			$con = mysql_connect($dbhost, $dbuser, $dbpass);
			$mysql = "Select ClientID as' Client ID' , ClientName as 'Client Name', Server as 'Server Location', PBX as 'PBX Type', CollectionMethod as 'Collects From' from CDRMS.customers where ClientName='$id' ";
			$Fakeout = mysql_query($mysql, $con);
					$colcount = mysql_num_fields($Fakeout);				  
			   echo "<h2 id='customer'>CDRMS Customer: <u><b> ". ucwords($id) ." </b></u></h2><table id='hi' cellpadding='1' cellspacing='0'><THEAD><tr>";
							for($i=0; $i<$colcount; $i++){ 
								$field = mysql_fetch_field($Fakeout);
					
							echo "<td id='field_$i'><b> {$field->name}</b></td>";
						}
						echo "</tr></THEAD><tbody id='listing'>";
						MakeRow();
}
	function MakeRow(){
			$dbtype		= "mysql";
			$dbhost 	= "localhost";
			$dbname		= "CDRMS";
			$dbuser		= "infortel";
			$dbpass		= "T3lemanagement";
			$id = $_POST['id'];

			$con = mysql_connect($dbhost, $dbuser, $dbpass);
			$mysql = "Select ClientID as' Client ID' , ClientName as 'Client Name', Server as 'Server Location', PBX as 'PBX Type', CollectionMethod as 'Collects From'  from CDRMS.customers where ClientName='$id' ";
			$Fakeout = mysql_query($mysql, $con);
					$colcount = mysql_num_fields($Fakeout);
					while($row = mysql_fetch_row($Fakeout)){ 
					list($CLIENT,$NAME,$SERVER,$PBX,$COLLECT) = $row;
					$SERVER = $SERVER ."InfortelSelect12\\Data\\Raw\\$CLIENT\\Archive\\";
	//	$string= json_encode(array("CLIENT" => $CLIENT , "NAME" => $NAME , "SERVER" => $SERVER , "PBX" => $PBX ) );
					echo "<tr><td id='client'>".$CLIENT."</td><td id='name'>".$NAME."</td><td id='server'><div id='rel' >" .$SERVER." <button id='bottum' data-zclip-text='$SERVER' class='zclip tiny button radius success'> copy! </button></div></td><td id='pbx'>".$PBX."</td><td id='collect'>".$COLLECT."</td></tr></table>";
						}

}
?>