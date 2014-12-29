<?php
$host="localhost"; // Host name 
$username="infortel"; // Mysql username 
$password="T3lemanagement"; // Mysql password 
$db_name="dbase"; // Database name 
$tbl_name="members"; // Table name

$IP = $_SERVER['REMOTE_ADDR'];
$LastLogged = date('n/j/Y');
$Expires = time()+90*60*24*60;


require_once 'config.php';

if(isSet($_POST['submit']))
{
$do_login = true;

include_once 'do_login.php';
}


// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

/* ATTEMPTED COOKIE LOGIC
	if(isSet($_COOKIE['LoggedInAs'])) {
  $check = mysql_query("select username,password from members where IP='$IP'");
  $chkp = mysql_fetch_row($check);
  $LoginName = $chkp[0];
  $LoginPass= $chkp[1];
  
}
else { */
// username and password sent from form 
$myusername=$_POST['myusername']; 
$password=$_POST['mypassword'];
$mypassword=  md5($_POST['mypassword']);
$MyLoginPass=  md5($_POST['mypassword']);

  $check = mysql_query("select username,password, id from dbase.members where IP='$IP'");
  $chkp = mysql_fetch_row($check);
  $LoginName = $chkp[0];
  $LoginPass= $chkp[1];
  $LoginID= $chkp[2];
//	}
  if(isset($LoginName) && isset($LoginPass) && isset ($_POST['autologin']) ) {
	$myusername = $LoginName;
	$mypassword = $LoginPass;
	}
		else {
		// To protect MySQL injection (more detail about MySQL injection)
		$myusername = stripslashes($myusername);
		$mypassword = stripslashes($mypassword);
		$myusername = mysql_real_escape_string($myusername);
		$mypassword = mysql_real_escape_string($mypassword);
		}

$sql="SELECT * FROM dbase.members WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['myusername'] =$myusername;
$_SESSION['mypassword'] = $mypassword;
$_SESSION['auth'] = 1;
//		$sql2= "UPDATE $tbl_name SET IP='$IP', LastLoggedIn='$LastLogged' WHERE username='$myusername'";
//			mysql_query($sql2);

setcookie("LoginNum", $LoginID, $Expires); 
setcookie("LoggedInAs", $myusername, $Expires); 
setcookie("LoginPass", $MyLoginPass, $Expires); 
header("refresh:1; url=".$_SERVER['HTTP_REFERER']);
	exit;
}
else {
?>
<body bgcolor=#000000>
<font face='Lucida Console' color=#FF0000>
<?php
echo "<center><span style='vertical-align:middle; text-align:center; padding:2px;'> <img src='lesko.jpg' title='Lesko has questions for you.' /></span><br>";
echo "<center> <big><h1>Wrong Username or Password</h1></big> </font>
<span style='display:block;padding:25px;background:#888888;color:#f5fffa;border-radius:4px;border: 5px dotted #000000;'>
<h2>Not Registered?</h2>
<h3><a href='RegUsr.php'>Click here</a> to add yourself to the User Database.</h3>
<small style='float:right;'>or <a href='javascript: history.go(-1)'>go back</a> and re-type your password.</small></span></div><br>";
}

?>
