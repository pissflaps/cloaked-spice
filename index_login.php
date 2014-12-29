<?php include("main_login.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
		<title>TAC's NEW Alert System</title>
		
<style>
#email a{
clear:left;
float:right;
text-decoration:none;
color:#0000FF;
}
	#email a :hover {
	color: #FFFFFF;
	background:#0000FF;
	}
	
#title {
background: #7db442 url('tactitle.png') no-repeat;
height:100px;
}

#themes {
clear:both;
float:left;
padding:2px;
}
	#themes a {
	color:#0000FF;
	text-decoration:underline;
	}
		#themes a:hover {
		color:#FFFFFF;
		text-decoration:none;
		background: #0000FF;
		}
#old {
display:inline-block;
clear:both;
float:left;
color: #ffffff;
padding:5px;
z-index:111;
}
	#old a {
	color: #0000FF;
	padding:2px;
	}
	#old :hover {
	background: #0000FF;
	color: #FFFFFF;

	}	
 /* ----------------------------------------------------------------------------------------------------------------*/
/* ---------->>> global settings needed for thickbox <<<-----------------------------------------------------------*/
/* ----------------------------------------------------------------------------------------------------------------*/
*{padding: 0; margin: 0;}

/* ----------------------------------------------------------------------------------------------------------------*/
/* ---------->>> thickbox specific link and font settings <<<------------------------------------------------------*/
/* ----------------------------------------------------------------------------------------------------------------*/
#TB_window {
	font: 12px Arial, Helvetica, sans-serif;
	color: #333333;
}

#TB_secondLine {
	font: 10px Arial, Helvetica, sans-serif;
	color:#666666;
}

#TB_window a:link {color: #666666;}
#TB_window a:visited {color: #666666;}
#TB_window a:hover {color: #000;}
#TB_window a:active {color: #666666;}
#TB_window a:focus{color: #666666;}

/* ----------------------------------------------------------------------------------------------------------------*/
/* ---------->>> thickbox settings <<<-----------------------------------------------------------------------------*/
/* ----------------------------------------------------------------------------------------------------------------*/
#TB_overlay {
	position: fixed;
	z-index:100;
	top: 0px;
	left: 0px;
	height:100%;
	width:100%;
}

.TB_overlayMacFFBGHack {background: url(macFFBgHack.png) repeat;}
.TB_overlayBG {
	background-color:#000;
	filter:alpha(opacity=75);
	-moz-opacity: 0.75;
	opacity: 0.75;
}

* html #TB_overlay { /* ie6 hack */
     position: absolute;
     height: expression(document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + 'px');
}

#TB_window {
	position: fixed;
	background: #ffffff;
	z-index: 102;
	color:#000000;
	display:none;
	border: 4px solid #525252;
	text-align:left;
	top:50%;
	left:50%;
}

* html #TB_window { /* ie6 hack */
position: absolute;
margin-top: expression(0 - parseInt(this.offsetHeight / 2) + (TBWindowMargin = document.documentElement && document.documentElement.scrollTop || document.body.scrollTop) + 'px');
}

#TB_window img#TB_Image {
	display:block;
	margin: 15px 0 0 15px;
	border-right: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	border-top: 1px solid #666;
	border-left: 1px solid #666;
}

#TB_caption{
	height:25px;
	padding:7px 30px 10px 25px;
	float:left;
}

#TB_closeWindow{
	height:25px;
	padding:11px 25px 10px 0;
	float:right;
}

#TB_closeAjaxWindow{
	padding:7px 10px 5px 0;
	margin-bottom:1px;
	text-align:right;
	float:right;
}

#TB_ajaxWindowTitle{
	float:left;
	padding:7px 0 5px 10px;
	margin-bottom:1px;
}

#TB_title{
	background-color:#e8e8e8;
	height:27px;
}

#TB_ajaxContent{
	clear:both;
	padding:2px 15px 15px 15px;
	overflow:auto;
	text-align:left;
	line-height:1.4em;
}

#TB_ajaxContent.TB_modal{
	padding:15px;
}

#TB_ajaxContent p{
	padding:5px 0px 5px 0px;
}

#TB_load{
	position: fixed;
	display:none;
	height:13px;
	width:208px;
	z-index:103;
	top: 50%;
	left: 50%;
	margin: -6px 0 0 -104px; /* -height/2 0 0 -width/2 */
}

* html #TB_load { /* ie6 hack */
position: absolute;
margin-top: expression(0 - parseInt(this.offsetHeight / 2) + (TBWindowMargin = document.documentElement && document.documentElement.scrollTop || document.body.scrollTop) + 'px');
}

