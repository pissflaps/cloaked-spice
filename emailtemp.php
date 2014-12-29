<?php

$HTML = "
<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><title>TAC Alert Email</title><style>
	a, a:active { color:#ff0084; text-decoration: underline !important; }
	a:hover { color: #ff0084;	text-decoration: bold !important;	}
	td.promocell p { color:#e1d8c1;	font-size:16px;	line-height:26px;	font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;	margin-top:0;	margin-bottom:0;	padding-top:0;	padding-bottom:14px;	font-weight:normal;}
	td.contentblock h4 {color:#ffffff !important;font-size:16px;line-height:24px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;margin-top:0;margin-bottom:10px;padding-top:0;padding-bottom:0;		font-weight:normal;	}
	td.contentblock h4 a {color:#ffffff;text-decoration:none;	}
	td.contentblock p { color:#888888;font-size:14px;line-height:19px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;margin-top:0;margin-bottom:12px;padding-top:0;padding-bottom:0;font-weight:normal;	}
	td.contentblock p a { color:#3ca7dd;text-decoration:none;}
	td { border-radius:5px; }
	body {width:700px;}
@media only screen and (max-device-width: 480px) {
		div[class='header'] {font-size: 16px !important;    }
	     table[class='table'], td[class='cell'] {width: 300px !important;   }
		table[class='promotable'], td[class='promocell'] { width: 325px !important;    }
		td[class='footershow'] {width: 300px !important;  }
		table[class='hide'], img[class='hide'], td[class='hide'] {display: none !important;   }
	     img[class='divider'] {height: 1px !important; }
		 td[class='logocell'] {padding-top: 15px !important; padding-left: 15px !important;	width: 300px !important; }
	     img[id='screenshot'] {width: 325px !important; height: 127px !important;   }
		img[class='galleryimage'] {width: 53px !important;height: 53px !important;}
		p[class='reminder'] {font-size: 11px !important;}
		h4[class='secondary'] {line-height: 22px !important;margin-bottom: 15px !important;	font-size: 18px !important;	}
}</style></head><body bgcolor='#ffffff' topmargin='0' leftmargin='0' marginheight='0' marginwidth='0' style='-webkit-font-smoothing: antialiased;width:100% !important;background:#ffffff;-webkit-text-size-adjust:none;'>".
"<table width='100%' cellpadding='0' cellspacing='0' border='0' bgcolor='#0073ea'><tr><td bgcolor='#0073ea' width='100%'><center><font face='arial black' size='6' color='FFFFFF'>Alert!</font></center><table width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='table'>".
"<table width='600' cellpadding='25' cellspacing='0' border='0' class='promotable' bgcolor='#0073ea'>".
"<tr><td bgcolor='#dddddd' width='650' class='promocell'><multiline label='Main feature intro'><p>".
"<div style='display:block;padding:15px;background:transparent; color:#ffffff;'><font size=4>The following tickets have reached their ETA: <br><font color=#888888><b><ul>";

	$HTML .=  msg_add($results)." ";

$HTML .= "</b></font></ul></div><font color=#FFFFFF> Please contact the customer(s) and remove these from the open queue.</font></p>".
		 "</multiline></td></tr></table><repeater><layout label='New feature'><table width='100%' cellpadding='0' cellspacing='0' border='0'>
			<tr><td width='100%' bgcolor='#dddddd'><table width='100%' cellpadding='20' cellspacing='0' border='0'>
					<tr><td bgcolor='#dddddd' class='contentblock'>
		<p style='background:transparent; color:#FFFFFF; padding:15px;'><br> $counted tickets have reached their ETA, from a total of $ticked stil awaiting a callback. <br/> <b>Current Time is: </b><font color=#ff0084>".$results2[0]['TIMED']. 
	  "</p></font><br><font color=#708090><h3>Thank you, <br> </font><a href='http://tac-alert01/index.php'>TAC's Alert System</a></h3>	</td></tr></table></td></tr></table>  
		</layout>
			<br><layout label='Pull quote'>
<table width='100%' cellpadding='0' cellspacing='0' border='0'><tr>
<td bgcolor='#000000' nowrap><img border='0' src='images/spacer.gif' width='5' height='1'></td>
<td width='100%' bgcolor='#dddddd'><table width='100%' cellpadding='20' cellspacing='0' border='0'>
<tr><td bgcolor='#dddddd' class='contentblock'><h4 class='secondary'><strong><singleline label='Pull quote'>
<font face='Tahoma' size=4 color=#000000>".$q."</font> </div></singleline></strong></h4></td></tr></table></td></tr></table><br></layout></repeater></td></tr></table>".
"<img border='0' src='images/spacer.gif' width='1' height='25' class='divider'></td></tr></table></body></html>";
	
	?>