<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="en">
<head>
<title>TAC's Tabbed Alert System</title>

<!-- This page has been well documented for the uninitiated editor.
The HTML layout leaves much to be desired, but the integrity of the design works with all browsers except IE7 and below.
The PHP pages are cobbled with many of the same functions, the DB is an entire HTML page with PHP used to connect to the MySQL database.
The jQuery is mostly separated by folder, so all scripts should be contained where necessary. The PHP scripts are in the root, however.
-->
	
<?php require( "session.php"); ?>
<?php require( "database.php"); ?>

<base href="http://tac-alert01/">
<link rel="stylesheet" href="css/RESET.css">
	<script src="jQuery/jquery-1.8.0.js"></script>
		<script src="jquery/jquery-ui-1.8.23.min.js"></script>
	<link rel="shortcut icon" href="http://tac-alert01/img/bookmark.ico" type="image/x-icon" />
		<script type="text/javascript" src="js/thickbox.js"></script>
		<script type="text/javascript" src="js/jquery.form.js"></script> 
  		<script type="text/javascript" src="js/jquery.cookie.js"></script>
  		<script type="text/javascript" src="jquery/jq-RBC.js"></script>
  		<script type="text/javascript" src="js/spin.min.js"></script>

			
<style>
				body {
	    -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: none;
		}

	#TICK{
			background: rgba(0,0,0, 0.3);
			position: absolute;
			top: 2em;
			left: 10px;
			color: #ffffff;
			padding: 0.75em;
			border-radius: 4px;
			z-index: 999;
			display:inline-block;
		}
			#Cnotice{
				font-size: 0.75em;
				display: block;
				margin-left: 5px;
				padding: 5px;
				background: rgba(250, 50, 50, 0.3);
				color: #ff0000;
				border-radius: 2px;
				float: right;
				vertical-align:top;
				cursor: pointer;
				}
				
	#delTable {
font-size: 0.9em;
text-align: center;
}
	
#submissionForm{
vertical-align: top;
float:left;
}

#tabs { min-height: 50%; width: 95%; margin: 10px auto; } 
	.tabs-bottom { position: relative; } 
	.tabs-bottom .ui-tabs-panel { min-height: 350px; } 
	.tabs-bottom .ui-tabs-nav { position: absolute !important; left: 0; bottom: 0; right:0; padding: 0 0.2em 0.2em 0;} 
	.tabs-bottom .ui-tabs-nav li { margin-top: -2px !important; margin-bottom: 1px !important; border-top: none; border-bottom-width: 1px; left: 30%; }
	.ui-tabs-selected { margin-top: -3px !important; }
	
		
	#all_clear {
		padding: 20px;
		border:1px solid #212121;
		font-family: Courier, Times New Roman, sans-serif;
		background: rgba(200, 150, 190, 0.5);
		color:#212121;
		clear:both;
		float:left;
		border-radius: 2px;
		}
			
		#qy {
		position: fixed;
		bottom: 15px;
		left: 35%;
		text-align: center;
		margin: 50px 0px;
		}
		
		#query {
		position: fixed;
		bottom: 4px;
		display: inline;
		background: transparent url("img/icon_W1.gif") no-repeat;
		opacity: 0.25;
		padding: 10px;
		text-align: left;
		margin:0px auto;
		vertical-align: bottom;
		}
			#query:hover {
			opacity: 0.75;
			background: transparent url("img/icon_W2.gif") no-repeat;
			cursor: pointer;
			}

			#wrap {
			z-index: 999;
			}

	#loginout {
		position: relative;
		top: 0px;
		background: transparent;
		text-align: center;
		display: block;
		padding-bottom: 4px;
		padding-top: 0px;
		min-width: 100%;
		line-height: 1.2em;
		text-shadow: black 0.1em 0.1em 0.25em;
		}
		
		#loginout a {
		 color: #f5fffa;
		 text-decoration: none;
		 font-weight: heavy;
		 padding: 2px;
		 }
		 #loginout a:hover {
		 color: #FFFFFF;
		 padding: 2px;
		 text-decoration: bold;
		 font-weight: heavy;
		 border: none;
		 background: transparent;
		}
			#NotLogged{
				background: rgba(220, 20, 60, 0.5); 
				border-radius:4px;
				padding:4px;
			}
			#LoggedIn{
				background: rgba(50, 205, 50, 0.5); 
				border-radius:4px;
				padding:4px;
			}
			
		#out {
		font-size: 75%;
		}
		#outlog{
		background: rgba(220, 20, 60, 0.5); 
		color: #FFFFFF;
		padding: 5px;
		border: 1px solid transparent;
		border-radius: 4px;
		float: left;
		line-height: 0.8em;
		}
		#outlog a{
		color: #ffffff;
		}
		#outlog a:hover{
		color: #eeffcc;
		}
		#outlog:hover {
		background: rgba(200, 0, 0, 0.8); 
		border: 1px dashed #ffffff;
		}
		#RegUser {
		position: absolute;
		top:1px;
		right:2px;
		padding:6px;
		background: rgba(255, 52, 180, 0.8); 
		color:#cccccc;
		border-radius:4px;
		line-height:0.9em;
		}
		
