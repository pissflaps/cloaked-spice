<!DOCTYPE html>

<meta charset="utf-8">
<html lang="en">
<head>
<!-- This page has been well documented for the uninitiated editor.
The HTML layout leaves much to be desired, but the integrity of the design works with all browsers except IE7 and below.
The PHP pages are cobbled with many of the same functions, the DB is an entire HTML page with PHP used to connect to the MySQL database.
The jQuery is mostly separated by folder, so all scripts should be contained where necessary. The PHP scripts are in the root, however.
-->
	
<?php include( "session.php"); ?>
<?php include( "database.php"); ?>
<base href="http://tac-alert01/index_a.php">
	<script src="jQuery/jquery-1.8.0.js"></script>
		<script src="jquery/jquery-ui-1.8.23.min.js"></script>
	<link rel="stylesheet" href="css/jquery-ui-custom1.css">
	<link rel="shortcut icon" href="http://tac-alert01/img/bookmark.ico" type="image/x-icon" />
		<script type="text/javascript" src="js/thickbox.js"></script>
		<script type="text/javascript" src="js/jquery.form.js"></script> 
  		<script type="text/javascript" src="js/jquery.cookie.js"></script>
  		<script type="text/javascript" src="jquery/jq-RBC.js"></script>
		<script type="text/javascript" src="js/spin.min.js"></script>
		<title>TAC's Accordion Alert System</title>
		

<style>
	body {
	    -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: none;
		}

	#delTable {
font-size: 90%;
text-align: center;
}
	
#title {
background: #ffffff;
height:100px;
}

#themes {
clear:both;
float:left;
padding:4px;
line-height: 2;
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
color: #444444;
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


	#tab2 {
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
		padding: 20px;
		border:1px solid #000000;
		background:#FFFFCC;
		color:#000000;
		clear:both;
		float:left;
		border-radius: 2px;
		}
			

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
			
			
			#tad {
			position: relative;
			top: 0px;
			float: left;
			clear: both;
			}
			#tad a{
			color: #0000ff;
			text-decoration: none;
			}
			#tad a:hover{
				color: #000000;
				text-decoration: underline;
				}

			#status{
			background: #0073ea;
			color: #ffffff;
			text-decoration: bold;
			padding: 15px;
			text-align: center;
			display: none;
			}
			
	#tabs { min-height: 50%; width: 95%; margin: 10px auto; } 
	.tabs-bottom { position: relative; } 
	.tabs-bottom .ui-tabs-panel { min-height: 350px; } 
	.tabs-bottom .ui-tabs-nav { position: absolute !important; left: 0; bottom: 0; right:0; padding: 0 0.2em 0.2em 0;} 
	.tabs-bottom .ui-tabs-nav li { margin-top: -2px !important; margin-bottom: 1px !important; border-top: none; border-bottom-width: 1px; left: 25%; }
	.ui-tabs-selected { margin-top: -3px !important; }
	
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

		#out {
		font-size: 75%;
		}
		#outlog{
		background: #ff0000;
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
		background: #000000;
		border: 1px dashed #ffffff;
		padding: 5px;
		}
		#RegUser {
		position: absolute;
		top:1px;
		right:2px;
		padding:6px;
		background:#ff0084;
		color:#cccccc;
		border-radius:4px;
		line-height:0.9em;
		}
