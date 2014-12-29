<!DOCTYPE html>
<html>
<head>
<title>TAC's Ticket Adder</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link href='http://fonts.googleapis.com/css?family=Istok+Web:700|Lato:700|Droid+Sans|Terminal+Dosis' rel='stylesheet' type='text/css'>
	<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<link href="/css/jquery.ui.button.css" rel="alternate stylesheet" type="text/css"/>
	<link href="/jQuery/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="/js/jquery.form.js"></script> 
		<link rel="stylesheet" href="/css/dbase.css" type="text/css" />
  <script src="/js/jquery-ui.custom.min.js"></script>
  		  <script type="text/javascript" src="/js/jquery.cookie.js"></script>
  
		<script>
		$(document).ready(function()
			{ 		
			
			$('button#submit ').click(function()
			{
			$.ajax(
				{
					   type: "get",
					   url: "tickadd.php?ticket=$add",
					   cache: false,
					   dataType: 'html',
				});
			});
			
		});
		</script>
	<script>
	
$(document).ready(function(){
$('table#addTable td a.add ').click(function()
		{
			if (confirm("Are you sure you want to re-add this ticket?"))
			{
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();
				$.ajax(
				{
					   type: "POST",
					   url: "add.php?id=$add",
					   data: data,
					   dataType: 'html',
					   cache: false,
					
					   success: function()
					   {
							parent.fadeOut(800, function() {$(this).remove();});
							self.parent.tb_remove(); 
					   }
				 });				
}
		});

});
			</script>
	<script>
				// style the table with alternate colors
		// sets specified color for every odd row
		$(document).ready(function(){
		$('table#addTable tr:odd').css('background',' #30cd30');
			$(function() { 	
			   $("button").button();
			});
		});
</script>
<script type="text/javascript">
    /* attach a submit handler to the form */
  $("#add").submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault(); 
        
    /* get some values from elements on the page: */
    var $form = $( this ),
        term = $form.find( 'input' ).val(),
        url = $form.attr( 'action' );

    /* Send the data using post */
    $.post( url, { s: term },

});
</script> 
  <style>
  body{
  background: #EFCDAB;
  min-width:85%;
  z-index:1;
  }
  </style>
</head>

<body>
<div style="position:fixed; float:left; bottom:0; left:0;z-index:0;"><img src="/img/tickadder.gif" height="150px" width="150px" border="0" title="TAC's Ticket Adder" /></div>
<center>
<font face="Arial" size=4>Please enter a ticket to re-add it to the Alert Queue:</font>
<br><br />
<form name="ticket" id="add" METHOD="GET">
<input type="text" name="ticket" MAXLENGTH=7 placeholder="Ticket Number" /> &nbsp; &nbsp;
<Button TYPE="submit" class="positive" NAME="Submit" VALUE="Submit"  border="0" ><img src="/icons/magnifier.png" height="20px" width="20px" border="0" alt=""/> Submit</button>
</form>
<br />
<?php
error_reporting(E_ALL ^ E_NOTICE); 

$db_host = 'localhost';
$db_user = 'infortel';
$db_pwd = 'T3lemanagement';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$add = $_GET['ticket'];


	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");
 
 // sending query
 
  
 $result = mysql_query("SELECT * FROM tickets WHERE Ticket = '$add'");
		if(!$result) {    
			die ("Query to show fields from table failed");
		}
 
	$fields_num = mysql_num_fields($result);
	echo "<table border='0' id='addTable'><tr><td style='background:#30cd30;'><big>+</big></td>";
	
		// printing table headers
		
			for($i=0; $i<$fields_num; $i++){ 
				$field = mysql_fetch_field($result);
				echo "<td><b><font face='Georgia'> {$field->name} </font></b></td>";
			}
			echo "</tr>\n";
 
	// printing table rows, beneath field headers.
		//mysql_query("SELECT (*) FROM ($table) WHERE ($ticket) IS NOT NULL");
 
		$addlink = "<a href='#' class='add' title='Re-add this ticket' id='tadd'><img border='0' src='/icons/database_add.png' /></a>";
			$sql = "SELECT * FROM tickets WHERE Ticket = '$add'"; 
			// $sequel = mysql_query($sql); 
				$sequel = mysql_query($sql) or die(mysql_error());
				

	// if (isset($add)){ 
	// $tickadd = mysql_query("UPDATE tickets SET Deleted = 'O', Removed_Datetime = ' ' WHERE Ticket = '$add'") or die("Could not add your ticket". mysql_error());
	// }
		while($row = mysql_fetch_row($result)){ 
	if (isset($add)){ 
		echo "<tr id=$add>";
		echo "<td>$addlink</td>";
			foreach ($row as $cell)        
			echo "<td>$cell</td>";
		
			echo "</tr>\n";
			}
	else {
		echo "<td bgcolor='#FFCCCC'>No Tickets matched your input. Please enter a valid ticket number.</td>";
		}
	}
 mysql_free_result($result);
 
mysql_close($con);
  ?>
</div>
</body>
</html>
  </table>
    </center>
</body>
</html>	



