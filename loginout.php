<div id='lid'></div>
<div id='wrap'>
<?php 
require_once("database.php"); 
include('autologin.php');
	$cookie = $_COOKIE['LoggedInAs'];
	if($cookie) {
		
/***	
		LOGGED IN WITH COOKIES
													****/
		$IP = $_SERVER['REMOTE_ADDR'];
		date_default_timezone_set('America/Chicago');
		$LastLogged = date('n/j/Y \@ g:i A');
		$_SESSION['myusername'] = $_COOKIE['LoggedInAs'];
	

		/*	*** 
				Update a SQL table to denote the last time a user has logged in to the Alert System.		
																																			***	*/

		$USER = $_SESSION['myusername'];
		$Uuser = $_COOKIE['LoggedInAs'];
		$user = $_SESSION['myusername'];
		mysql_query("UPDATE dbase.members SET IP='$IP', LastLoggedIn='$LastLogged' WHERE username='$user'") or die("ERROR: Could not update LastLogged In! " .  mysql_error() );

?>
		<div id='in' >		
You are <b class="Tshadow">cookied</b> as <b id="LoggedIn" ><img src='icons/user.png' border='0'/><?php echo ucwords($Uuser) ;?> </b> &nbsp; - Thank you. 
<span id='outlog'><a href='logout.php'> Log Out? </a></span> <b id='close'>hide</b>
</div>
<?php
}
else {

	/* 	This is the login status, depicting either a Green bar to indicate a user is logged in, and a Red bar to indicate the user still needs
		to log in to remove tickets from the queue. The status bar drops down from the top of the browser window four seconds after the page loads.
	When clicked outside of the login/logout button, the status bar will roll back up into hiding. It will not return until the page is reloaded. */
$addy = $_SERVER['REMOTE_ADDR'];

if(isset($_SESSION['myusername'])) {

		$success = "#00aa00";
		$user = $_SESSION['myusername'];
		$md5pass = $_SESSION['mypassword'];
		$IP = $_SERVER['REMOTE_ADDR'];
				$LastLogged = date('n/j/Y \@ g:i A');
		$USER = $_SESSION['myusername'];
		mysql_select_db('dbase');
			$UPDATE= mysql_query("UPDATE dbase.members SET IP='$IP', LastLoggedIn='$LastLogged' WHERE username='$user'") or die("Could not update LastLoggedIn" . mysql_error() );

			if($UPDATE == 1){
//			setcookie("LoggedInAs", $user, $OneYear);		
		$Uuser = ucwords($user);
?>
<div id='in' >		
You are still logged in as <b id="LoggedIn" ><img src='icons/user.png' border='0'/><?php echo $Uuser ;?> </b> &nbsp; - Thank you. 
<span id='outlog'><a href='logout.php'> Log Out? </a></span> <b id='close'>hide</b>
</div>
<?php 
}
			
			

?>
</div>
<?php
}
else {
$user = "Not Logged In";
$USER = $_SERVER["REMOTE_ADDR"];
$success = "#FFCCCC";
?>	<div id='out'>
		<form id='form1' name='form1' method='post' action='checklogin.php'>
		<span id="NotLogged" title="<?php echo $USER; ?>" ><img src='icons/status_offline.png' border='0' />Not Logged In</span> &nbsp;&nbsp;&nbsp;
<?php	
 $IP = $_SERVER['REMOTE_ADDR'];
  $check = mysql_query("select username, password from dbase.members where IP='$IP'");
  $checkup = mysql_fetch_row($check);
  $MyLogin = $checkup[0];
  $MyPass = $checkup[1];
  ?>


<script>
$(document).ready( function() {

var newDate = new Date();
var trackId = newDate.getTime(); //creates a unique id with the milliseconds since January 1, 1970
var values = new Array();
var name = "<?php echo $MyLogin ?>";
var IP = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
var hours = newDate.toLocaleTimeString();
var date = "<?php echo $DATE ?>";
var PASS = "<?php echo $MyPass ?>";
	
	
	
function checked() {
	if($('input:checkbox').is(':checked')) {	
				$('#myusername').val(name);
				$('#mypassword').val(PASS);
				localStorage.setItem(name, PASS); //store the item in the database
				$.cookie('LoggedInAs', name, { expires: '9999', path: '/' });	
				$.cookie('LoginPass', PASS, { expires: '9999', path: '/' });	
		}
			else{
				var inputName= $('#myusername').val();
				var inputPass= $('#mypassword').val();
					localStorage.setItem(inputName, IP); //store the item in the database
					$.cookie('LoggedInAs', inputName, { expires: '9999', path: '/' });	
					$.cookie('LoginPass', inputPass, { expires: '9999', path: '/' });	
		}
	}
	
	$("#auto").on("click", function(){
		checked();
		});
	
});
	 
</script>
	
<input type="checkbox" id="auto" name="autologin" value="1"> Remember Me &nbsp;&nbsp; 
<label for="Username">Username: </label><input name="myusername" type="text" id="myusername"  required>&nbsp;&nbsp;
<label for="Password">Password: </label><input name="mypassword" type="password" id="mypassword">&nbsp;&nbsp;
<button type="submit" name="Submit" value="Login">Submit</button>
</form>
</span>
<span id="RegUser"><a href="RegUsr.php">Click here <br> to register.</a></span>
</div>
<?php
}

}

?>
</div>