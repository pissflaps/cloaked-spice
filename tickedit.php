<!DOCTYPE html>
<meta http-equiv="x-ua-compatible" content="IE=9">
<meta charset="utf-8">
<html lang="en">
<head>
<title>TAC's Ticket Editor - Click to edit and be on your way!</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
    <title>TAC's Alert System</title>
  <!-- // Style sheets loaded in succession for structure elements and button layout configuration --> 
  <link rel="stylesheet" type="text/css" href="css/production.css" class="theme">
	<link rel="stylesheet" href="css/structure.css">
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script> 		
  <script type="text/javascript" src="js/jquery.form.js"></script> 
<?php 
			// list out our first-accessed variables for connecting to the database.
$db_host = 'localhost';
$db_user = 'infortel';
$db_pwd = 'T3lemanagement';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
global $TicNum;

	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");

?>
<style>

		body{
			position: relative;
			font: 14px Arial,Verdana, sans-serif;
			background:#3383bb;
			color:#f5fffa;
			padding: 0px;
			margin: 0px;
		}
.corners{
		-moz-border-radius: 8px;
		border-bottom-right-radius: 8px;
		border-top-left-radius: 8px;
}

input {
padding:5px;
border-radius: 4px;
}
	#TicketTable {
		background: transparent;
		color: #ffffff;
	}
		#content{
		background: transparent;
		}
	#table {
		text-align: center;
		vertical-align: top;
		color: #000000;
	}

	#table td{
		padding: 5px;
		border-radius: 2px;
	}
	#divtop {
	display: inline;
	text-align: center;
	vertical-align: top;
	}
	#divbottom {
	text-align: left;
	vertical-align: top;
	display: block;
	padding: 5px;
	background: transparent;
	}
	
	.outline {
	border: 1px solid #444444;
	}
	
	#status {
		display: none;
	 padding:10px;
	 margin: 5px auto;
	 border-radius: 4px;
	 clear:both;
	 }
		.success{
		background: #32cd32;
		color: #EEFFCC;
		border:1px solid #006400;
		}
		.error{
		background: #FFCCCC;
		color: #BD0000;
		border: 1px solid #FF0000;
		}
	 #noticket {
	 background: transparent;
	 color: #eeeeee;
	 text-shadow: #444444 0.15em 0.15em 0.25em;
	 font-size: 1.25em;
	 line-height: 1.5;
	 }
	 
	 #save {
	 margin: 5px auto;
	 color: #000000;
	 }
	 
	 #pgTitle{
	 display:block;
	 font-family: Arial Black, Arial, Sans-serif;
	 font-size: 14px;
	 background: #599fcf;
	 color: #f5fffa;
	 text-align: center;
	 padding: 5px;
	 }
		#pgTitle sub{
		font-family: Courier New, Arial, sans-serif;
		font-size: 12px;
		color: #ffffff;
		line-height: 0.75;
		}
			#PutInQ{
			display:none;
			padding:10px;
			margin: 5px auto;
			border-radius: 4px;
			float:right;
			}
				#Putback{
					background: #0073ea;
					color: #000000;
					border-radius: 4px;
					border: 1px solid #0000FF;
					}
					#Putback:hover{
						background: #006400;
						color: #EEFFCC;
						border: 1px solid #32cd32;
						}
			
</style>

<script type="text/javascript" >
$(document).foundation();

$(document).ready(function(){ 	
	$('#save, #cancel').hide();
	
			$(document).on("click","#Lookup", function(){
				var $Ticket = $('#Ticket').val();
					$.ajax({
							   type: "GET",
							   url: "tickedit.php?",
							   data: 'TicNum=' + $Ticket,
							   cache: false,
							   dataType: 'html'
							   
					});
		});
	$('#table tr:odd').css({'background': ' rgba(0,0,0, 0.3)', 'color' : '#ffffff' });
    $('#table tr:first').css({'background': ' #0073EE', 'color': '#FFFDEF', 'border': '1px solid #0000FF' });

	
		
});
</script>
	

</head>

<body>
	<div id="pgTitle">
		<h2>Edit a Ticket in Real-time!</h2>
<hr style="border:2px dashed #bbbbbb;">
		<sub>Submit a ticket, then click the fields to edit them.</sub>
	</div>
<br>
<div id="divtop">

<form name="Zticket" METHOD="GET" action="<? echo $_SERVER['PHP_SELF']; ?>" >
<input type="text" name="TicNum" id="Ticket" placeholder="Ticket Number" MAXLENGTH=6 TABINDEX=1 class='outline' required /> &nbsp;&nbsp;

<button type="submit" id="Lookup"  border="0" >Submit <img src="/icons/bullet_go.png" border="0" alt=""/></button> &nbsp;
</form>
</div>



<?php

