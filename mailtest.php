<html><head>
<style>
#email {
background: url('http://tac-alert01/img/post_it.png';
}
</style>
</head>
<body>
<?php
ini_set("SMTP","smtp.isi-info.com");
ini_set("smtp_port","25");

$con = mysql_connect("localhost","root","");
	if (!$con)  {
		die('Could not connect: ' . mysql_error()); 
	}
		mysql_select_db("dbase", $con);
																// Deleted != 'X' AND                AND Priority > 2
		$sql = mysql_query("SELECT * FROM `tickets` WHERE Deleted != 'X' AND Date <= DATE_FORMAT(DATE(NOW()),'%c/%e/%Y') AND ETA > TIME(NOW())");		
		$timer = mysql_query("SELECT DATE_FORMAT(DATE(NOW()),'%c/%e/%Y') AS DATED, TIME(NOW()) AS TIMED"); 
		
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


	$addys = "Email.txt";
	$fh = file($addys, true) or die("Can't open email file");
	$emails = implode(',', $fh);
	$email = explode(',', $emails);

		$r= rand (1,10);
		$qq = rand (1,100);

	$say = "cgi-bin/Quotes.txt";
	$quotes = file($say, true) or die("Can't open Quotes file.");
	$data = file_get_contents("cgi-bin/Quotes.txt"); //read the file
	$convert = explode("\n", $data); //create array separate by new line

for ($i=0;$i<count($convert);$i++) 
{
    $q = $convert[$qq].' '; //write value by index
}



   $to="jmulhern@isi-info.com";
   $from="TAC Alert System <alert@isi-info.com>";
   $subject="TAC Alert: Ticket # ".$results[0]['Ticket']." Site: ".$results[0]['Site']." Priority ".$results[0]['Priority']." ";
   $message ="<img src='http://tac-alert01/img/postit_top.png' /><br />";
   $message .="<div style='background:#feea71;padding:20px;display:block;border:0px;z-index:9;'><font face='Arial Black' color=#FF0000 size=6><b>Alert!</b></font> <br>The following ticket has reached its ETA:<br>".
   "Ticket #<b>".$results[0]['Ticket']."</b> for <b>".$results[0]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[0]['ETA'].
   "</font></b> from ".$results[0]['Date'].
   "<br> <br /><span style='background:#FFFFCC; display:inline;color:#000000; padding:15px;'><b>Current Time is: </b> ".$results2[0]['TIMED']."</span>
   <br> Please contact the customer and remove it from the open queue.";

// $message .= "<h1><u>The following has been a test.</u></h1>";   

   $message .="<br><h3>Thank you, <br> <sub><a href='http://tac-alert01/index.php'>TAC's Alert System</a></sub> </h3>";
   $message .= "<br> $q </div>";
   $message .= "</center><img src='http://tac-alert01/img/postit_bottom.png' /><br />";
   			// $results[0]['ETA']

   
		$headers = "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers.= "From: $from\r\n";
		
   if (mail($to, $subject, $message, $headers))
      echo "<div style='background:#feea71; color:#000000;display:block;border:0px; padding:15px;width:500px;'><b>Message Sent</b> for<br /> Ticket # ".$results[0]['Ticket']." Site:".$results[0]['Site'].", due to ETA of ".$results[0]['ETA']."<br> 
	  <p style='background:#000000; color:#FFFFFF; padding:5px;'><b>Current Time is: </b><font color=#FF0000>".$results2[0]['TIMED']. 
	  "</p></font><br><br> $q </div> <br /><img src='/img/clippy.png' />";
  else
      echo "Failed to send message. Please contact <a href='mailto:jmulhern@isi-info.com'>Jim Mulhern</a> to report this.";
?>


</body>
</html>






