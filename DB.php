<script>
	var theme = $.cookie('theme');
				if($.cookie("theme")) {
	$("link").attr("href",$.cookie("theme"));
}		

				$('table#delTable tr:odd').addClass('tblOclr');
				$('table#delTable tr:even').addClass('tblEclr');
				$('table#delTable tr:first').addClass('tblFclr');
				$('table#delTable td').addClass('tblbrdr');

				
</script>
<?php
require_once ('session.php');

			// list out our first-accessed variables for connecting to the database.
$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$Tdate = date('Y-m-d');
$DATE = date('n/j/Y');
$today = date('l, F jS');


	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");
 
 $result = mysql_query("SELECT Ticket, Date, Stime AS 'Start Time', ETA, Priority, Site AS 'Site Name', Comments FROM dbase.tickets WHERE Deleted != 'X' ORDER BY Ticket ASC");
		if(!$result) {    
			die ("Query to show fields from table failed");
		}
// Sets up our variables for counting how many tickets are still in the open queue.
// When our count has reached zero (0), we display a different result
// for the open queue.
 		$time_start = microtime(true);
		
			$hello = mysql_query("SELECT COUNT(*) FROM dbase.tickets WHERE Deleted not in('X') ");
			$emp = mysql_fetch_assoc($hello, MYSQL_BOTH);
			$empty = $emp[0];	
				$tick = mysql_query("SELECT COUNT(*) FROM dbase.tickets WHERE Date = '$DATE'");
		$ticke = mysql_fetch_assoc($tick, MYSQL_BOTH);
		$ticked = $ticke[0];
			$deleted = mysql_query("SELECT COUNT(*) FROM dbase.tickets WHERE Deleted = 'X' AND Removed_Datetime LIKE '$Tdate %'");
			$del = mysql_fetch_assoc($deleted, MYSQL_BOTH);
			$Td = $del[0];

	$fields_num = mysql_num_fields($result);
	echo "<div id='table' style='text-align:center;vertical-align:top;'><center><table border='0' id='delTable' cellpadding='2' cellspacing='1'><tr class='trr'>";
		// If the Alert System has no tickets, display an important message.
	if ($empty == 0) { 
			if( !isset($user)){
				$user = $_SESSION['myusername'];
			}
				?>
			  </td></tr></table> </div>
			<div id='allgone'><p><font size=4><b> Great job <?php echo $user; ?>, all tickets have been called on</b>!<br>
				<br><span id='all_clear'><font face='Arial Black' color='#00008B'><?php echo $today; ?>: </font><br />
					There have been <b><?php echo $ticked; ?></b> tickets opened and
					<br />&nbsp;<b><?php echo $Td; ?></b> tickets have been removed from the queue.</span></p>  </div><!-- End Div .Table -->
<?php				
			}
		// otherwise, print the available open tickets.
else {

			for($i=0; $i<$fields_num; $i++){ 
				$field = mysql_fetch_field($result);
				echo "<td id='fields'><b> {$field->name}</b></td>";
			}
			echo "<td id='deletelink'><img title='Remove Tickets from the Alert System'  src='spooky.gif' height='20px' width='20px' /> </td></tr>\n";
 
	// printing table rows, beneath field headers -- this will only happen if more than zero tickets are in the alert system.
	
	//	$deletelink = "<a href='#' class='delete'><img id='del' border='0' src='delete.png' title='Remove Ticket #$id.' /></a>";
			$sql = 'SELECT Ticket, Date, Stime, ETA, Priority, Comments FROM dbase.tickets WHERE Deleted != "X" ORDER BY Ticket ASC'; 

				$sequel = mysql_query($sql) or die(mysql_error());

	//			WORKING PHP FOR SELECTING TICKET ID AND PLACING INTO <TR ID=> SLOT:
	// 			MySQL grabs the ticket number and forces it into an $id variable within the table row,
	//			to pass it on to the deletelink when the image is clicked.

		while($row = mysql_fetch_row($result)){ 

			$ids = mysql_fetch_row($sequel);
				$id = $ids[0];
				echo "<tr id=$id>";
	$deletelink = "<a href='#' class='delete'><img id='del' border='0' src='icon_trash.png' height='15px' width='15px' title='Remove Ticket #$id' /></a>";		
		// $row is array... foreach( .. ) puts every element    
		// of $row to $cell variable, and closes out our <tr> tag.    
				   
			foreach ($row as $cell)     
			echo "<td>$cell</td>";
				echo "<td>$deletelink</td>";
			echo "</tr>";
			
		}
		?>
		
</font></table></center></div> 
<br>

<?php
}

	mysql_free_result($result);
/* 

*** Added to the Index of the Alert System; Page no longer requires a random quote for the DB ***

$qq = rand (1,110);
$say = "cgi-bin/Quotes.txt";
$quotes = file($say, true) or die("Can't open Quotes file.");
$data = file_get_contents("cgi-bin/Quotes.txt"); //read the file
$convert = explode("\n", $data); //create array separate by new line

		
		for ($i=0;$i<count($convert);$i++){
			$q = $convert[$qq].' '; //append a single-line quote from the file into variable '$q'
		}																																												
		*** */
		
 /*
  	 *** This section has been re-worked into the Alert System logic so that when all tickets have been removed, the table of tickets is replaced by a daily statistics listing. ***
		
	echo "<span style='position:relative;top:-5px;left:-2px;z-index:999;'><font face='Arial Black'>$today :</font></span><br />";
	echo "There have been <b>$ticked</b> tickets opened and";
	echo "<br />&nbsp;<b>$Td</b> tickets have been removed from the queue.";
	echo "</div>";
	echo "<div class='quote' style='position:fixed;bottom:0px;right:5px;padding:10px;padding-bottom:5px;background:#FFCC00;color:#FF00CC;display:none;' title='Click this quote to make it vanish.'> $q </div>";

*/
mysql_close($con);
		
	
			
// Sleep for a while
mysql_query("SELECT Ticket, Date, Stime, ETA, Priority, Comments FROM dbase.tickets WHERE Deleted != 'X' ORDER BY Date, Stime ASC");

$time_end = microtime(true);
$time = $time_end - $time_start;


?>