<div id='table' class='centered'>
<table border='0' id='delTable' class='responsive' ><thead><tr class='trr'>

<?php
require('session.php');
include('TAC_Userlink.php');
	// list out our first-accessed variables for connecting to the database.
$db_host = 'localhost';
$db_user = 'infortel';
$db_pwd = 'T3lemanagement';
$database = 'dbase';
$table = 'tickets';

/*	$con = mysql_connect($db_host, $db_user, $db_pwd) or die ("Can't connect to database");
	mysql_select_db($database);
*/

global $myusername;
global $sessid;
global $LoggedIn;
global $link;

				$link = mysql_connect('localhost', 'infortel', 'T3lemanagement');
				mysql_select_db('dbase', $link);

$Listing = mysql_query("SELECT Ticket, Date, Stime AS 'Start Time', ETA, Priority, Site AS 'Site Name', Comments, ContactPref as 'Contact Preference' FROM dbase.tickets WHERE Deleted != 'X' ORDER BY Ticket ASC", $link) 
		or die ("Query to show fields from table failed");
				
				$time_start = microtime(true);
		
					$NotDeleted = mysql_query("SELECT COUNT(*) FROM dbase.tickets WHERE Deleted not in('X') ", $link);
					$empty = mysql_fetch_assoc($NotDeleted, MYSQL_BOTH);
					$NoTickets = $empty[0];			

        function UpdateLogin() {
            if(! isset($_SESSION["myusername"])) {
             $user = $_COOKIE["LoggedInAs"];
              if(empty($_COOKIE["LoggedInAs"]) ){
                 $user = $_SERVER["REMOTE_ADDR"];
                 $_COOKIE["LoggedInAs"] = $_SERVER["REMOTE_ADDR"];
              }
            }
           else{
             $user = $_SESSION["myusername"];
		   }
		}
	
function All_Gone() {
include('TAC_Userlink.php');
$ticket = 'Ticket';
$Tdate = date('Y-m-d');
$DATE = date('n/j/Y');
$today = date('l, F jS');	

			if( !isset($user)){
					$user = $_SESSION['myusername'];
				}
				else{
					UpdateLogin();
				}
				$Daily = mysql_query("SELECT COUNT(*) FROM dbase.tickets WHERE Date = '$DATE'");
			$DCount = mysql_fetch_assoc($Daily, MYSQL_BOTH);
			$DailyCount = $DCount[0];
		
				$Removed = mysql_query("SELECT COUNT(*) FROM dbase.tickets WHERE Deleted = 'X' AND Removed_Datetime LIKE '$Tdate %'");
			$DailyRemoved = mysql_fetch_assoc($Removed, MYSQL_BOTH);
			$Removed_Today = $DailyRemoved[0];



		echo "</td></tr></table> </div>
					<div id='allgone'><h2><b class='shadowZ'> Great job ". ucwords($login) .", all tickets have been called on !</b> </h2>
						<span id='all_clear' class='alert-box secondary radius'><font id='DateTimeString'>". $today .": </font>
							<h4>
							There have been <b> ". $DailyCount ."</b> tickets opened and
								<h4 class='subheader'>
								&nbsp;<b>". $Removed_Today ."</b> tickets have been removed from the queue.</h4></span></div><div class='centered'>
								    <iframe id='chartdiv' src='cStatPNG.php' width='625' height='425' frameborder='0'> </iframe></div>";
		};
			
			function ShowTickets() {
			$Listing = mysql_query("SELECT Ticket, Date, Stime AS 'Start Time', ETA, Priority, Site AS 'Site Name', Comments,ContactPref as 'Contact Preference' FROM dbase.tickets WHERE Deleted != 'X' ORDER BY Ticket ASC") or die ("Query to show fields from table failed");
				$fields_num = mysql_num_fields($Listing);
						for($i=0; $i<$fields_num; $i++){ 
							$field = mysql_fetch_field($Listing);
							echo "<td id='fields' contentEditable='false'><b> {$field->name}</b></td>";
						}
			echo "<td id='deletelink'><img id='delCross' title='Remove Tickets from the Alert System'  src='icons/badgeCross.png' height='20px' width='20px' /> </td></tr></thead><tbody>\n";
 			$Display = mysql_query("SELECT Ticket, Date, Stime, ETA, Priority, Comments FROM dbase.tickets WHERE Deleted !='X' ORDER BY Ticket ASC" ) or die( "Wuh-oh!". mysql_error());


	while($row = mysql_fetch_row($Listing)){ 
		
				$ids = mysql_fetch_assoc($Display);
					$id = $ids['Ticket'];
                    $deletelink = "<img class='delete' id='del' border='0' src='icon_trash.png' title='Remove Ticket #$id' />";		
				echo "<tr id=$id>";
							foreach ($row as $cell)     
								echo "<td><span data-id='$cell'>$cell</span></td>";
								echo "<td id='DelCel'>$deletelink</td>";
								echo "</tr>";
			}
};
		
		// If the Alert System has no tickets, display an important message.
			if ($NoTickets == 0) { 
					All_Gone();
					mysql_close();
			} 
		// otherwise, print the available open tickets.
			else {
					ShowTickets();
					mysql_close();
			}

// Sleep for a while

$time_end = microtime(true);
$time = $time_end - $time_start;
?>
</font>
</tbody>
	</table>
		</div>