#RegUser:hover { background: rgba(15, 150, 225, 0.6);  }		
#RegUser a{ color:#eeeeee; } #RegUser a:hover{ color: #F5FFFA; }

		#close {
			font-family: "Arial Black";
			font-size: 0.9em;
			background: rgba(25, 100, 250, 0.5); 
			color: #f1f2f7;
			padding: 5px;
			border-radius: 4px;
			float: right;
			border: 1px solid #444444;
			line-height: .75em;
			}
			
			#close:hover {
					background: rgba(176, 23, 31, 0.8); 
					padding: 5px;
					font-weight: heavy;
					border:1px solid #888888;
					cursor: pointer;
					}
					
			#lid p {
			font-size: 0.75em;
			background: rgba(100, 175, 220, 0.5); 
			color: #f1f2f7;
			padding: 5px;
			border-radius: 4px;
			float: right;
			border: 1px solid #bbbbbb;
			line-height: 0.85em;
			text-shadow: #444444 0.1em 0.1em 0.2em;
			cursor:pointer;
			z-index: 99;
			}
				#lid p:hover {
				background: rgba(150, 220, 130, 0.8); 
				color: #ffffff;
				border: 1px solid #eeeeee;
				}
				
				#lid p:before {
				display: block;
				}
				
				.db {
					margin: 10px auto;
					overflow: auto;
					}
						#dbb:after {
							display: block;
							height: 0;
							clear: both;
							visibility: hidden;
						}
						#tabs-2 {
							padding-bottom: 2em;
							overflow: auto;
						}

	#tab2 {		/*Tab2 is for the HotLinks segment */
	clear:both;
	float:left;
	position:relative;
	padding: 5px;
	color: #000000;
	}						
		.shadow {
				-moz-box-shadow:    6px 5px 4px 3px #ccc;
				-webkit-box-shadow: 6px 5px 4px 3px #ccc;
				 box-shadow:         6px 5px 4px 3px #ccc;
			 }
			 .Tshadow{
				color: #FFA007;
				font-weight: bold;
				text-shadow: #444444 0.1em 0.1em 0.2em;
			}
 		
		#out, #in {
			background: rgba(0, 0, 0, 0.5); 
			color: #f5fffa;
			padding: 8px;
		}

#growl {
position: absolute;
top:0;
left:0;
width:350px;
z-index: 999;
color: #ffffff;
padding: 2px;
display:inline-block;
border-radius: 4px;
}
	.notice {
		position: relative;
	}
	
	.skin {
		position: absolute;
		background: rgba(0, 0, 0, 0.5); 
		bottom: 0;
		left: 0;
		right: 0;
		top: 0;
		z-index: -1;
		border-radius: 4px;
	}
	.content{
		display:block;
		padding: 15px;
		margin-left: 5px;
		font-weight: bold;
	}
	
	.Gclose {
		vertical-align: top;
		float:right;
	}	