#TB_HideSelect{
	z-index:99;
	position:fixed;
	top: 0;
	left: 0;
	background-color:#fff;
	border:none;
	filter:alpha(opacity=0);
	-moz-opacity: 0;
	opacity: 0;
	height:100%;
	width:100%;
}

* html #TB_HideSelect { /* ie6 hack */
     position: absolute;
     height: expression(document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + 'px');
}

#TB_iframeContent{
	clear:both;
	border:none;
	margin-bottom:-1px;
	margin-top:1px;
	_margin-bottom:1px;
}


#talkbubble {
   width: 120px;
   height: 80px; 
   background: #ffffcc;
   color: #000000;
   position: relative;
   -moz-border-radius:    10px; 
   -webkit-border-radius: 10px; 
   border-radius:         10px;
   border: #000000;
}
#talkbubble:before {
   content:"";
   position: absolute;
   right: 100%;
   top: 26px;
   width: 0;
   height: 0;
   border-top: 13px solid transparent;
   border-right: 26px solid #ffffcc;
   border-bottom: 13px solid transparent;
}


	#tabs {
	clear:both;
	float:left;
	position:relative;
	padding: 5px;
	color: #000000;
	}
	
	* a{
	 padding: 2px;
	}
		* a:hover {
		 padding:2px;
		}

	#all_clear {
		padding:20px;
		border:1px solid #000000;
		background:#FFFFCC;
		color:#000000;
		clear:both;
		float:left;
		border-radius: 5px;
		}

	
	/*	
	.tblOclr {
	background: #2d8fbc;
	color: #FFFFFF;
	}
	.tblEclr {
	background: #a2d8f1;
	color: #000000;
	}
	.tblFclr {
	background: #00008B;
	color: #fdfdfd;
	}
	.tblbrdr{
	border-right: 2px solid #000000;
	border-bottom: 2px solid #000000;
	padding: 2px;
	}
	*/

	#kill {
		/* for IE */
		filter:alpha(opacity=55);
		/* CSS3 standard */
		opacity:0.55;
	}
	#kill:hover {
		/* for IE */
		filter:alpha(opacity=100);
		/* CSS3 standard */
		opacity:1.0;
	}
</style>

	<?php require ("requireonce.php"); ?>


	<script>
$(document).ready( function() {

	$(function() {
		$( "#accordion" ).accordion({
			fillSpace: true
		});
	});
	$(function() {
		$( "#accordionResizer" ).resizable({
			minHeight: 450,
			resize: function() {
				$( "#accordion" ).accordion( "resize" );
			}
		});
	});
});
	</script>
	
</head>
<body>

<div id="title">
</div>

 
<div class="demo">
 
<div id="accordionResizer" style="padding:10px; max-width:95%;" class="ui-widget-content">

<div id="accordion">
	<h3><a href="#" id='first'>Ticket Entry</a></h3>
	<div>

		<span id="email" style="background:transparent;">
<a href="emails.html?TB_iframe=true&height=600&width=400&modal=false" title="Email Recipients" class="thickbox"><font face="Wingdings" color='#0000FF' size="7">+</font></a> 
	</span>

<br/> 

<FORM name="Tsubmit" ACTION="sqlinsert.php" METHOD="POST">

<table id="submissionForm" CELLPADDING=1 CELLSPACING=2>
<tr>

<span id='buttonDiv' >
<input type="radio" NAME="priority" id="radio1" VALUE="2" checked onchange="valueChanged()" /><label for="radio1">2</label>
<input type="radio" NAME="priority" id="radio2" VALUE="4" onchange="valueChanged()" /><label for="radio2">4</label>
<input type="radio" NAME="priority" id="radio3" VALUE="9" onchange="valueChanged()" /><label for="radio3">9</label>
</span>
<br>
<INPUT TYPE="text" style="padding:4px;" class="text" NAME="ticket" id="TicketNumber" tabindex="1" MAXLENGTH=6 value="Ticket Number" placeholder="Ticket Number" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required> 
<br>
<INPUT TYPE="text" NAME="siteName" style="padding:4px;" class="text" id="SiteName" MAXLENGTH=45 placeholder="Site Name" value="Site Name" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" tabindex="2" required>
<br>

