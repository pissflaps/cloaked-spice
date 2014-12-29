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
$addys = "Email.txt";
	$fh = file($addys, true) or die("Can't open email file");
	$emails = implode(',', $fh);
	$email = explode(',', $emails);
/*	
	list($allen,$dino,$dan,$jim,$jon,$matt,$shannon,$mike,$victor,$susan,$jimm,$tom,$nasir,$terry) = $email;
				$mail->AddAddress($allen);
				$mail->AddAddress($dino);
				$mail->AddAddress($dan);
				$mail->AddAddress($jim);
				$mail->AddAddress($jon);
				$mail->AddAddress($matt);
				$mail->AddAddress($shannon);
				$mail->AddAddress($mike);
				$mail->AddAddress($victor);
				$mail->AddAddress($susan);
				$mail->AddAddress($jimm);
				$mail->AddAddress($tom);
				$mail->AddAddress($nasir);
				$mail->AddAddress($terry);*/
	$mail->AddAddress($test);		
				
//	$emails is the array storing the submitted  emails from the Alert System main page. 
//	Due to the nature of the SMTP mail library, the function cannot accept an array and must be repeated to accept all available mail recipients.
//   $to="$emails";
//   $from="TAC Alert System <alerts@isi-info.com>";
  $mail->Subject = "TAC Alert: $counted tickets have reached their ETA!";

  $mail->AddEmbeddedImage('img/isi2.gif', 'ISI', 'ISI-photo ');
  
  
  $HTML="<html>  <head>      <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    
        <title>TAC Alert Email</title>
		<style type='text/css'>
			/* Client-specific Styles */
			#outlook a{padding:0;} 
			body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
			body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

			/* Reset Styles */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table td{border-collapse:collapse;}
			#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

			/* Template Styles */

		/**
			* @tab Page
			* @section background color
			* @tip Set the background color for your email. You may want to choose one that matches your company's branding.
			* @theme page
			*/
			body, #backgroundTable{
				 background-color:#f1f7f9;
			}

			/**
			* @tab Page
			* @section email border
			* @tip Set the border for your email.
			*/
			#templateContainer{
				 border: 2px solid #0073ea;
			}

			/**
			* @tab Page
			* @section heading 1
			* @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
			* @style heading 1
			*/
			h1, .h1{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:34px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				 text-align:left;
			}

			/**
			* @tab Page
			* @section heading 2
			* @tip Set the styling for all second-level headings in your emails.
			* @style heading 2
			*/
			h2, .h2{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:30px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				 text-align:left;
			}

			/**
			* @tab Page
			* @section heading 3
			* @tip Set the styling for all third-level headings in your emails.
			* @style heading 3
			*/
			h3, .h3{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:26px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				 text-align:left;
			}

			/**
			* @tab Page
			* @section heading 4
			* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
			* @style heading 4
			*/
			h4, .h4{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:22px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				 text-align:left;
			}
			
			/**
			* @tab Page
			* @section heading 5
			* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
			* @style heading 5
			*/
			h5, .h5{
				 color:#3b5998;
				 font-family:Arial;
				 font-size: 10px;
				 line-height: 80%;
				 text-align:center;
			}
			
				h5 a:link, .h5 a:link, h5 a:active, .h5 a:active{
					color:#ff0084;
					font-weight:normal;
					text-decoration:underline;
				}
			
			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: PREHEADER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Header
			* @section preheader style
			* @tip Set the background color for your email's preheader area.
			* @theme page
			*/
			#templatePreheader{
				 background-color:#DADADA;
			}

			/**
			* @tab Header
			* @section preheader text
			* @tip Set the styling for your email's preheader text. Choose a size and color that is easy to read.
			*/
			.preheaderContent div{
				 color:#888888;
				 font-family:Arial;
				 font-size:10px;
				 line-height:80%;
				 text-align: center;
				 height: 1px;
				 float: right;
			}

			/**
			* @tab Header
			* @section preheader link
			* @tip Set the styling for your email's preheader links. Choose a color that helps them stand out from your text.
			*/
			.preheaderContent div a:link, .preheaderContent div a:visited, /* Yahoo! Mail Override */ .preheaderContent div a .yshortcuts /* Yahoo! Mail Override */{
				 color:#336699;
				 font-weight:normal;
				 text-decoration:underline;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: HEADER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Header
			* @section header style
			* @tip Set the background color and border for your email's header area.
			* @theme header
			*/
			#templateHeader{
				 background-color:#0073ea;
				 border-bottom:0;
			}

			/**
			* @tab Header
			* @section header text
			* @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
			*/
			.headerContent{
				 color:#ffffff;
				 font-family: 'Gentium Book Basic', serif;
				 font-size:100px;
				 font-weight:bold;
				 line-height:100%;
				 padding:0;
				 text-align:center;
				 vertical-align:middle;
				 text-shadow: #444444 0.1em 0.1em 0.5em;
			}

			/**
			* @tab Header
			* @section header link
			* @tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
			*/
			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
				 color:#336699;
				 font-weight:normal;
				 text-decoration:underline;
			}

			#headerImage{
				height:auto;
				max-width:600px !important;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: MAIN BODY /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Body
			* @section body style
			* @tip Set the background color for your email's body area.
			*/
			#templateContainer, .bodyContent{
				 background-color:#eeeeee;
			}

			/**
			* @tab Body
			* @section body text
			* @tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
			* @theme main
			*/
			.bodyContent div{
				 color:#505050;
				 font-family:Arial;
				 font-size:14px;
				 line-height:150%;
				 text-align:left;
			}

			/**
			* @tab Body
			* @section body link
			* @tip Set the styling for your email's main content links. Choose a color that helps them stand out from your text.
			*/
			.bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
				 color:#ff0084;
				 font-weight:normal;
				 text-decoration:underline;
			}
			.bodyContent div a:hover {
				font-weight:bold;
				}

			.bodyContent img{
				display:inline;
				height:auto;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: FOOTER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Footer
			* @section footer style
			* @tip Set the background color and top border for your email's footer area.
			* @theme footer
			*/
			#templateFooter{
				 background-color:#eeeeee;
				 border-top:0;
			}

			/**
			* @tab Footer
			* @section footer text
			* @tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
			* @theme footer
			*/
			.footerContent div{
				 color:#707070;
				 font-family:Arial;
				 font-size:10px;
				 line-height:85%;
				 text-align: center;
			}

			/**
			* @tab Footer
			* @section footer link
			* @tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
			*/
			.footerContent div a:link, .footerContent div a:visited, /* Yahoo! Mail Override */ .footerContent div a .yshortcuts /* Yahoo! Mail Override */{
				 color:#ff0084;
				 font-weight:normal;
				 text-decoration:underline;
			}
			.footerContent div a:hover{
				font-weight:bold;
			}
			
			.footerContent img{
				display:inline;
			}
			
			/**
			* @tab Footer
			* @section social bar style
			* @tip Set the background color and border for your email's footer social bar.
			* @theme footer
			*/
			#social{
				 background-color:#dddddd;
				 border:0;
			}

			/**
			* @tab Footer
			* @section social bar style
			* @tip Set the background color and border for your email's footer social bar.
			*/
			#social div{
				 text-align:center;
			}

			/**
			* @tab Footer
			* @section utility bar style
			* @tip Set the background color and border for your email's footer utility bar.
			* @theme footer
			*/
			#utility{
				 background-color:#eeeeee;
				 border:0;
			}

			/**
			* @tab Footer
			* @section utility bar style
			* @tip Set the background color and border for your email's footer utility bar.
			*/
			#utility div{
				 text-align:center;
			}

			#monkeyRewards img{
				max-width:190px;
			}
			.red{
			color: #ff0000;
			}
		</style>
	</head>
    <body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0'>
    	<center>
        	<table border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='backgroundTable'>
            	<tr>
                	<td align='center' valign='top'>
                        <!-- // Begin Template Preheader \\ --
                        <table border='0' cellpadding='10' cellspacing='0' width='600' id='templatePreheader'>
                            <tr>
                                <td valign='top' class='preheaderContent'>
                                
                                	<!-- // Begin Module: Standard Preheader \ --
                                    <table border='0' cellpadding='10' cellspacing='0' width='100%'>
                                    	<tr>
                                        	<td valign='top'>
                                            	<div mc:edit='std_preheader_content'>
                                              <!-- small header font can go here --
                                                </div>
                                            </td>

											<td valign='top' width='190'>
                                            	<div mc:edit='std_preheader_links'>
			<!--  	Is this email not displaying correctly?<br /><a href='*|ARCHIVE|*' target='_blank'>View it in your browser</a>. --
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                	-- // End Module: Standard Preheader \ -->
                                
                                </td>
                            </tr>
                        </table>
                        <!-- // End Template Preheader \\ -->
                    	<table border='0' cellpadding='0' cellspacing='0' width='600' id='templateContainer'>
                        	<tr>
                            	<td align='center' valign='top'>
                                    <!-- // Begin Template Header \\ -->
                                	<table border='0' cellpadding='0' cellspacing='0' width='600' id='templateHeader'>
                                        <tr>
                                            <td class='headerContent'>
                                            
                                            	<!-- // Begin Module: Standard Header Image \\ -->
                                            	 ALERT!
                                            	<!-- // End Module: Standard Header Image \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Header \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align='center' valign='top'>
                                    <!-- // Begin Template Body \\ -->
                                	<table border='0' cellpadding='0' cellspacing='0' width='600' id='templateBody'>
                                    	<tr>
                                            <td valign='top' class='bodyContent'>
                                
                                                <!-- // Begin Module: Standard Content \\ -->
                                                <table border='0' cellpadding='20' cellspacing='0' width='100%'>
                                                    <tr>
                                                        <td valign='top'>
                                                            <div mc:edit='std_content00'>

                                                                <br>
																<strong class='red'>The following TAC tickets require a customer callback</strong>:
                                                              
                                                                <br />";
										$HTML .=  msg_add($results)."  <br />Please contact the customer(s) and remove these from the open queue. ";
                                                            $HTML .= "</div>
														</td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Content \\ -->
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Body \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align='center' valign='top'>
                                    <!-- // Begin Template Footer \\ -->
                                	<table border='0' cellpadding='10' cellspacing='0' width='600' id='templateFooter'>
                                    	<tr>
                                        	<td valign='top' class='footerContent'>
                                            <center><strong><font color='#0073ea'>$counted</font> tickets</strong> are past their ETA, and <strong><font color='#ff0084'>$ticked</font> total tickets</strong> are awaiting callback.</center>
											<br>
                                                <!-- // Begin Module: Standard Footer \\ -->
                                                <table border='0' cellpadding='10' cellspacing='0' width='100%'>
                                                    <tr>
                                                        <td colspan='2' valign='middle' id='social'>
                                                            <div mc:edit='std_social'>Quick Links: &nbsp;
																&nbsp; <a href='http://tac-alert01/index.php'>TAC's Alert System</a>  &nbsp;|
																&nbsp; <a href='http://thesource.isi-info.com/service/default.aspx'>The Source</a>  &nbsp;|
																&nbsp; <a href='http://tac-wiki/wiki/index.php/'>ISI's Wikibase</a> &nbsp;
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign='top' width='400'>
                                                            <div mc:edit='std_footer'>

																<br />
                                                            </div>
                                                        </td>
                                                        <td valign='top' width='190' id='monkeyRewards'>
                                                            <div mc:edit='monkeyrewards'>
                                                                <!-- nothing here  -->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='2' valign='middle' id='utility'>
                                                            <div mc:edit='std_utility'>
															
													<br />
					<font face='Tahoma' size=4 color=#444444> $q </font>
													<br />
													<br />
			&nbsp;	<img src='cid:ISI' alt='ISI Telemanagement' height='100px' width='83px' border='0'/> 
						</form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Footer \\ -->
                                            <br>
		<h5>Email not displaying correctly? &nbsp;&nbsp; - &nbsp;&nbsp; <a href='http://tac-alert01/HTMaiL.php'>Click here to view it in a Web Page</a>. </h5>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Footer \\ -->
                                </td>
                            </tr>
                        </table>
                        <br>
                    </td>
                </tr>
            </table>
        </center>
    </body>";
	
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