#talkbubble {
   width: 120px;
   height: 80px; 
   background: #ffffcc;
   color: #000000;
   position: relative;
   -moz-border-radius:    8px; 
   -webkit-border-radius: 8px; 
   border-radius:         8px;
   border: #000000;
   padding: 2px;
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


	#rotor a:hover{
		background: transparent;
		border: none;
	}
	
		#delTable tr:not(:first-child) td {
		border-radius: 2px;
		border: none;
		}
		#allgone p{
		position: absolute;
		left: 35%;
		text-align:center;
		}
		

/*** Input field styling from Bootstrap **/
 input, textarea {
  -webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
  -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
  -ms-transition: border linear 0.2s, box-shadow linear 0.2s;
  -o-transition: border linear 0.2s, box-shadow linear 0.2s;
  transition: border linear 0.2s, box-shadow linear 0.2s;
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}
input:focus, textarea:focus {
  outline: 0;
  border-color: rgba(82, 168, 236, 0.8);
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(82, 168, 236, 0.6);
  -moz-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(82, 168, 236, 0.6);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(82, 168, 236, 0.6);
}
input[type=file]:focus, input[type=checkbox]:focus, select:focus {
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  outline: 1px dotted #666;
}

input[type="text"],
input[type="password"],
.ui-autocomplete-input,
textarea,
.uneditable-input {
  display: inline-block;
  padding: 4px;
  font-size: 1em;
  line-height: 18px;
  color: #808080;
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
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

* html #TB_overlay { 
	/* ie6 hack */
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


</style>

<?php
	 require ("requiretwice.php"); 
	?>		

</head>
<body>

<!-- The Status bar rolls down when a user removes a ticket. It indicates the ticket [number] was removed successfully, then rolls back up before the page reloads.
Below that is the title image, replaced with each CSS theme, the default for the Tabs layout uses the Fbook theme. The Accordion theme uses the Flickr theme as default.
The 'title' div holds the ticket removal status. as well as the title image and the login status of the user. -->

<div id="title">
<div id="growl"></div>
<div id="titleimg">
</div>

	<div id='loginout'>
	<?php include("loginout.php"); ?>
</div>
</div>

<div class="demo" >
 
<div id="tabs" class="tabs-bottom">
<ul>
<li><a href="#tabs-1">Ticket Entry</a></li>
<li><a href="#tabs-2">Database</a></li>
<li><a href="#tabs-3">Quick Links</a></li>
<li><a href="#tabs-4">Random Quote</a></li>
</ul>

<div id='tabs-1'>

<span id="email" style="background:transparent;">
<a href="emails.html?TB_iframe=true&height=600&width=400&modal=false" title="Email Recipients" class="thickbox">
	<img src="img/emailicon.png" title="Email Recipients"  /></a> 
	</span>

	<!-- 	This is the Form required for submitting tickets.
			This form uses PHP PDO to insert a record in the database using MySQL.
		The first input is a button set, used for selecting a priority on the ticket.
	The second input is a text input box, which allows 6 total characters, and upon keypress, it will remove any non-numerical 
characters from the input box. 
	The third input is the Site Name, which allows up to 45 characters, including numbers and apostrophes.
		The final input is for comments regarding the problem, which has no character limit, but will stretch the entire DB table if more than 150 characters are entered. 	-->

<FORM name="Tsubmit"  id="submissionForm" ACTION="pdo_insert.php" METHOD="POST">
<span id='buttonDiv' >
<input type="radio" NAME="priority" id="radio1" VALUE="2" checked onchange="valueChanged()" /><label for="radio1">2</label>
<input type="radio" NAME="priority" id="radio2" VALUE="4" onchange="valueChanged()" /><label for="radio2">4</label>
<input type="radio" NAME="priority" id="radio3" VALUE="9" onchange="valueChanged()" /><label for="radio3">9</label>
</span>
<br>
<INPUT TYPE="text"  class="text" NAME="ticket" id="TicketNumber" tabindex="1" MAXLENGTH=6 value="Ticket Number" placeholder="Ticket Number" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required> 
<br>
<INPUT TYPE="text" NAME="siteName" class="text" id="SiteName" MAXLENGTH=45 placeholder="Site Name" value="Site Name" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" tabindex="2" required>
<br>

<TEXTAREA type="text" id="comments" class="comments" NAME="comments" cols=25 rows=4 scrolling="no" VALUE="COMMENTS" tabindex="3" placeholder="Please enter any comments." onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" ></TEXTAREA>
<br>
<Button TYPE="submit" NAME="Submit" VALUE="Submit" ><img src="/icons/package_add.png" title="Submit!" /> Submit</button>
&nbsp;<Button TYPE="reset" id="reset" NAME="Reset" VALUE="Reset" onClick="return f();"><img src="/icons/page_refresh.png" title="Reset page" /> Reset</button>
</form>
<!-- The button is tied to an AJAX query, so the page automatically serializes the form data, spits it into a PHP page that submits it into the MySQL database
then the page reloads to complete the process, putting the user back at the second tab, the Database. -->

	</div> <!-- End Tabs-1 -->
	<div id="tabs-2" >

<span class='db' id='dbb' >
<?php include('db.php'); ?>
<br>
</span>

</div>	<!-- End Tabs-2 -->

	<div id="tabs-3">

	</div> <!-- End Tabs-3 -->
	<div id="tabs-4">
		<p>	<span id="quoteme"> 
				</span>
		</p>
<!--	## Excluded due to php doubling the counter when including session.php in the loginout.php file. ##		
		<span id="talkbubble" style="height:65px;width:200px;padding:2px;float:right;"><center>
<?php
				/*		
					echo ucwords($user).", you have refreshed this page " . $_SESSION['counter'] . " times today."; 
				*/
?> 
</font></center></span> 	-->
	</div> <!-- End Tabs-4 -->
	
</div> <!-- End Div #Tabs -->
	
<br>

<!-- These are the links for all themes. As mentioned in other scripts, this allows jQuery to set the CSS on the Alert System, independent of which layout is in use.
These *WILL* carry over between layouts, and some may not be available in the other layout. Some are commented out because they look horrendous and should be replaced by 
better custom themes in the future. 
* * * 
ANY links still commented out in the TABS layout will need work, whether that means designing the title image, or getting the links to look right
so please consider that before outright removing the commented-out links for other themes.

-->
</div> <!-- End Div #Demo -->
<br>
<div id='themes'><b>Themes:</b>&nbsp;&nbsp;

  <a href="#"  rel="css/Bootstrap/jquery-Bootstrap.css" id="Bootstrap">BootStrap</a>&nbsp;&nbsp;|&nbsp;&nbsp;
  <a href="#" rel="css/flick/jquery-flick.css" id="flick">Flickr</a>&nbsp;&nbsp;|&nbsp;&nbsp;
						<!--	<a href="#" rel="css/Hween/jquery-Hween.css" id="Hween">Halloween</a>&nbsp;&nbsp;|&nbsp;&nbsp;	-->
 <!-- <a href="#" rel="css/MonoChrome/jquery-MonoChrome.css" id="MonoChrome">Mono</a> &nbsp;&nbsp;|&nbsp;&nbsp;  -->
 <!--<a href="#" rel="css/eggplant/jquery-eggplant.css" id="eggplant">Eggplant</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
 <!-- <a href="#" rel="css/excite-bike/jquery-excitebike.css" id="excite">ExciteBike</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
 <!-- <a href="#" rel="css/dot-luv/jquery-dotluv.css" id="dotluv">Dot Luv</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
  <a href="#" rel="css/sunny/jquery-sunny.css" id="sunny">Sunny</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
 <!-- <a href="#"  rel="css/hot-sneaks/jquery-HotSneaks.css" id="HotSneaks">Hot Sneaks</a>&nbsp;&nbsp;|&nbsp;&nbsp;  -->
 <!-- <a href="#" rel="css/dark-hive/jquery-darkhive.css" id="dark">Dark Hive</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
  <a href="#" rel="css/pepper-grinder/jquery-peppergrinder.css" id="pepper">Pepper Grinder</a>&nbsp;&nbsp;|&nbsp;&nbsp;
 <!-- <a href="#" rel="css/trontastic/jquery-trontastic.css" id="trontastic">Tron-Tastic</a> &nbsp;&nbsp;|&nbsp;&nbsp; -->
 <!-- <a href="#" rel="css/gator/jquery-gator.css" id="gator">Gator</a> &nbsp;&nbsp;|&nbsp;&nbsp; -->
 <!-- <a href="#" rel="css/Wheatfield/jquery-wheatfield.css" id="wheatfield">Wheat Field</a> &nbsp;&nbsp;|&nbsp;&nbsp; -->
 <!-- <a href="#" rel="css/bluspace/jquery-bluspace.css" id="bluspace">Blu Space</a> &nbsp;&nbsp;|&nbsp;&nbsp; --> 
 <!-- <a href="#"  rel="css/swanky-purse/jquery-swankypurse.css" id="swanky">Swanky</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
  <a href="#"  rel="css/HDE/jquery-HDE.css" id="HDE">Hotdog Stand</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
 <!--  <a href="#"  rel="css/oranj/jquery-oranj.css" id="oranj">Oranj</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
 <!-- <a href="#" rel="css/le-frog/jquery-lefrog.css" id="lefrog">Le-Frog</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
  <a href="#" rel="css/fbook/jquery-fbook.css" id="fbook">f-book</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
  <a href="#"  rel="css/ICS/jquery-ICS.css" id="ICS">Ice Cream Sammy</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
  <a href="#"  rel="css/south-street/jquery-southstreet.css" id="Southstreet">South Street</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
  <a href="#"  rel="css/RainyDay/jquery-RainyDay.css" id="RainyDay">Rainy Day</a>&nbsp;&nbsp;|&nbsp;&nbsp;  
  <a href="#" rel="css/vader/jquery-vader.css" id="vader">Vader</a>
 </div>
  <br/>
<button name="killtheme" id="kill" value="" style="float:right">Remove Theme</button>

<br>

<div id="old">
&nbsp; &bull; <a href="http://tac-alert01/index_a.php">Revert to the old Alert System</a> <br>
 </div>
<!-- <span id="tad"><small>&nbsp; &bull; <a href="http://tac-alert01/index_accordion.php" id="accord">Use the <i>Accordion</i> Alert System</a> </small></span> -->
 <script>
 /* 
	*** COOKIES ***
  These cookies determine whether a user will operate the 'Accordion' or 'Tabs' layout of the Alert System.
  Each is activated by a hyperlink at the bottom-left of the page. Clicking the Accordion layout sets a cookie that will force the page to use
  'index.php' as default. When clicking to use the Tabs layout, the Accordion cookie is destroyed and a cookie is set force 
  the page to use 'index_tabs.php' as default.
  
   * The Swap() function allows the cookies to change hands, effectively replacing one cookie for another when the page loads. It will cause the user to force-load the layout chosen. 
		If the user types http://tac-alert01/index.php and the Tabs cookieis is active, the page will automatically redirect to the index_tabs.php layout. 
		The only way to remove this cookie is to choose the other layout. 
	* The swap() function is reversed in the index.php file, and therefore CAN be modified here but it is not recommended.
 

		if($.cookie("accordion")) {
			window.location = 'http://tac-alert01/index_accordion.php';
		}		
		
		
function swap() {
window.location = 'http://tac-alert01/index_accordion.php';	
};

		$(document).ready(function () {
			   
      
	var accord = $.cookie('accordion');

		$('a#accord ').live('click', function(){
		$.cookie('tabs', null);
			$.cookie('accordion', 'accord', { expires: 365, path: '/' });
	swap();
			});
			
});
*/
		
if($.cookie("logbar"))  {
						$('#wrap').slideUp(1, function(){
						var $USER = "<?php echo $user ?>";
						var $LoggedIn = "<p><img src='icons/user.png' border='0'/> <b>"+ $USER +"</b> is logged in.</p>";
					$('#lid').append($LoggedIn).show("bounce", {"times": 5}, 'slow');
					});
				}

</script>
<br>
<!-- This tells the user how long each DB query took - measured by the end of each page load  
	- - 
			when hovered over, the span will become more visible. -->
<div id='qy'>
<span id="query">&nbsp;&nbsp;&nbsp;&nbsp;Database generated in <?php echo $time; ?> seconds. </span>

</div>
<br>

<!-- The 'Dialog' is a modal window opened when clicking the delete image on a ticket row.
This div enables jQuery to 'open' a message box asking the user if they are sure they want to remove
a ticket from the open queue. Clicking cancel will close the dialog and refresh the page. -->
<div id='dialog' title='Are you sure?' class='talk'>

</div>
<?php
$gmtime = (int)gmdate('U');
?>
<script>

	$(function() {
		$( "#tabs" ).tabs();
		$( ".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *" )
			.removeClass( "ui-corner-all ui-corner-top" )
			.addClass( "ui-corner-bottom" );
	});
	
	$(document).ready(function() {		
var $USER = "<?php echo $user ?>";
	$('#delTable td a.delete').live("click", function () {
		 var id = $(this).parent().parent().attr('id');
		 var userid = '&user=' + $USER;
		 var data = 'id=' + id + userid; 
		 var parent = $(this).parent().parent();
		 $.ajaxSetup({
					type: "POST",
					url: "delete_row.php?",
					data: data,
					cache: false,
					error: function() {
					addNotice("<p>Failed to remove ticket "+ id +". <br> Please refresh the page and try again.</p>");
					},
					success: function () {
						parent.fadeOut(1000, function () {
							$(this).parent().remove();
						});
				/* If we decide to implement AJAX later in the Alert System, the database can be loaded again using the following code. 
					 * The Database page is 'db.php', and is included in the second tab div, which brings it into view on document load. If we decide
						 * to implement AJAX, the php include will need to be modified or removed.*/
		 				


				},
					complete:	function() {	 
							$('#delTable').fadeOut(1500, function() {
									$('#tabs-2').load('db.php').fadeIn('slow');

	addNotice("<p>"+ $USER +" successfully removed Ticket # "+ id +"! </p>");
// log(); 	$.publish($USER +' successfully removed ticket #'+ id +'!');				
								});
							}
			});
				$('#dialog').dialog('open');
					$('.talk').append('<p> Are you sure you want to remove Ticket <u>#<b>'+ id +' </b></u>? </p>');
			return false;
			});

		$('#dialog').dialog({
			autoOpen: false,
			height: 200,
			width: 350,
			modal: true,
			title: '<img src="icon_trashLine.png" height="25px" width="25px"  /> Are you sure, <i>'+ $USER +'</i>?',
			resizeable: false,
			closeOnEscape: true,
			buttons: {
				Okay: function() {	
					$(this).dialog('close');	 
					$.ajax();
					},
				Cancel: function() {
					$(this).dialog('close');
					f();
				}
			}
	});

			$("#tabs").tabs('select', '#tabs-2');
			 $("#quoteme").load('QuoteGet.php');
			 $("#tabs-3").load('HotLinks.php');
					
					
			 
			 $('#close').live("click", function() {
				$('#wrap').hide("scale", {direction: 'vertical', origin: ['top', 'center'] },  800, function() {
					$('#lid').html("<p><img src='icons/user.png' border='0'/> Logged In As "+ $USER +".</p>").show("bounce", 900);
					$.cookie('logbar', 'up', { expires: 365, path: '/' });
					});
			});
			
			$('#lid').live("click", function() {
				$(this).fadeOut(600, function() {
					$('#wrap').fadeIn(900);
						$.cookie('logbar', null);
				});
			});
			
			
			 
			 $('#growl')
				.find('.Gclose')
				.live("click", function() {
					$(this).closest('.notice')
						.fadeOut(1250);
						return false;
			});

});

	$(document).keyup(function(e) {
		if (e.keyCode == 27) { 
			Reload();
		}  
	});
	
	
$(window).ready(function(){  
 setInterval( 'Reload()',  199999);
	});
	</script>

</body>
</html>
