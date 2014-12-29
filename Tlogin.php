<div id='wrap'>
<?php 
require_once("database.php"); 
include('autologin.php');

	function NotLoggedIn() {
			$user = "Not Logged In";
			$USER = $_SERVER["REMOTE_ADDR"];
			$success = "#FFCCCC";
?>
		<div id='out'>
		<form id='form1' name='form1' method='post' action='checklogin.php'>
<?php	
 $IP = $_SERVER['REMOTE_ADDR'];
  $check = mysql_query("select username, password from dbase.members where IP='$IP'");
  $checkup = mysql_fetch_row($check);
  $MyLogin = $checkup[0];
  $MyPass = $checkup[1];
  ?>

<span id='chkbx'><input type="checkbox" id="auto" name="autologin" value="1"> Remember Me</span> &nbsp; &nbsp; 
<label for="Username">Username: </label><input name="myusername" type="text" id="myusername"  required>&nbsp;
<label for="Password">Password: </label><input name="mypassword" type="password" id="mypassword">&nbsp;
<button type="submit" name="Submit" value="Login"><img src='icons/user_go.png' border='0' /> Log In</button>
</form>
</span>

</div><span id="RegUser"><a href="RegUsr.php" target="_NEW">Click here <br> to register.</a></span>
<?php
};


function LoggedIn() {
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
		mysql_query("UPDATE dbase.members SET IP='$IP', LastLoggedIn='$LastLogged' WHERE username='$user'") or die("Could not update LastLoggedIn!". mysql_error() );
		

?>
		<div id='in' >		
You are <b class="Tshadow">cookied</b> as <b id="LoggedIn" >  <?php echo ucwords($Uuser) ;?> </b> - <small>Thank you</small>. 

</div><a href='TAClogout.php'><span id='outlog'> <b>Log Out?</b> </a></span>
<?php
};

  if( empty($_COOKIE['LoggedInAs']) ){
    $cookie = null;
  }
  else{
    $cookie = $_COOKIE['LoggedInAs'];
  }
	
	if($cookie) {
/***	
		LOGGED IN WITH COOKIES
													****/	
													LoggedIn();
		
	}
	else {
		NotLoggedIn();
	}
	
?>	
</div>