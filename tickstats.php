
<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
    <title>TAC's Alert System</title>
  	
	<link rel="stylesheet" href="css/Base.css" type="text/css" />
	<link rel="stylesheet" href="css/Bootstrap1.css" type="text/css" />
  
	<title>TAC Stats: Ticket Statistics on Demand</title>
<script type="text/javascript">
    $(document).ready(function()
			{ 	
		$('#table, #table2').hide();
				$('#datepicker').prepend($('#iCal'));
				
			$('button#submit ').on("click", function()
			{
			$.ajax(
				{
					   type: "POST",
					   url: "datefind.php?date=$date",
					   cache: false,
					   dataType: 'html',
				});
			});
	$('#table tr:odd').css('background', ' #D8E6AD');
	$('#table tr:even').css('background', ' #EEFFCC');
    $('#table tr:first').css('background', ' #32cd32');
	
	$('#table2 tr:odd').css('background', ' #FFCCCC');
	$('#table2 tr:even').css('background', ' #FF6666');
    $('#table2 tr:first').css('background', ' #FF0000');
			
			$('#table, #table2').show("fade", 1500);
			
			$('span.added').on("click", function() {
				$('#table').slideToggle(900);
			});
			
			$('span.removed').on("click", function() {
				$('#table2').slideToggle(900);
			});
		});
		</script>
<style>
@import url('fontFace.css');
@import url('jqui.css');
		
		body{
			position:relative;
			margin-top:2%;
			font: 12px Helvetica, Arial, sans-serif;
			width: 99%;
			background:#E6D8AD;
			color:#000000;
		}
		
#talkbubble {
   width: 120px;
   height: 50px; 
   background: #FFFFCC;
   position: relative;
   -moz-border-radius:    10px; 
   -webkit-border-radius: 10px; 
   border-radius:         10px;
}
#talkbubble:before {
   content:"";
   position: absolute;
   right: 100%;
   top: 15px;
   width: 0;
   height: 0;
   border-top: 13px solid transparent;
   border-right: 26px solid #FFFFCC;
   border-bottom: 13px solid transparent;
}
@font-face {
	font-family: Script MT Bold;
	src: url('SCRIPTBL.ttf');
}

.removed {
background:#EFC2C2;
padding:5px;
display:block;
cursor:pointer;
}

.added{
background:#D8E6AD;
padding:5px;
display:block;
cursor:pointer;
}
		</style>
		</head>

				<body>
	
<script type="text/javascript">
$(function() {
		$( "#datepicker" ).datepicker();
		$("button").button();
	});
</script>
<?php
error_reporting(E_ALL ^ E_NOTICE); 

$db_host = 'localhost';
$db_user = 'infortel';
$db_pwd = 'T3lemanagement';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';


	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");
				
				$mysql = "DATE_FORMAT(CURDATE(),'%c/%e/%Y')";
				$today = mysql_query($mysql);
			?>
<center>

<font face="Script MT Bold" size=6>Choose a Date to see its activity!</font>
<br />
<form name="datepickr" METHOD="POST">
  <input type="text" id="datepicker" name="date" placeholder=" mm / dd / yyyy" required/> &nbsp;&nbsp;

<button type="submit" class="positive" id="Submit" VALUE="date"  border="0" >Submit <img src="/icons/bullet_go.png" border="0" alt=""/></button> &nbsp;
<BR>
</form>
<br />

<div id="results" >
<?php

$db_host = 'localhost';
$db_user = 'infortel';
$db_pwd = 'T3lemanagement';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$date =  $_POST['date'];

	$time = strtotime( $date );
	$DATE = date( 'n/j/Y', $time );
	$tDATE = date('Y-m-d', $time );
	$today = date('l, F jS', $time);
		if (isset($_POST['date'])){
			echo "<div id='talkbubble' style='padding:10px;'>You have chosen <b>".$today.":";
			echo "</b></div><br> <br />";
		}
		if (!isset($_POST['date'])){
			echo "<div id='talkbubble' style='padding:10px;'>You have not yet chosen a valid date.";
			echo "</b></div><br> <br />";
		}
	
	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");
 
 // sending query
  
 $result = mysql_query("SELECT * FROM tickets WHERE Date = '$DATE'");


 if(!$result) {    
			die ("Query to show fields from table failed");
		}
 
$priorities9 = "SELECT COUNT(*) FROM `tickets` WHERE Date = '$DATE' AND Priority = '9'";
$priorities2 = "SELECT COUNT(*) FROM `tickets` WHERE Date = '$DATE' AND Priority = '2'";
$priorities4 = "SELECT COUNT(*) FROM `tickets` WHERE Date = '$DATE' AND Priority = '4'";
$tick = mysql_query("SELECT COUNT(*) FROM tickets WHERE Date = '$DATE'");
		$ticke = mysql_fetch_assoc($tick, MYSQL_BOTH);
		$ticked = $ticke[0];
