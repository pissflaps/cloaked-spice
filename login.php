<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="db2"; // Database name 
$tbl_name="members"; // Table name

require_once 'config.php';
if(isSet($_POST['submit']))
{
$do_login = true;

include_once 'do_login.php';
}

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['username']; 
$password=$_POST['password'];
$mypassword=  md5($_POST['password']);

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
header("location:login_success.php");
}
else {
echo "Wrong Username or Password 
<span style='clear:both;float:left;color:#00088B;'>
<h1>Not Registered?</h1> <br>
<a href='RegUsr.php'>Click here</a> to add yourself to the User Database.</span>";
}
?>