<?php

// start session

session_start();

if (!$_SESSION['auth'] == 1) {

    // check if authentication was performed

    // else die with error

    die ("ERROR: Unauthorized access!");

}

else {

require_once 'config.php';

// Is the user already logged in? Redirect him/her to the private page

if($_SESSION['myusername'])
{
header("Location: index.php");
exit;
}

if(isSet($_POST['myusername']))
{
$do_login = true;

include_once 'do_login.php';
}
?>

    <html>

    <head></head>

    <body>

    This is a secure page. You can only see this if $_SESSION['auth'] = 1

    </body>

    </html>

<?php

}

?>
