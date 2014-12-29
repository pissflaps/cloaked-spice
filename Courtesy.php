<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en">
<head>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script type="text/javascript" src="js/yepnope.js"></script> 
<script type="text/javascript">
      yepnope.injectJs('dist/html5shiv.js', function () {
        // console.log("HTML5 compatibility loaded!");
      }, {
        charset: "utf-8"
      }, 1000);

      yepnope.injectJs('js/favico.js', function () {
        // console.log("FAVICO loaded!");
      }, {
        charset: "utf-8"
      }, 1000);

  </script>
<script type="text/javascript" src="jQuery/jquery-1.9.1.js"></script>
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
 

<link type="text/css" rel="Default stylesheet" href="css/Courtesy.css" title="Courtesy Theme" />


<title>TAC's Courtesy Emailer</title>
</head>

<body>

<div id="header">The Following Tickets <br> <span id="header2" > require a 4hr Courtesy Callback:</span> <br> </div>
<br>

<div id='table'>
<table border='0' id='Courtesy'>
<THEAD><TR class='trr'>
<?php
require_once ('session.php');  	// list out our first-accessed variables for connecting to the database.
$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$database = 'dbase';
$table = 'courtesy';
$USER = $_SESSION['myusername'];
/*	$con = mysql_connect($db_host, $db_user, $db_pwd) or die ("Can't connect to database");
	mysql_select_db($database);
*/
global $link;

  $link = mysql_connect('localhost', 'root', ''); 
 mysql_select_db('dbase', $link);
  $time_start = microtime(true);
	
	
function ShowTickets() {
				$Q = mysql_query("SELECT COUNT(*) FROM Courtesy");
			$EmptyQueue = mysql_fetch_row($Q);
			$Empty = $EmptyQueue[0];
				
			$Listing = mysql_query("SELECT Ticket,Date,STime,Priority,Site,Timeout from Courtesy ORDER BY `Date`,`STime` ASC ") or die ("Query to show fields from table failed - ". mysql_error() );
				$fields_num = mysql_num_fields($Listing);
						for($i=0; $i<$fields_num; $i++){ 
							$field = mysql_fetch_field($Listing);
							echo "<td id='fields'><b> {$field->name}</b></td>";

						}							echo "<td id='realvalu'><b>Emailed?</b></td></TR></THEAD><TBODY>";

						if( $Empty == 0) {
							echo "<TR><TD>It appears that all tickets are in good standing. Keep it up!</TD></TR></TABLE>";
						}
					else {

  					  $Timenow=mysql_query("SELECT SUBSTR(NOW(),12,8)");
					  $NOW=mysql_fetch_row($Timenow);
            while($row = mysql_fetch_assoc($Listing)){ 

					$id = $row['Ticket']; $date = $row['Date']; $stime = $row['STime']; $priority = $row['Priority']; $site = $row['Site']; $TIME = $row['Timeout'];
					
    $Emailed = mysql_query("INSERT INTO Emailed (`Ticket`,`Date`,`Start time`,`Priority`,`Site`) VALUES ('$id','$date','$stime','$priority','$site') ON DUPLICATE KEY UPDATE Ticket=VALUES(Ticket),Date=VALUES(Date),`Start Time`=VALUES(`Start Time`),Priority=VALUES(Priority),Site=VALUES(Site)" ) or die ("Could not update table <b>Emailed</b><br> ". mysql_error() );

			echo "<tr id=$id>";
					foreach ($row as $cell){
	$Time = intval(date('G') );
	$Day = intval(date('j') );
    $Timeout = intval($row['Timeout']);
	$Minutes = $row['STime'];
	$T_now = substr(date('g:i'),2,2);
	$Now_Time = intval($T_now);
	$Min = intval(substr($Minutes,3,2));
	$Mleft = ($Now_Time - $Min);
	$T_TIME = ($Timeout + 4);
						echo "<td>$cell</td>";								}
                                  if(  ( (intval(substr($date,3,2)) ) <= $Day ) && (($Time - $Timeout) >= (4) )  ){
								  $Emailed; 
					    			echo "<td class='emailed'><b>YES! </b> <small>[ Emailed about ". abs(($Timeout + 4) - $Time) ."hrs ago ]</small> </td>";
						    	}
					    		else {
					    	        echo "<td class='NotE'><b>Not Ready Yet</b> [ Date=". substr($date,3,2).
									" | Timeout(". ($T_TIME ) .") minus now (".$Time .") = <b>". ($T_TIME - $Time)  ."hr(s), ". $Mleft ."min left.</b> ] </td>";
					    		}

						echo "</tr>";
			}
echo "<table id='timetable'><THEAD><tr><th>CURRENT DATE</th><th>SERVER TIME</th></tr></THEAD><TBODY><tr>";
echo "<td id='Dcol'>". date('n/j/Y') ."</td><td id='Tcol'><time>". date('G:i A') ."</time></td></tr>";
echo "<td id='Tcount'>There are ". $EmptyQueue[0] ." tickets in the open queue.</td>";
echo "</tr></tbody></table>";
 }
};		

ShowTickets();
mysql_close();
// Sleep for a while

$time_end = microtime(true);
$time = $time_end - $time_start;
?>
</font>
	
	</table>

	<br>
<button id='reload'>Reload()</button>		
		</div>
<div id='Values'></div>
<script type="text/javascript">
$(document).ready(function() {
  $("button").button();      
	  $('#reload').on('click', function() {
		setTimeout('window.location.reload()', 5); 
		});
  var $RowCounts = $("#Courtesy tr").length;
  var $COUNT = parseInt( ($RowCounts - 1));
	    var $Value = $('#Courtesy tbody tr td:nth-child(6)').html();
	      $.each('#Courtesy tbody tr', function() {
	      $('#Values').append('<span class="valz">'+ $Value +'</span><br>');
  });

});
</script>

</body>
</html>