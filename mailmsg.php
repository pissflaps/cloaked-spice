<html lang="en">
<head>
<?php 

ini_set("SMTP","smtp.isi-info.com");
ini_set("smtp_port","25");

$con = mysql_connect("localhost","root","");
	if (!$con)  {
		die('Could not connect: ' . mysql_error()); 
	}
		mysql_select_db("dbase", $con);
																// Deleted != 'X' AND                AND Priority > 2
		$sql = mysql_query("SELECT * FROM `tickets` WHERE Deleted != 'X' AND Date <= DATE_FORMAT(DATE(NOW()),'%c/%e/%Y') AND ETA < TIME(NOW())");		
		$timer = mysql_query("SELECT DATE_FORMAT(DATE(NOW()),'%c/%e/%Y') AS DATED, TIME(NOW()) AS TIMED"); 
$Tdate = date('Y-m-d');
$DATE = date('n/j/Y');
	
	$counting = mysql_query("SELECT COUNT(*) FROM tickets WHERE Deleted !='X' AND Date <= DATE_FORMAT(DATE(NOW()),'%c/%e/%Y') AND ETA < TIME(NOW())");		
		$count = mysql_fetch_assoc($counting, MYSQL_BOTH);
		$counted = $count[0];
	
	$tick = mysql_query("SELECT COUNT(*) FROM tickets WHERE Deleted !='X'");
		$ticke = mysql_fetch_assoc($tick, MYSQL_BOTH);
		$ticked = $ticke[0];		
		
$Img1 = "images/widget-hero1.png";
$Alt1 = "TAC's Alert System";
$Url1 = "http://tac-alert01/index.php";
	
$Img2 = "images/widget-hero2.png";
$Alt2 = "TAC's Alert System";
$Url2 = "http://tac-alert01/index.php";

$Img3 = "images/widget-hero3.png";
$Alt3 = "TAC's Alert System";
$Url3 = "http://tac-alert01/index.php";

$Img4 = "images/widget-hero4.png";
$Alt4 = "TAC's Alert System";
$Url4 = "http://tac-alert01/index.php";


$num = rand (1,4);

$Image = ${'Img'.$num};
$Alt = ${'Alt' .$num};
$URL = ${'Url'.$num};
		
?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>TAC Alert Email</title>
	<style>
	a:hover {
		text-decoration: underline !important;
	}
	td.promocell p { 
		color:#e1d8c1;
		font-size:16px;
		line-height:26px;
		font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
		margin-top:0;
		margin-bottom:0;
		padding-top:0;
		padding-bottom:14px;
		font-weight:normal;
	}
	td.contentblock h4 {
		color:#444444 !important;
		font-size:16px;
		line-height:24px;
		font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
		margin-top:0;
		margin-bottom:10px;
		padding-top:0;
		padding-bottom:0;
		font-weight:normal;
	}
	td.contentblock h4 a {
		color:#444444;
		text-decoration:none;
	}
	td.contentblock p { 
	  	color:#888888;
		font-size:13px;
		line-height:19px;
		font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
		margin-top:0;
		margin-bottom:12px;
		padding-top:0;
		padding-bottom:0;
		font-weight:normal;
	}
	td.contentblock p a { 
	  	color:#3ca7dd;
		text-decoration:none;
	}
	@media only screen and (max-device-width: 480px) {
	     div[class="header"] {
	          font-size: 16px !important;
	     }
	     table[class="table"], td[class="cell"] {
	          width: 300px !important;
	     }
		table[class="promotable"], td[class="promocell"] {
	          width: 325px !important;
	     }
		td[class="footershow"] {
	          width: 300px !important;
	     }
		table[class="hide"], img[class="hide"], td[class="hide"] {
	          display: none !important;
	     }
	     img[class="divider"] {
		      height: 1px !important;
		 }
		 td[class="logocell"] {
			padding-top: 15px !important; 
			padding-left: 15px !important;
			width: 300px !important;
		 }
	     img[id="screenshot"] {
	          width: 325px !important;
	          height: 127px !important;
	     }
		img[class="galleryimage"] {
			  width: 53px !important;
	          height: 53px !important;
		}
		p[class="reminder"] {
			font-size: 11px !important;
		}
		h4[class="secondary"] {
			line-height: 22px !important;
			margin-bottom: 15px !important;
			font-size: 18px !important;
		}
	}
	</style>
