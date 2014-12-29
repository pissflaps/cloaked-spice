
<?php
$to = "jmulhern@isi-info.com";
$subject = "* * * TEST EMAILZZZZZZZ";
$email = $_REQUEST['NAME'] ;
$message = $_REQUEST['AGE'] ;
$headers = "From: $email";
$sent = mail($to, $subject, $message, $headers) ;
if($sent)
{print "Your mail was sent successfully"; }
else
{print"We encountered an error sending your mail"; }
?>
