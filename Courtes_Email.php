<!DOCTYPE html>
<html>
<head>
<title>Alert Email</title>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: ['Gentium+Book+Basic::latin', 'Source+Sans+Pro::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
  </script>
</head>
<body>

<?php
	//	SMTP MAIL SETUP
require("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "smtp.isi-info.com"; // SMTP server
$mail->SetFrom("Alerts@tac-alert01","TAC Alerts");



$con = mysql_connect("localhost","root","");
	if (!$con)  {
		die('Could not connect: ' . mysql_error()); 
	}
		mysql_select_db("dbase", $con);
																// Deleted != 'X' AND                AND Priority > 2
		$sql = mysql_query("SELECT * FROM `tickets` WHERE (Deleted != 'X' AND Date < DATE_FORMAT(DATE(NOW()),'%c/%e/%Y')) OR (Deleted != 'X' AND Date = DATE_FORMAT(DATE(NOW()),'%c/%e/%Y') AND ETA < TIME(NOW()))");		
		$timer = mysql_query("SELECT DATE_FORMAT(DATE(NOW()),'%c/%e/%Y') AS DATED, TIME(NOW()) AS TIMED"); 
$Tdate = date('Y-m-d');
$DATE = date('n/j/Y');
	
	$counting = mysql_query("SELECT COUNT(*) FROM tickets WHERE  (Deleted != 'X' AND Date = DATE_FORMAT(DATE(NOW()),'%c/%e/%Y') AND ETA < TIME(NOW())) OR (Deleted != 'X' AND Date < DATE_FORMAT(DATE(NOW()),'%c/%e/%Y'))");		
		$count = mysql_fetch_assoc($counting, MYSQL_BOTH);
		$counted = $count[0];
	
	$tick = mysql_query("SELECT COUNT(*) FROM tickets WHERE Deleted !='X'");
		$ticke = mysql_fetch_assoc($tick, MYSQL_BOTH);
		$ticked = $ticke[0];		
				
	
	
				function mysql_fetch_rowsarr($result, $numass=MYSQL_BOTH) {
					$i=0;
					$rowz = mysql_num_rows($result);
					if (!$rowz) {
					die ('No tickets have reached ETA yet!');
					}
						$keys=array_keys(mysql_fetch_array($result, $numass));
						mysql_data_seek($result, 0);
					
					while ($row = mysql_fetch_array($result, $numass)) {
						foreach ($keys as $speckey) {
							$got[$i][$speckey]=$row[$speckey];
						}
						$i++;
						
					}
					return $got;
				
				}
							
			$results = mysql_fetch_rowsarr($sql);
				
		if (!$timer) {
			die('Could not query timer:' . mysql_error());
			}
		$results2 = mysql_fetch_rowsarr($timer);
		
	while ($row = mysql_fetch_array($timer, MYSQL_BOTH)) {
		$result2 = ($row[0][1]);  
		echo printf("date: %s  time: %s", $row[0], $row[1]);  
	}
	
			
	

		$r= rand (1,10);
		$qq = rand (1,100);

	$say = "cgi-bin/Quotes.txt";
	$quotes = file($say, true) or die("Can't open Quotes file.");
	$data = file_get_contents("cgi-bin/Quotes.txt"); //read the file
	$convert = explode("\n", $data); //create array separate by new line
		

$msg = "";
function msg_add($results) {

		if (isset($results[0])){
			$msg = "<li>Ticket #<b>".$results[0]['Ticket']."</b> for <b>".$results[0]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[0]['ETA']."</font></b> from ".$results[0]['Date']."</li><br>";
		}
		if (isset($results[1])){
   $msg .="<li>Ticket #<b>".$results[1]['Ticket']."</b> for <b>".$results[1]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[1]['ETA'].
   "</font></b> from ".$results[1]['Date']."</li><br>";
		}
		if (isset($results[2])){
   $msg .="<li>Ticket #<b>".$results[2]['Ticket']."</b> for <b>".$results[2]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[2]['ETA'].
   "</font></b> from ".$results[2]['Date']."</li><br>";
		}
		if (isset($results[3])){
   $msg .="<li>Ticket #<b>".$results[3]['Ticket']."</b> for <b>".$results[3]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[3]['ETA'].
   "</font></b> from ".$results[3]['Date']."</li><br>";
		}
		if (isset($results[4])){
   $msg .="<li>Ticket #<b>".$results[4]['Ticket']."</b> for <b>".$results[4]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[4]['ETA'].
   "</font></b> from ".$results[4]['Date']."</li><br>";
		}
		if (isset($results[5])){
   $msg .="<li>Ticket #<b>".$results[5]['Ticket']."</b> for <b>".$results[5]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[5]['ETA'].
   "</font></b> from ".$results[5]['Date']."</li><br>";
		}
		if (isset($results[6])){
   $msg .="<li>Ticket #<b>".$results[6]['Ticket']."</b> for <b>".$results[6]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[6]['ETA'].
   "</font></b> from ".$results[6]['Date']."</li><br>";
		}
		if (isset($results[7])){
   $msg .="<li>Ticket #<b>".$results[7]['Ticket']."</b> for <b>".$results[7]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[7]['ETA'].
   "</font></b> from ".$results[7]['Date']."</li><br>";
		}
		if (isset($results[8])){
   $msg .="<li>Ticket #<b>".$results[8]['Ticket']."</b> for <b>".$results[8]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[8]['ETA'].
   "</font></b> from ".$results[8]['Date']."</li><br>";
		}
		if (isset($results[9])){
   $msg .="<li>Ticket #<b>".$results[9]['Ticket']."</b> for <b>".$results[9]['Site']."</b> has an ETA of <b><font color=#ff0084>".$results[9]['ETA'].
   "</font></b> from ".$results[9]['Date']."</li><br>";
		}
return $msg;		
}


	// The count is to pull a quote from the TXT file of quotes in the cgi-bin folder. 
 //The quotes are split by line, and this randomly selects a line and dumps it into the email.
for ($i=0;$i<count($convert);$i++) 
{
    $q = $convert[$qq].' '; //write value by index
}
	
	// $test is for non-production purposes, ensuring the email formatting works in Microsoft Outlook. 
	//  This variable can be changed to any valid email address, since there is no validation check on this string.
$test = "jmulhern@isi-info.com";
$mail->WordWrap = 50;
$addys = ['dschmitt@isi-info.com','tgarza@isi-info.com','ssmith@isi-info.com','stylkowski@isi-info.com','jmulhern@isi-info.com'];
	$fh = array($addys);
	$emails = implode(',', $fh);
	$email = explode(',', $emails);
  	  list($dan,$tom,$shannon,$susan,$jimm) = $email;
				$mail->AddAddress($dan);
				$mail->AddAddress($tom);
				$mail->AddAddress($shannon);
				$mail->AddAddress($susan);
				$mail->AddAddress($jimm);
/*	$mail->AddAddress($test);		*/
				
//	$emails is the array storing the submitted  emails from the Alert System main page. 
//	Due to the nature of the SMTP mail library, the function cannot accept an array and must be repeated to accept all available mail recipients.
//   $to="$emails";
//   $from="TAC Alert System <alerts@isi-info.com>";
  $mail->Subject = "Courtsey Alert: $counted tickets have reached their ETA!";

  $mail->AddEmbeddedImage('img/isi2.gif', 'ISI', 'ISI-photo ');
  
  
  $HTML=" 
			<!-- //Insert HTML page into here -->
  ";
	
	// Test multiple SMTP recipients
	$mail->Body  = $HTML;
   
//		$headers = "MIME-Version: 1.0\r\n";
//		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
//		$headers.= "From: $from\r\n";
$mail->IsHTML(true);  
  
   if ($mail->Send()) {
	
	echo "<div style='background:#feea71; color:#000000;display:block;border:0px; padding:15px;width:500px;'><b>Message Sent</b> for <br>". msg_add($results) ."<br>";
	 
	 echo "<p style='background:#000000; color:#FFFFFF; padding:5px;'><br> $counted tickets have reached their ETA total, from a total of $ticked stil awaiting a callback. <br/> <b>Current Time is: </b><font color=#ff0084>".$results2[0]['TIMED']. 
	  "</p></font><br><br> $q </div> <br> The following technicians recieved the alert: $emails <br> <img src='http://tac-alert01/img/clippy.png' />";
	}
		else {
			echo "Failed to send message. Please contact <a href='mailto:jmulhern@isi-info.com'>Jim Mulhern</a> to report this.";
  exit;
}

?>
</body>
</html>