#RegUser:hover { background: #0073EA; }		
#RegUser a{ color:#eeeeee; } #RegUser a:hover{ color: #F5FFFA; }

		#close {
			font-family: "Arial Black";
			font-size: 0.9em;
			background: #bd0000;
			color: #f1f2f7;
			padding: 5px;
			border-radius: 4px;
			float: right;
			border: 1px solid #bbbbbb;
			line-height: .75em;
			}
			
			#close:hover {
					color: #f1f2f7;
					background: #599fcf;
					padding: 5px;
					font-weight: heavy;
					border-radius: 2px;
					border:1px solid #000000;
					cursor: pointer;
					}
			#lid p {
			font-size: 0.75em;
			background: #006400;
			color: #f1f2f7;
			padding: 5px;
			border-radius: 4px;
			float: right;
			border: 1px solid #bbbbbb;
			line-height: 0.85em;
			text-shadow: #444444 0.1em 0.1em 0.2em;
			cursor:pointer;
			}
				#lid p:hover {
				background: #f1f2f7;
				color: #000000;
				border: 1px solid #dadada;
				}
				
				#lid p:before {
				display: block;
				background: #006400;
				}
				
					
					.db {
					margin: 10px auto;
					overflow: auto;
					}
						#dbb:after {
							content: ".";
							display: block;
							height: 0;
							clear: both;
							visibility: hidden;
						}
						#tabs-2 {
							padding-bottom: 2em;
							overflow: auto;
						}
		.shadow {
				-moz-box-shadow:    6px 5px 4px 3px #ccc;
				-webkit-box-shadow: 6px 5px 4px 3px #ccc;
				 box-shadow:         6px 5px 4px 3px #ccc;
			 }
 		
		#out, #in {
			background: transparent url('img/bar-m.png') ;
			color: #f5fffa;
			padding: 6px;
		}

	.tblFclr {
		text-shadow: #444444 0.1em 0.1em 0.2em;
	}
