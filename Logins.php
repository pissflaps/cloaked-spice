<?php

 global $conn;
 global $user;
 global $username;
 global $id;

$conn = mysql_connect("localhost", "infortel", "T3lemanagement") or die(mysql_error());
mysql_select_db('dbase', $conn) or die(mysql_error());

	$q = "select username, password, IP, LastLoggedIn from members where username = '$username'";
	$answer = mysql_query($q,$conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
    <title>TAC's Removed Tickets</title>
  <!-- // Style sheets loaded in succession for structure elements and button layout configuration -->
  <link rel="stylesheet" href="css/production.css" type="text/css">
  <link rel="stylesheet" href="Foundation/css/foundation.min.css" type="text/css">
  <link rel="stylesheet" href="Foundation/icons/foundation-icons.css" type="text/css">
<style>

.bgcolor {
background: rgba(160, 225, 110, 0.8);
color: #444444;
}

body {
background: #bbbbbb;
color: #000000;
padding-bottom:-1px;
}
 #tblcntnr {
  padding-bottom: -1px;
 }
#answer2 {
background: #ffffcc;
}

#footer {
position: fixed;
display: inline-block;
bottom: 0px;
left: 0px;
background: rgba(30, 144, 255, 0.5); 
color: #ffffff;
width:100%;
padding-bottom: -1px;
}

a * {
padding: 5px;
}

#footer a {
color: #dadada;
text-decoration:none;
padding: 3px;
}
	#footer a:hover {
	color: #ff0084;
	background: rgba(250,250,250, 0.6);
	border-radius: 5px;
	padding: 3px;
	}

 td:hover {	
	background: rgba(110, 220, 80, 0.8);
	color: #000;
	cursor: pointer;
 }
</style>
	<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
		<link rel="shortcut icon" href="favicon2.ico" type="image/x-icon" />

	<title>TAC: User's login information</title>
</head>
<body>
<h1>Technician Login Cheat Sheet</h1>
<br><br/>


<span style="float:right;"><button id="hilite" name="highlight">Remove Highlighting</button></span>
<div id='answer'>
<?php 
		$time_start = microtime(true);
$QQ = "Select username, password, IP,LastLoggedIn from dbase.members where id > 0" ;
$result = mysql_query($QQ, $conn);
   $fields_num = mysql_num_fields($answer);
   
   echo "<div id='tblcntnr' align='center'><br>".
   "<table id='hi' cellpadding='5' cellspacing='3''>"."<thead><tr><h2> ". ucwords($id) ."</h2></tr>";
   			for($i=0; $i<$fields_num; $i++){ 
				$field = mysql_fetch_field($answer);
				echo "<th style='background:rgba(0,0,0,0.4);color:#ffffff;' id='fields'><b> {$field->name}</b></th>";
			}
			echo "</tr></thead><tbody>";
			
	
		while($row = mysql_fetch_row($result)){ 
				echo "<tr >";
				foreach ($row as $cell)     
					echo "<td style='border-right:1px solid #bbb;'>$cell</td>";
				echo "</tr>";
		}
			echo "</tbody></table></div>";
			
// Sleep for a while
mysql_query("select id, username, password, IP, LastLoggedIn from dbase.members where username = '$username");

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "<center><h3> Query executed in $time seconds\n </h3></center>";
?>
</div>
<br>
 <p>
<br>

<footer id="footer"><small>TAC Apps:</small>
<center>
<span id="linkwrap"><h4>

<a href="http://tac-alert01/search.php" target="_NEW" title="Ticket Search">  Ticket Search by Site</a> &nbsp;&nbsp;
<a href="http://tac-alert01/comsearch.php" target="_NEW" title="Ticket Search"> Ticket Search by Comments</a>&nbsp;&nbsp;
<a href="http://tac-alert01/PRIsearch.php" target="_NEW" title="Ticket Search"> Ticket Search by Priority</a>&nbsp;&nbsp;|| &nbsp;&nbsp;

<img src="icons/isicon.gif" /> <a href="http://tac-wiki/wiki/index.php" title="The ISI Wikibase" class="external" target="_new">Wikibase</a> &nbsp;<img src="icons/email.png" /> <a href="https://bex1.isi-info.com/owa" class="external" title="ISI's Remote Email Login" target="_NEW">Remote Email</a> &nbsp;<img src="icons/information.png"  /> <a href="http://tac-alert01/index.php" class="external" title="TAC's NEW Alert System" target="_new">TAC's Alert System</a> 
</div>
</h4></span>
</center>
</footer>
<script type="text/javascript">
$(document).ready( function() {
	
	$(document).on("click","table#hi td", function() {
			$(this).parent('tr').toggleClass("bgcolor");
		return false;
	});
		$(document).on("click","#hilite", function() {
				$('*').removeClass("bgcolor");
				return false;
		});
});
</script>
</body>