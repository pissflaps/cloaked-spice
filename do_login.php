<?php
require('database.php');
if(!$do_login) exit;

// declare post fields

$post_username = trim($_POST['username']);
$post_password = trim($_POST['password']);

$post_autologin = $_POST['autologin'];

if(($post_username == $config_username) && ($post_password == $config_password))
{
$login_ok = true;

$_SESSION['username'] = $config_username;

// Autologin Requested?

if($post_autologin == 1)
	{
	$password_hash = md5($config_password); // will result in a 32 characters hash
	$PASS = $config_password;

	setcookie ($cookie_name, 'usr='.$config_username.'&hash='.$PASS, time() + $cookie_time);
	}

header("Location: index.php");
exit;
}
else
{
$login_error = true;
}
?>