</head>
<body bgcolor="#e4e4e4" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="-webkit-font-smoothing: antialiased;width:100% !important;background:#e4e4e4;-webkit-text-size-adjust:none;">
	
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#e4e4e4">
<tr>
	<td bgcolor="#e4e4e4" width="100%">

	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="table">
	<tr>
		<td width="600" class="cell">
		
		<?php echo "<img src=".$Image." border='0' label='Hero image' editable='true' width='600' height='253' id='screenshot' />"; ?>
	
		<table width="600" cellpadding="25" cellspacing="0" border="0" class="promotable">
		<tr>
			<td bgcolor="#456265" width="600" class="promocell">                      
			 
				<multiline label="Main feature intro"><p>
				<?php

									function mysql_get_rowsarr($result, $numass=MYSQL_BOTH) {
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
							
			$results = mysql_get_rowsarr($sql);
				
		if (!$timer) {
			die('Could not query timer:' . mysql_error());
			}
		$results2 = mysql_get_rowsarr($timer);
		
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

				$test = "jmulhern@isi-info.com";

				$to="$test";
   				$from="TAC Alert System <alert@isi-info.com>";
				$subject="TAC Alert: $counted tickets have reached their ETA!";
				
				echo "The following tickets have reached their ETA:<br>".
   "Ticket #<b>".$results[0]['Ticket']."</b> for <b>".$results[0]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[0]['ETA'].
   "</font></b> from ".$results[0]['Date'];
		if (isset($results[1])){
   echo "<br><br />Ticket #<b>".$results[1]['Ticket']."</b> for <b>".$results[1]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[1]['ETA'].
   "</font></b> from ".$results[1]['Date'];
		}
		if (isset($results[2])){
   echo "<br><br />Ticket #<b>".$results[2]['Ticket']."</b> for <b>".$results[2]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[2]['ETA'].
   "</font></b> from ".$results[2]['Date'];
		}
		if (isset($results[3])){
   echo "<br><br />Ticket #<b>".$results[3]['Ticket']."</b> for <b>".$results[3]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[3]['ETA'].
   "</font></b> from ".$results[3]['Date'];
		}
		if (isset($results[4])){
   echo "<br><br />Ticket #<b>".$results[4]['Ticket']."</b> for <b>".$results[4]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[4]['ETA'].
   "</font></b> from ".$results[4]['Date'];
		}
		if (isset($results[5])){
   echo "<br><br />Ticket #<b>".$results[5]['Ticket']."</b> for <b>".$results[5]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[5]['ETA'].
   "</font></b> from ".$results[5]['Date'];
		}
		if (isset($results[6])){
   echo "<br><br />Ticket #<b>".$results[6]['Ticket']."</b> for <b>".$results[6]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[6]['ETA'].
   "</font></b> from ".$results[6]['Date'];
		}
		if (isset($results[7])){
   echo "<br><br />Ticket #<b>".$results[7]['Ticket']."</b> for <b>".$results[7]['Site']."</b> has an ETA of <b><font color=#ff0000>".$results[7]['ETA'].
   "</font></b> from ".$results[7]['Date'];
		}
   echo "<br><br /><span style='background:#000000;color:#FFFFFF;padding:10px;display:inline;'> There are $ticked tickets total in the open queue awaiting callback.</span>";	
		// echo "<br> <br /><span style='background:#FFFFCC; display:block;color:#000000; padding:5px;'><b>Current Time is: </b> ".$results2[0]['TIMED']."</span>
   echo "<br><br /> Please contact the customer(s) and remove these from the open queue.";
 
	?>
   </p></multiline>
			
			</td>
		</tr>
		</table>
	

	
		<repeater>
			<layout label="New feature">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="100%" bgcolor="#ffffff">
					<table width="100%" cellpadding="20" cellspacing="0" border="0">
					<tr>
						<td bgcolor="#ffffff" class="contentblock">
							<?php
								echo "<br><h3>Thank you, <br> <sub><a href='http://tac-alert01/index.php'>TAC's Alert System</a></sub> </h3>";
								echo  "</center>"
							?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>  
			<br>
			</layout>
			<layout label="Pull quote">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td bgcolor="#85bdad" nowrap><img border="0" src="images/spacer.gif" width="5" height="1"></td>
							<td width="100%" bgcolor="#ffffff">
						
								<table width="100%" cellpadding="20" cellspacing="0" border="0">
								<tr>
									<td bgcolor="#ffffff" class="contentblock">
			
										<h4 class="secondary"><strong><singleline label="Pull quote">
										<?php
										echo "<br> $q </div>";
										?>
										</singleline></strong></h4>
			
									</td>
								</tr>
								</table>
						
							</td>
						</tr>
						</table>  
			<br>
						</layout>
		</repeater>           
		
		</td>
	</tr>
	</table>
	<img border="0" src="images/spacer.gif" width="1" height="25" class="divider">

	</td>
</tr>
</table>  	   			     	 

</body>
</html>