<TEXTAREA type="text" style="padding:5px;" id="comments" class="comments" NAME="comments" cols=25 rows=4 scrolling="no" VALUE="COMMENTS" tabindex="3" placeholder="Please enter any comments." onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" ></TEXTAREA>
<br>
<Button TYPE="submit" class="ui-button" NAME="Submit" VALUE="Submit"  border="0" ><img src="/icons/package_add.png" border="0" alt=""/> Submit</button>
&nbsp;<Button TYPE="reset" id="reset" class="ui-button" NAME="Reset" VALUE="Reset" border="0" onClick="return f();"><img src="/icons/page_refresh.png" border="0" alt=""/> Reset</button>
</form>

 </table>
	</div>
	<h3><a href="#" id='second'>Open Queue</a></h3>
	<div class='db' id='dbb'>
		<center>
		<?php include("DB.php"); ?>	
		</center>
	</div>
	<h3><a href="#" id='third'>Quick Links</a></h3>
	<div>
<span align="left">
<form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' method='GET' TARGET="_new">
			&nbsp;	<img src="/img/isiicon.gif" alt="ISI's Wikibase" height="25px" width="25px" border="0"/> &nbsp;<input type='hidden' name='title' value='Special:SphinxSearch'>
				<input type="search" id="search" name='sphinxsearch' maxlength='100' TABINDEX="4" placeholder="Wikibase Search" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" style="padding:2px;">
				&nbsp; <button type='submit' name='fulltext' class="ui-button" value='Search' ><img src="/icons/magnifier.png" border="0" alt=""/> Search</button>
						</form>
						<br>
</span>				

<span align="left" id="tabs" >
<a href="http://tac-alert01/tickstats.php" target="_NEW" title="Generate Ticket Statistics"> Ticket Statistics</a> 
<a href="http://tac-alert01/tickadd.php" target="_NEW" title="Tacs Ticket Adder"> Ticket Adder</a> 
<a href="http://tac-alert01/ticketupdate.php" target="_NEW" title="Update tickets on the fly!"> TAC's Ticket Updater</a> 
<img src="../icons/chart_organisation.png" /> <a href="http://thesource.isi-info.com/service/default.aspx" class="external" title="The Source" target="_new">The Source</a>
<img src="../icons/isicon.gif" /> <a href="http://tac-wiki/wiki/index.php" title="The ISI Wikibase" class="external" target="_new">Wikibase</a> 
</span>
<br/>
<span style='clear:both;float:left;'>
<?php include( "rotor.php" ); ?>
</span>
	</div>
	<h3><a href="#" id='fourth'>Random Quote</a></h3>
	<div>
		<?php
		
		$r= rand (1,10);
		$qq = rand (1,100);

	$say = "Quotes.txt";
	$quotes = file($say, true) or die("Can't open Quotes file.");
	$data = file_get_contents("Quotes.txt"); //read the file
	$convert = explode("\n", $data); //create array separate by new line
		
	
for ($i=0;$i<count($convert);$i++) 
{
    $q = $convert[$qq].' '; //write value by index
}

echo $q;
?>
<br>
 <span id="talkbubble" style="position:relative;top:50%;height:50px;width:200px;padding:10px;float:right;padding-right:0px;">
<?php echo "This page has been viewed " . $_SESSION['counter'] . " times"; ?>
</span>
	</div>
</div>

<span class="ui-icon ui-icon-grip-dotted-horizontal" style="margin:2px auto;"></span>
</div><!-- End accordionResizer -->



</div>

<br>
<div id='themes'> 
<a href="#" rel="css/blitzer/jquery-blitzer.css" id="default">Default Theme</a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"  rel="css/swanky-purse/jquery-swankypurse.css" id="swanky">Swanky</a> &nbsp;&nbsp;|&nbsp;&nbsp;
 <a href="#" rel="css/excite-bike/jquery-excitebike.css" id="excite">Excite Bike</a> &nbsp;&nbsp;|&nbsp;&nbsp; 
<a href="#" rel="css/sunny/jquery-sunny.css" id="sunny">Sunny</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" rel="css/dark-hive/jquery-darkhive.css" id="dark">Dark Hive</a> &nbsp;&nbsp;|&nbsp;&nbsp;
 <a href="#" rel="css/pepper-grinder/jquery-peppergrinder.css" id="pepper">Pepper Grinder</a>
 &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" rel="css/dot-luv/jquery-dotluv.css" id="dotluv">Dot Luv</a> &nbsp;&nbsp;|&nbsp;&nbsp;
 <a href="#" rel="css/trontastic/jquery-trontastic.css" id="trontastic">Tron-Tastic</a>
  </div>
  <br/>
<button name="killtheme" id="kill" value="" style="float:right">Remove Theme</button>

<br>
<div id="old"><a href="http://tac-alert01/index_old.php">Use the old Alert System</a>
 </div>


</body>
</html>
