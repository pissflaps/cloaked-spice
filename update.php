<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<script src="js/jquery-1.7.1.js"></script>  
		<script src="jQuery/jquery-ui-1.8.19.js"></script>
		<script type="text/javascript" src="js/jquery.form.js"></script> 
		<link rel="stylesheet" href="css/dbase.css" type="text/css" />
  <link href="css/jquery-ui-custom1.css" rel="stylesheet" type="text/css"/>

	<title>Updating your ticket. . .</title>
	<script>
	$(function(){
		$("button").button();
		
	});
	</script>
	<style>
		body{
			font: 12px Helvetica, Arial, sans-serif;
			width: 99%;
			background:#A6D8ED;
			color:#000000;
		}
	.corners{
		-moz-border-radius: 4px;
		border-radius: 4px;
	}
	</style>
</head>
<body>

	<?php
error_reporting(E_ALL ^ E_NOTICE); 

$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$Aticket = $_GET['origticket'];
$Zticket = $_GET['check1'];
$Priority = $_GET['check2'];
$Comments = filter_var($_GET['check3'], FILTER_SANITIZE_STRING);
$Sname = $_GET['check4'];

if(empty($_GET['check1'])){
	 $Zticket = $Z;
	 }
if (empty($_GET['check2'])){
	$Priority = $P;
	}
	if(empty($_GET['check3'])){
			$Comments = $C;
			}
		if(empty($_GET['check4'])){
			$Sname = $S;
			}
$UP = "UPDATE tickets SET Ticket='$Zticket', Priority='$Priority', Site='$Sname', Comments='$Comments' WHERE Ticket = '$Aticket'";		
	
	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");
				
				echo "<font face='arial' size=6><b>ADJUSTED:</b></font> <br />".
				"<font face='Cabin' size=4>The original ticket,<b> # $Aticket</b>, will recieve the following changes:<br>".
				"New Ticket # $Zticket, Priority of<b> $Priority </b>, the new Site name <b> $Sname</b> and new comments:<b> $Comments </b></font>";
				
				 $result = mysql_query("SELECT Ticket, Date, Stime, ETA, Priority, Site, Comments FROM tickets WHERE Ticket = '$Aticket'");
  

		if(!$result) {    
			die ("Query to show fields from table failed");
		}
 
	$fields_num = mysql_num_fields($result);
	echo "<table border='0' id='delTable'><tr class='trr'>";
	
		// printing table headers
		
			for($i=0; $i<$fields_num; $i++){ 
				$field = mysql_fetch_field($result);
				echo "<td><b><font face='Georgia'> {$field->name} </font></b></td>";
			}
			echo "</tr>\n";
 
	// printing table rows, beneath field headers.

		while($row = mysql_fetch_row($result)){ 
				echo "<tr id=$Aticket>";
				
			foreach ($row as $cell)        
			echo "<td>$cell</td>";
			echo "</tr>\n";

			}
// debug growl box			
//			echo " <div id='hello' style='background:#000000; color:#FFFFFF; position:absolute; bottom:10px; left:50px;padding:20px;'>";
//				echo " $Aticket <br> $Zticket <br> $Priority <br>  $Comments <br> $UP <br>";
//				echo "</div>";
			?>
			<p>
		<div id="visible" style="position:relative;top:50px;background:#FFFFCC;display:;padding:15px;"><font face="Arial" size=5> Are you sure you want to proceed with these changes?</font>
<br><br/>
<span style="padding:10px;background:#FF0000;color:#FFFFFF"><font face="Arial" size=3><b>WARNING:</b> this will edit the original ticket and move it back into the open queue.</font></span>
<br><br/>
<form METHOD="POST">
<input type="hidden" name="origticket" value="<?php echo $Aticket; ?>" />
<input type="hidden" name="check1" value="<?php echo $Zticket; ?>" />		
<input type="hidden" name="check2" value="<?php echo $Priority; ?>" />
<input type="hidden" name="check3" value="<?php echo $Comments; ?>" />
<input type="hidden" name="check4" value="<?php echo $Sname; ?>" />
<input type="hidden" value="<?php echo $_GET['origticket']; ?>"  id="UPDATE" name="UP2DATE"/>
<button id="clickme">Yes, I'm sure</button></form>

<br/>
</div>
<HR style="width:50%;">

</p>
<br><br>
<br />
		<div id='hidden' style="display:none;">
		<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$Aticket = $_POST['origticket'];
$Zticket = $_POST['check1'];
$Priority = $_POST['check2'];
$Comments = filter_var($_POST['check3'], FILTER_SANITIZE_STRING);
$Sname = $_POST['check4'];
$Q = mysql_query("SELECT Ticket, Priority, Site, Comments FROM tickets WHERE Ticket = '$Aticket'"); 
while ($QUERY = mysql_fetch_assoc($Q)) {
$P = $QUERY['Priority'];
$Z = $QUERY['Ticket'];
$C = $QUERY['Comments'];
$S = $QUERY['Site'];
}
	if( $Zticket < 1 ){
		$Zticket = $Aticket;
		}
if (empty($_POST['check2'])){
	$Priority = $P;
	}
	if(!isset($_POST['check1'])){
	 $Zticket = $Z;
	 }
		if(empty($_POST['check3'])){
			$Comments = $C;
			}
			if(empty($_POST['check4'])){
			$Sname = $S;
			}	
$U = $_POST['UP2DATE'];
$UP = "UPDATE tickets SET Ticket='$Zticket', Priority='$Priority', Site='$Sname', Comments='$Comments',Deleted='O' WHERE Ticket = '$Aticket'";		
$UPDATE = mysql_query($UP);

	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");

$result2 = mysql_query("SELECT Ticket, Date, Stime, ETA, Priority, Site, Comments FROM tickets WHERE Ticket = '$Zticket'");

		
	echo "<tr><td><font face='courier' size=4><b>has now become:</b></font></td></tr>";

			
				while($row = mysql_fetch_row($result2)){ 
				
				echo "<tr id=$Zticket>";
				
				foreach ($row as $cell)        
				echo "<td>$cell</td>";
				echo "</tr>\n";
				}
		?>
		</table>

</div>
		<div id="homelink" style="position:fixed;bottom:10px;right:10px;padding:15px;background:#eeeeee;color:#000000;" target="_SELF">
		<a href="http://tac-alert01/index.php" title="Get me back to the Alert Queue">Head back to the Alert System</a></div>
		<script>
$(document).ready(function(){

			$('table, button, tr, span, a, p, div, textarea, input, img').addClass('corners');

	
	$('button#clickme').click(function(){
	
		$.ajax({
			type: "POST",
			url: "update.php",
			data: "<?php echo $UPDATE; ?>",
			cache: false,
			success: function(){
			
					$('div#hidden').slideDown(1000);
			}
		});
	});
	
});	
	
</script>
</body>
</html>		
		
		
		
		
		
		
		