#growl {
position: absolute;
top:0;
left:0;
width:350px;
z-index: 999;
color: #fff;
padding: 2px;
display:inline-block;
border-radius: 4px;
}
	.notice {
		position: relative;
	}
	
	.skin {
		position: absolute;
		background: #000;
		bottom: 0;
		left: 0;
		opacity: 0.5;
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

</style>

	<?php require ("requireonce.php"); ?>


	<script>
$(document).ready( function() {
				$('#all_clear').live("click", function() {
				$(this).hide("explode", 2000 );
					Reload().delay(800);
				});
			 
			 $('#close').live("click", function() {
				$('#wrap').hide("scale", {direction: 'vertical', origin: ['top', 'center'] },  800, function() {
				var $USER = "<?php echo $user ?>";
								$('#lid').html("<p><img src='icons/status_online.png' border='0'/> Logged In As "+ $USER +".</p>").show("bounce", 900);
					$.cookie('logbar', 'up', { expires: 365, path: '/' });
					});
			});
			
			$('#lid').live("click", function() {
				$(this).hide("scale", {direction: 'vertical', origin: 'top' },  800);
					$('#wrap').show("fade", 900);
					$.cookie('logbar', null);
			});
			

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
<div id="growl"> </div>
<div id="titleimg">
</div>
<div id='loginout'>
	<?php include("loginout.php"); ?>
</div>
	</div>

<br>
<div class="demo">
 
<div id="accordionResizer" style="padding:10px; max-width:95%;" class="ui-widget-content">

<div id="accordion">
	<h3><a href="#" id='first'>Ticket Entry</a></h3>
	<div>

	<span id="email" style="background:transparent;">
<a href="emails.html?TB_iframe=true&height=600&width=400&modal=false" title="Email Recipients" class="thickbox">
	<img src="img/emailicon.png" title="Email Recipients"  /></a> 
	</span>

<br/> 

<FORM name="Tsubmit" ACTION="pdo_insert.php" METHOD="POST">

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
	<div id="linqs">
	
	</div>
	<h3><a href="#" id='fourth'>Random Quote</a></h3>
	<p> 
		<span id="quotes"> 
				</span>
	</p>	
</div>

<span class="ui-icon ui-icon-grip-dotted-horizontal" style="margin:2px auto;"></span>
</div><!-- End accordionResizer -->



</div>

<br>
<div id='themes'><b>&nbsp;&nbsp; Themes: &nbsp;&nbsp;</b> 
   <a href="#"  rel="css/Bootstrap/jquery-Bootstrap.css" id="Bootstrap">BootStrap</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<!-- <a href="#" rel="css/start2/jquery-start2.css" id="default">Start</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
<!-- <a href="#" rel="css/excite-bike/jquery-excitebike.css" id="excite">Excite Bike</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
  <a href="#" rel="css/MonoChrome/jquery-MonoChrome.css" id="MonoChrome">Mono Chrome</a> &nbsp;&nbsp;|&nbsp;&nbsp; 
<!-- <a href="#"  rel="css/hot-sneaks/jquery-HotSneaks.css" id="HotSneaks">Hot Sneaks</a>&nbsp;&nbsp;|&nbsp;&nbsp;  -->
<!-- <a href="#" rel="css/dot-luv/jquery-dotluv.css" id="dotluv">Dot Luv</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
  <a href="#" rel="css/sunny/jquery-sunny.css" id="sunny">Sunny</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<!-- <a href="#" rel="css/dark-hive/jquery-darkhive.css" id="dark">Dark Hive</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
<!-- <a href="#" rel="css/pepper-grinder/jquery-peppergrinder.css" id="pepper">Pepper Grinder</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
  <a href="#" rel="css/trontastic/jquery-trontastic.css" id="trontastic">Tron-Tastic</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<!-- <a href="#"  rel="css/swanky-purse/jquery-swankypurse.css" id="swanky">Swanky</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
   <a href="#"  rel="css/HDE/jquery-HDE.css" id="HDE">Hot Dog Stand</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
<!--<a href="#" rel="css/le-frog/jquery-lefrog.css" id="lefrog">Le-Frog</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
<!-- <a href="#"  rel="css/ICS/jquery-ICS.css" id="ICS">Ice Cream Sammy</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
<!--  <a href="#"  rel="css/south-street/jquery-southstreet.css" id="Southstreet">South Street</a>&nbsp;&nbsp;|&nbsp;&nbsp;  -->
  <a href="#"  rel="css/RainyDay/jquery-RainyDay.css" id="RainyDay">Rainy Day</a>&nbsp;&nbsp;|&nbsp;&nbsp;  
  <a href="#" rel="css/fbook/jquery-fbook.css" id="fbook">f-book</a>&nbsp;&nbsp;|&nbsp;&nbsp;
  <a href="#" rel="css/vader/jquery-vader.css" id="vader">Vader</a>

  </div>
  <br/>
<button name="killtheme" id="kill" value="" style="float:right">Remove Theme</button>

<br>
<div id="old">
&nbsp; &bull; <a href="http://tac-alert01/index.php">Go back to the NEW Alert System</a> <br>
 </div>
<!--  <span id="tad"><small>&nbsp; &bull; <a href="http://tac-alert01/index.php" id="tabb">Try the new <i>Tabbed</i> Alert System</a>	&bull;</small></span> -->
<script>
/*				if($.cookie("tabs")) {
	window.location = 'http://tac-alert01/index.php';
}		

function swap() {
window.location = 'http://tac-alert01/index.php';	
};
		$(document).ready(function () {
			   // COOKIES
      
	var tabb = $.cookie('tabs');
		$('a#tabb ').live('click', function(){	
		$.cookie('accordion', null);
		$.cookie('tabs', 'tab', { expires: 365, path: '/' });

		swap();
			});
});	

});
*/

if($.cookie("logbar"))  {
						$('#wrap').slideUp(10, function(){
					var $USER = "<?php echo $user ?>";
						var $LoggedIn = "<p><img src='icons/status_online.png' border='0'/> <b>"+ $USER +"</b> logged in.</p>";
					$('#lid').append($LoggedIn).show("bounce", {"times": 5}, 'slow');
					});
				}
$(document).ready( function() {
	 $("#quotes").load("QuoteGet.php");
			 $("#linqs").load("HotLinks_a.php");
			 
});
</script>
<div id='dialog' title='Are you sure?' class='talk'>

</div>

<?php 
echo "<br><center><span id='query'>&nbsp;&nbsp;&nbsp;&nbsp;Database generated in $time seconds\n </span></center><br>";	
?>
</body>
</html>
