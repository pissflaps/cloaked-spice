<?php 
require_once('database.php'); 
include('autologin.php');

	function NotLoggedIn() {
			$user = "Not Logged In";
			$USER = $_SERVER["REMOTE_ADDR"];
			$success = "#FFCCCC";

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
var name = "<?php echo $MyLogin; ?>";
var IP = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
var hours = newDate.toLocaleTimeString();
var date = "<?php echo $DATE; ?>";
var PASS = "<?php echo $MyPass; ?>";

function checked() {
	if($('input:checkbox').prop('checked')) {	
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
	
	$(document).on("click","#auto", function(){
		checked();
		});
		
	$( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 325,
      width: 375,
      modal: true,
      buttons: {
        "Login to TAC Alert": function() {
			$('#form1').submit();
          },
        Cancel: function() {
          $( this ).dialog( "close" );
			setTimeout('window.location.reload()', 1); 
        }
	  }
    });
	$(document).on("click", "#LogIN", function() {
        $( "#dialog-form" ).dialog( "open" );
		$('#form1').html("<label for='Username'>Username: </label><input name='myusername' type='text' id='myusername' placeholder='Username'  required>&nbsp;"+
			"<br><label for='Password'>Password: </label><input name='mypassword' type='password' id='mypassword' placeholder='Password'>"+
			"<br><span id='chkbx'><input type='checkbox' id='auto' name='autologin' value='1'> Remember Me</span><br>"+
			"<br><sub id='register'>Not Registered? <br><a href='RegUsr.php'> Click here </a> to create an account.</sub>"
		);
				$('#form1').keypress(function (e) {
					if (e.which == 13) {
						$(this).submit();
						$('#dialog-form').dialog("close");
					}
				});
      });
	
});
</script>
<div id='out'>
<button id="LogIN" class="primary"><img src='icons/user_go.png' border='0' /> Log In</button> 
		
<div id="dialog-form" title="Log in to TAC Alert">
<form id='form1' name='form1' method='post' action='checklogin.php'>
</form>

</div>
</div>
<?php
};


function LoggedIn() {
		$IP = $_SERVER['REMOTE_ADDR'];
		date_default_timezone_set('America/Chicago');
		$LastLogged = date('n/j/Y \@ g:i A');
		$_SESSION['myusername'] = $_COOKIE['LoggedInAs'];

		$USER = $_SESSION['myusername'];
		$Uuser = $_COOKIE['LoggedInAs'];
		$user = $_SESSION['myusername'];
 mysql_query("UPDATE dbase.members SET IP='$IP', LastLoggedIn='$LastLogged' WHERE username='$user'") or die("Could not update LastLoggedIn!". mysql_error() );
?>
		<div id='in'>
You are <b class="Tshadow">cookied</b> as  <b id="LoggedIn" >  <?php echo ucwords($Uuser); ?> </b> - <small>Thank you</small>. 

<a href='TAClogout.php'><span id='outlog'> <b>Log Out?</b> </a></span>
</div>
<?php
};


$cookie = $_COOKIE['LoggedInAs'];
  if($cookie) {
/*** LOGGED IN WITH COOKIES ****/	
  LoggedIn();
	}
 else {
    NotLoggedIn();
 }
?>