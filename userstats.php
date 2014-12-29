<?

/**
 * Connect to the mysql database.
 */
 global $conn;
 global $user;
 global $username;
 global $id;
 global $addy;
 

$conn = mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db('dbase', $conn) or die(mysql_error());

	$q = "select id, username from dbase.members where username = '$username'";
	$answer = mysql_query($q,$conn);

	$addy = $_SERVER['REMOTE_ADDR'];	
	if ($addy ='10.5.2.80') {
	$user = 'MSikes';
	$username = 'MSikes';
   }
   
  


?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>

.bgcolor {
background: #FFFF00;
background-color: #FFFF00;
}

body {
background: #eeeeee;
color: #000000;
padding-bottom:25px;
}

#answer2 {
background: #ffffcc;
}

#footer {
position: fixed;
bottom: 0px;
left: 0px;
background: #0073ea url(images/ui-bg_highlight-soft_25_0073ea_1x100.png) 50% 50% repeat-x;
color: #ffffff;
width:100%;

}

a * {
padding: 5px;
}

#footer a {
color: #dddddd;
text-decoration:none;
padding: 2px;
}
	#footer a:hover {
	color: #0073ea;
	background: #ffffff;
	border-radius: 5px;
	padding: 2px;
	}
	
	td:hover {	
	background: #eeFFcc;
	cursor: pointer;
	}
</style>

	<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<script src="js/jquery-1.6.2.js"></script>
	<link rel="stylesheet" href="css/demos.css">
		<link rel="shortcut icon" href="favicon2.ico" type="image/x-icon" />
	<script src="jquery/jquery-ui-1.8.17.all.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>
	<script type="text/javascript" src="js/modernizr.js"></script>
	<link rel="stylesheet" href="css/redmond/jquery-redmond.css" type="text/css" />
	
	<title>TAC: Find a user's activity</title>
				<script>
$(document).ready(function() {

	  $('button#subbutt').click(function (event) {
		
  
	   $.ajax({
                type: "GET",
                url: "userstats.php?id=$id",
                cache: false,
				success: function() {
				$('div#answer').show('fade', 1500);
				},
		});
		event.preventDefault;
});

	$(function () {
        $("button").button();
    });
});
</script>
</head>
<body>
<h1>Please select a technician</h1>
<br>
<form name="userpick" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
<?php 
global $USER;
$res= mysql_query("SELECT id, username FROM dbase.members where id > 0"); 
echo "<select name='id' >"; 
echo "<option value='null' selected> ====== </option>"; 
while($row=mysql_fetch_assoc($res)) { 
   echo '<option value="'.$row['username'].'">'.ucwords($row['username']).'</option>';

} 
echo "<option value='MSikes'> MSikes </option>"; 
echo "<option value='Not Logged In'> Not Logged In </option>"; 
echo "</select>";

?>
<button id="subbutt" type="submit" >Submit!</button>
</form>
<br><br/>


<span style="float:right;"><button id="hilite" name="highlight">Remove Highlighting</button></span>
<div id='answer'>
<?php 
if(!isset($_GET['id'])) {
	$USER = "";
	echo "<h3>You do not have a User selected.</h3>";
	}
	else {
	   			$time_start = microtime(true);
 $id = $_GET['id'];


$con = mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db('dbase', $con) or die(mysql_error());
	$QQ = "SELECT Ticket, Date, Stime, ETA, Priority, Comments FROM dbase.tickets WHERE removedby='$id' ORDER BY Date, Stime ASC";
$COUNTER = mysql_query("SELECT COUNT(*) FROM dbase.tickets WHERE removedby='$id' ");
$C = mysql_fetch_array($COUNTER);
$COUNT= $C[0];
   $result = mysql_query("SELECT Ticket, Date, STime, Site, Priority, Comments, removed_datetime FROM dbase.tickets WHERE removedby='$id' ORDER BY removed_datetime ASC");
   
   $fields_num = mysql_num_fields($result);

   
   echo "<div align='center'><br><h3>".
   "<table id='hi' cellpadding='5' cellspacing='3' style='background:#778899;'>"."<tr><h2>Recent Activity for ". ucwords($id) ."</h2></tr>";
   echo "<span style='background:#ffffcc;color:#000000;display:inline-block;padding:8px;z-index:3;'> ". ucwords($id) ." has taken a total of ". $COUNT ." tickets since originally logging in.</span>"; 
				for($i=0; $i<$fields_num; $i++){ 
				$field = mysql_fetch_field($result);
				echo "<td style='background:#cccccc; id='fields'><b> {$field->name}</b></td>";
			}
			echo "</tr>\n";
			
	
		while($row = mysql_fetch_row($result)){ 
				echo "<tr style='background:#eeeeee;'>";
				foreach ($row as $cell)     
					echo "<td>$cell</td>";
				echo "</tr>";
		}
			echo "</table></div>";
			
// Sleep for a while
mysql_query("SELECT Ticket, Date, Stime, ETA, Priority, Comments FROM dbase.tickets WHERE removedby='$id' ORDER BY Date, Stime ASC");

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "<center><h3> Query executed in $time seconds\n </h3></center>";
	}
?>
</h2>
</div>


<br><br/>
<div id="footer"><small>TAC Apps:</small>
<center>
<span id="linkwrap"><h2>

<a href="http://tac-alert01/search.php" target="_NEW" title="Ticket Search">  Ticket Search by Site</a> &nbsp;&nbsp;
<a href="http://tac-alert01/comsearch.php" target="_NEW" title="Ticket Search"> Ticket Search by Comments</a>&nbsp;&nbsp;
<a href="http://tac-alert01/PRIsearch.php" target="_NEW" title="Ticket Search"> Ticket Search by Priority</a>&nbsp;&nbsp;|| &nbsp;&nbsp;

<img src="icons/isicon.gif" /> <a href="http://tac-wiki/wiki/index.php" title="The ISI Wikibase" class="external" target="_new">Wikibase</a> &nbsp;<img src="icons/email.png" /> <a href="https://bex1.isi-info.com/owa" class="external" title="ISI's Remote Email Login" target="_NEW">Remote Email</a> &nbsp;<img src="icons/information.png"  /> <a href="http://tac-alert01/index.php" class="external" title="TAC's NEW Alert System" target="_new">TAC's Alert System</a> 
</div>
</h2></span>
</center>
</div>
<script>
$(document).ready( function() {
	
	$('table#hi td').live("click", function() {
			$(this).toggleClass("bgcolor");
		return false;
	});
		$('#hilite').live("click", function() {
				$('*').removeClass("bgcolor");
				return false;
		});

});
</script>
</body>