$closed = "SELECT COUNT(*) FROM 'tickets' WHERE Deleted = 'X'";
$p9 = mysql_query($priorities9);
$p4 = mysql_query($priorities4);
$p2 = mysql_query($priorities2);
$cls = mysql_query($closed);
			 
			$deleted = mysql_query("SELECT COUNT(*) FROM tickets WHERE Deleted = 'X' AND Removed_Datetime LIKE '$tDATE %'");
			$del = mysql_fetch_assoc($deleted, MYSQL_BOTH);
			$Td = $del[0];

			echo "<div class='tab' style='background:#A0E813; position:relative; bottom:0px; left:10px; padding:1px;'>";
			echo "<font face='Georgia' color='#000000' size=6>";
			echo "<b>At a Glance:</b> </font><br /><font face='arial' color='#000000' size=5>";
	if (isset($_POST['date'])){
		echo "There were ".$ticked." tickets total opened on ".$today.".";
		echo "<br />";
		$p99 = mysql_fetch_array($p9, MYSQL_BOTH); 
		$p44 = mysql_fetch_array($p4, MYSQL_BOTH); 
		$p22 = mysql_fetch_array($p2, MYSQL_BOTH); 
		echo "There were ".$p22[0]." Priority 2 tickets.";
				echo "<br />";
		echo "There were ".$p44[0]." Priority 4 tickets.";
				echo "<br />";
		echo "There were ".$p99[0]." Priority 9 tickets.";
				echo "<br />";
		echo "$Td tickets have been removed from the queue for this date.";
			echo "</div></font>";

	$fields_num = mysql_num_fields($result);

	echo "<span class='added'><img src='/img/clickme_button.gif' height='25px' width='100px' border='0' /> &nbsp; <font face='Georgia' size='6px'><b>&nbsp; $ticked Tickets Added:</b></font></span>";
	echo "<table id='table'><tr>";
	//	printing first table of added tickets
	
	for($i=0; $i<$fields_num; $i++){ 
				$field = mysql_fetch_field($result);
				echo "<td><b><font face='Georgia'> {$field->name} </font></b></td>";
			}
			echo "</tr>\n";
					while($row = mysql_fetch_row($result)){ 
						foreach ( $row as $cell)        

			echo "<td>$cell</td>";
			echo "</tr>\n";
			
} 

			
 $removed = mysql_query("SELECT * FROM tickets WHERE Deleted = 'X' AND Removed_Datetime LIKE '$tDATE %'");
 
  if(!$removed) {    
			die ("Query to show fields from table failed");
		}
 
			$fields_num2 = mysql_num_fields($removed);

	// printing second table of removed tickets
		
		echo "</table><br />";
		print "<span class='removed'><img src='/img/rclickme_button.gif' height='25px' width='100px' border='0' />&nbsp; <font face='Georgia' size='6px'><b>&nbsp; $Td Tickets Removed:</b></font></span>";
		echo "<table id='table2'><tr>";
		
			for($j=0; $j<$fields_num2; $j++){ 
				$field2 = mysql_fetch_field($removed);
				echo "<td><b><font face='Arial'> {$field2->name} </font></b></td>";
			}
			echo "</tr>\n";
					while($row2 = mysql_fetch_row($removed)){ 
						foreach ( $row2 as $cell2)        

			echo "<td>$cell2</td>";
			echo "</tr>\n";
			}
		}	
	
		else {
		echo "You have not yet entered in a date.";
		}
	
 mysql_free_result($result);
mysql_close($con);
  ?>
  </div>
			</table>
		</center>
		<img id="iCal" src='/icons/calendar.png' border='0' title='Its a calendar!' style="display:none;"/>
	
<script type="text/javascript">
	/* ***	*	Google WebFont Archive 	*
	http://fonts.googleapis.com/css?family=Press+Start+2P|Noticia+Text|Cabin|Cabin+Condensed|Lato|Istok+Web|Source+Sans+Pro|Droid+Sans|Cantora+One|Electrolize|Ubuntu|Oswald|Share|Open+Sans|Dosis|Oxygen|UnifrakturCook
*	***	*/
var theme = $.cookie('theme');

  WebFontConfig = {
    google: { families: [ 'Source+Sans+Pro::latin', 'Lato::latin', 'Cantora+One::latin', 'Cabin+Condensed::latin', 'Istok+Web::latin', 'Ubuntu::latin', 'Open+Sans::latin', 'Share::latin', 'Electrolize::latin', 'Noticia+Text::latin', 'Oswald::latin', 'Press+Start+2P::latin', 'Dosis:400,600:latin', 'UnifrakturCook:700:latin', 'Oxygen::latin', 'PT+Serif+Caption::latin' ] }
  }; 
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 


function apply() {
				$('table#delTable tr:odd').addClass('tblOclr');
				$('table#delTable tr:even').addClass('tblEclr');
				$('table#delTable tr:first').addClass('tblFclr');
				$('table#delTable td').addClass('tblbrdr');

if($.cookie("theme")) {
	$("link").attr({
		href: $.cookie("theme"),
		rel: "stylesheet",
		type: "text/css"
	});
	}		
}


			

	$(document).ready( function() {
	
setTimeout('apply()', 1);

});
</script>

  <!-- // jQuery and Foundation frameworks apply before DOM load -->
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
  <!-- // Load Foundation vendor-specific library additions -->
<script type="text/javascript" src="js/jQuery_Plugins.js"></script>	
	
	</body>
  </html>