if(isset( $_GET['TicNum'] )) { 

$TicNum = $_GET['TicNum'];
			echo "<div id='divbottom'>";
	
				 $result = mysql_query("SELECT Ticket, Priority, Site AS 'Site Name', Comments, ContactPref FROM tickets WHERE Ticket='$TicNum' ORDER BY Ticket ASC");
				if(!$result) {    
					die ("Query to find your ticket has failed.");
		}
			
			
	$fields_num = mysql_num_fields($result);
?>
<div id="status"></div>
<?php	
	echo "<div id='TicketTable'>
			<center>
			<table id='table'><tbody><div id='content'><tr>";
				//	printing first table of added tickets
		for($i=0; $i<$fields_num; $i++){ 
				$field = mysql_fetch_field($result);
			echo "<td><b> {$field->name} </b></td>";
			}
			echo "</tr>\n";
			$j=0;
						while($row = mysql_fetch_row($result)){ 
							foreach ( $row as $cell)  
			echo "<td><div id='editable". $j++ ."' contentEditable='true' >$cell</div></td>";
			echo "</tr>\n";
			}
				echo "</div>";
		?>
</tbody></table><br><div id="ticknum" style="visibility:hidden"><?php echo $TicNum; ?></div>
		<button id='save' class="success">Save Changes</button> &nbsp; <button id="cancel" class="error">Cancel Changes</button> </div>
<?php
}
	else {
			echo "<center> <h1><b id='noticket'>No Ticket entered yet.</h1></b></center>";
}

?>	
</div>
<script type="text/javascript" >
$(document).ready(function() {
	
	$('#editable0,#editable1,#editable2,#editable3,#editable4').focus( function() {
		var parent= $(this).parent();
			$(this).css({'background': '#FFFFFF', 'color': '#000000', 'border': '1px solid #000000', 'padding': '2px' });
			parent.css({'background': '#006400', 'color': '#FFFFFF', 'border': '1px solid #32CD32' });
			$("#save").fadeIn(100);
		})
		.blur( function() {
				$(this).css({'background': 'transparent', 'color': '#EEFFCC', 'border' : 'none'});
				$("#cancel").fadeIn(200);
	});
			$(document).on("click", "#save", function() {
				$('#editable0,#editable1,#editable2,#editable3,#editable4').css({'background': 'transparent', 'color': '#f5fffa', 'border': 'none', 'padding': '1px' });
				
				var C0 = $('#editable0').html();
				var C1 = $('#editable1').html();
				var C2 = $('#editable2').html();
				var C3 = $('#editable3').html();
				var C4 = $("#ticknum").text();
				var C5 = $("#editable4").html();
					if ( $("#ticknum:empty")) {
						C4 = $('#editable0').html();
					}
				var content = [C0, C1, C2, C3, C4, C5];
								
					$.ajax({
						url: 'save.php',
						type: 'POST',
						data: {
							content: content
						},
						success: function(data) {
							if (data == '1'){
								$('#status')
									.addClass("success")
									.html("Successfully updated Ticket #<b>"+ C0 +"</b>!")
									.fadeIn(600)
									.delay(1000)
									.fadeOut(1000);
									$("#save").fadeOut(100);
									
									$("#PutInQ").fadeIn(600);
									$("#cancel").fadeOut(100);
							}
							else {
								$('#status')
									.addClass("error")
									.html("<u><b>Error</b></u>, " +content+" : Did not post because : "+data)
									.fadeIn(600)
									.delay(9000)
									.fadeOut(1000);
							}
						},
						complete: function(){
							$("#editable0,#editable1,#editable2,#editable3,#editable4").parent().fadeTo('slow', 0.25, function() {
								$(this).css({'background': '#000000', 'color': '#ffffff', 'border': 'none'});
								}).fadeTo('slow', 1.0 );
								$(this).blur();
						}
					});
			});
});
</script> 
				<div id="PutInQ"><form id='hidnForm'><input type="hidden" id='TicNum' value="<?php echo $TicNum; ?>"></form>
				<button id="Putback">Put it back into the Open Queue</button></div>
	<script type="text/javascript">
$(document).ready(function() {	
			$(document).on("click","#Putback", function(){
				var C0 = $('#editable0').html();
				var $Ticket = C0;
				var $data = 'TicNum=' + $Ticket;
					$.ajax({
						url: 'Putback.php',
						type: 'POST',
						data: $data,
							success: function(data) {
							if (data == '1'){
								$('#status')
									.addClass("success")
									.html("Ticket #"+ $Ticket +" was returned to the Open Queue!")
									.fadeIn(600)
									.delay(500)
									.fadeOut(100);
									$("#PutInQ").fadeOut(600);
									$("#divbottom").delay(900).fadeOut(900);
							}
							else {
								$('#status')
									.addClass("error")
									.html("<u><b>Error</b></u>, " + content +" : Did not post because : " + data)
									.fadeIn(600)
									.delay(900)
									.fadeOut(900);
							}
						}
				});
			});
		$(document).on("click","#cancel", function() {
			setTimeout('window.location.reload()', 10); 
		});
});
	</script>

  <!-- // Foundation.min contains all modules in the event of expansion being needed into other library functions -->
<script type="text/javascript" src="Foundation/Tables/responsive-tables.js"></script>
  <!-- // Responsive Tables Plug-in provided by Foundation Framework // -->
  <!-- // jQuery and Foundation frameworks apply before DOM load -->
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
  <!-- // Load Foundation vendor-specific library additions -->
<script type="text/javascript" src="js/jQuery_Plugins.js"></script>
<!-- // Compressed version of all related vendor plug-ins used in jQuery -->	
</body>
</html>