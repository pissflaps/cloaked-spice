<?php include("session.php"); ?>
<?php require("database.php"); ?>
<?php
$IP = $_SERVER['REMOTE_ADDR'];
  $check = mysql_query("select username, password from members where IP='$IP'");
  $checkup = mysql_fetch_row($check);
  $MyLogin = $checkup[0];
  $MyPass = $checkup[1];
  
  
?>  
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/jquery.ui.all.css">
<script src="js/jquery-1.7.1.js"></script>
<script src="jquery/jquery-ui-1.8.17.all.js"></script>

	<meta charset="utf-8">
		<title>Alert System Login</title>
<style>
body {
background: #dddddd;
}

#form {
display:block;
background: #eeeeee;
padding: 1em;
}

#form1 {
background: transparent;
padding: 1em;
border-radius:5px;
}
</style>
<script type="text/javascript" src="js/jquery.cookie.js"></script>

	<script>
		
var newDate = new Date();
var trackId = newDate.getTime(); //creates a unique id with the milliseconds since January 1, 1970
var values = new Array();
var name = "<?php echo $MyLogin ?>";
var IP = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
var hours = newDate.toLocaleTimeString();
var date = "<?php echo $DATE ?>";
var PASS = "<?php echo $MyPass ?>";
var inputName = $('#myusername').val();
var inputPass = $('#mypassword').val();

$(document).ready( function() {
	$('#hint').hide();
	$('#hint').delay(1500).fadeIn(2500);
	$('input:checkbox').click(function() {
		if($(this).is(':checked')) {
			$('#hint').fadeOut('slow');
				$('#myusername').val(name);
				$('#mypassword').val(PASS);
				localStorage.clear();  
			$.cookie('LoggedInAs', null);
				localStorage.setItem(name, IP); //store the item in the database
				$.cookie('LoggedInAs', name , PASS, { expires: 365, path: '/' });	
			}
			else {
				$('#myusername').val('');
				$('#mypassword').val('');
						localStorage.clear();  
					$.cookie('LoggedInAs', null);
						localStorage.setItem(inputName, IP); //store the item in the database
				$.cookie('LoggedInAs', inputName , inputPass, { expires: 365, path: '/' });	
			}
		});
			$(function () {
				$("button").button();
			});
    }); 
	</script>
</head>
	<body>
<div id="form" align="middle">
<font face="Georgia" color=#00008B><h1>Log in to TAC's Alert System</h1></font>
<table width="20%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form id="form1" name="form1" method="post" action="checklogin.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>User Login </strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="myusername" type="text" id="myusername"  required></td>
</tr>
<tr>
<td width="78">Password</td>
<td width="6">:</td>
<td width="294"><input name="mypassword" type="password" id="mypassword" > <br> 
<label>&nbsp;</label><input type="checkbox" name="autologin" value="1">Remember Me
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><button type="submit" name="Submit" value="Login">Submit</button></td>

</tr>
</table>
</td>
</form>
</tr>

<tr>
<td>
Not Registered? 
<a href="RegUsr.php">Click here</a> to add yourself to the User Database.
</td>
</tr>
</table><br>
<span id='hint' style="color:#000000;background:#FFFFCC;opacity:0.75;border-radius:5px;padding:10px;">Hint: Clicking the '<b>Remember Me</b>' checkbox will insert your username and password if you are registered.</span>
<br>
</div>
<br>

	</body>
</html>