<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<html lang="en">


	<head>
			<title>Tac's NEW Alert System</title>
<?php 
		require_once( "session.php"); 
		require_once( "database.php"); 
?>
<script type="text/javascript" src="js/modernizr.js"></script>
	<script src="jQuery/jquery-1.8.0.js"></script>
		<script src="jquery/jquery-ui-1.8.23.min.js"></script>
		<link rel="stylesheet" href="css/RESET.css">
	<link rel="stylesheet" href="css/smoothness/jquery-ui-smoothness.css">
	<link rel="shortcut icon" href="img/bookmark.ico" type="image/x-icon" />
		<script type="text/javascript" src="js/jquery.form.js"></script> 
  		<script type="text/javascript" src="js/jquery.cookie.js"></script>
	    <script type="text/javascript" src="js/spin.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script> 

<style>
/******************************		
*   TAC's New Alert System               		
*	Developed 9/28/2012 - 10/19/2012  by jim mulhern           		
* 	CERTIFIED FOR: IE 9+ | Opera 12+ | Google Chrome 20+ | Mozilla Firefox 16+
*	Published 10/19/2012
* 		ISI Telemanagement               	
*****************************/	


/*	***	
*HARD STYLES * * *  
*EDIT THIS AFTER ALL OTHER STYLESHEETS 
*HAVE BEEN MODIFIED PROPERLY		***	*/


body {
		font-family: Droid Sans, Cabin Condensed, Arial, Tahoma;
		background: rgba(90,180,225,0.3);
		color: #000;
	}
	#color{
		color: #ffffCC;
	}
	
/*		***	General Styling Classes for re-use throughout the Alert System		***	*/
		
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
	.corners {
		-moz-border-radius: 4px;
		border-top-left-radius: 4px;
		border-bottom-right-radius: 4px;
	}
	.round {
		-moz-border-radius: 8px;
		border-radius: 8px;
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

/*		***	Input bar highlight / Click event / onChange style and animation	***	*/

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
					
/*		***		Login Bar Style and Layout Design 		***	*/

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

#firstlinks{
	position: absolute;
	top: 0px;
	left: 0px;
	vertical-align:top;
}
		#loginout{
			position: fixed;
			top: 0px;
			font-family: Arial, Tahoma, sans-serif;
			padding: 1px;
			display: block;
			background: rgba(0,0,10,0.3);
			color: #fff;
			width: 100%;
			height: 45px;
			text-align:center;
			}
			
					#loginout a{
						color: #f5fffa;
						text-decoration: none;
						font-weight: bold;
					}
						#loginout a:hover{
							color: #ffffff;
							text-decoration: none;
						}
							#outlog{
										float: right;
										clear: left;
										font-size: 12px;
										padding: 0.5em;
										background: rgba(210,20,20,0.5);
										border-radius: 4px;
										border: 1px solid transparent;
									}
									#outlog:hover{
											background: rgba(210,20,20,0.8);
											border: 1px solid #ffffff;
										}
								#in{
									display: inline-block;
									position: relative;
									left: 75px;
									background: rgba(0,150,20,0.5);
									padding: 0.5em;
									vertical-align: bottom;
									text-align: center;
									border-radius: 4px;
								}
								#out{
									display:block;
									position: relative;
									left: 25px;
									padding: 0.25em;
									vertical-align: top;
									font-size: 12px;
									line-height: 0.9;
								}
									#RegUser{
										display: block;
										float: right;
										clear:none;
										padding: 0.5em;
										font-size: 12px;
									}
/*	***	LOGINOUT UL > LI STYLE  & DESIGN LAYOUT	***	*/

			#loginout ul{
				list-style-type: none;
				float: left;
			}
				#loginout ul li{
					display: block;
					cursor: pointer;
				}				
						#open{
							float: left;
							font-family: Arial, Tahoma, sans-serif;
							font-size: 0.8em;
							vertical-align: top;
							background: rgba(150,200,25,0.5);
							color: #f5fffa;
							padding: 0.5em;
							border-radius: 4px;
						}
							#open:hover{
								background: rgba(150,200,25,0.8);
								color: #ffffff;
								}
					
						#links{
							float: left;
							font-family: Arial, Tahoma, sans-serif;
							font-size: 0.8em;
							vertical-align: top;
							background: rgba(0,100,180,0.5);
							color: #f5fffa;
							padding: 0.5em;
							border-radius: 4px;
						}
							#links:hover{
								background: rgba(0, 100, 180, 0.8);
								color: #ffffff;
							}
							#tEdit {
							float: left;
							font-family: Arial, Tahoma, sans-serif;
							font-size: 0.8em;
							vertical-align: top;
							background: rgba(250,220,0,0.3);
							color: #f5fffa;
							padding: 0.5em;
							border-radius: 4px;
							}
								#tEdit:hover{
									background: rgba(250,220,0,0.8);
									color: #ffffff;
								}
									#Stats{
										float: left;
										font-family: Arial, Tahoma, sans-serif;
										font-size: 0.8em;
										vertical-align: top;
										background: rgba(255,140,0,0.3);
										color: #f5fffa;
										padding: 0.5em;
										border-radius: 4px;
									}
										#Stats:hover{
											background:rgba(255,140,0,0.8);
											color: #ffffff;
										}
									#Themes{	
										float: right;
										font-family: Arial, Tahoma, sans-serif;
										font-size: 0.8em;
										vertical-align: top;
										background: rgba(200,10,18,0.3);
										color: #f5fffa;
										padding: 0.5em;
										border-radius: 4px;
									}
										#Themes:hover{
											background: rgba(220, 10, 18, 0.8);
											color: #ffffff;
										}
/*		***		GROWL SECTION		***	*/

#growl {
position: absolute;
top:50;
left:0;
width:350px;
z-index: 999;
color: #ffffff;
padding: 1em;
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
		
/*		***	Database Div and Below Layout	& Design stylings		***	*/
						#Database {
							margin-top: 3.5em;
							margin-left: 2em;
							z-index: 1;
							position: relative;
							clear: both;
						}
							#foo{
								padding-top: 3em;
								padding-left: 45%;
							}
								#allgone{
									position: relative;
									clear: both;
									display: inline-block;
									margin-left: 35%;
									margin-top: 2em;
									z-index: 1;
									text-align: center;
								}
									#all_clear {
										padding: 1em;
										border:1px solid #212121;
										font-family: Courier, Times New Roman, sans-serif;
										background: rgba(250, 250, 210, 0.8);
										color:#212121;
										clear:both;
										float:left;
										border-radius: 4px;
									}
									#table, #delTable {
										text-align: center;
									}
									#foot{
										position: fixed;
										bottom: 0px;
										vertical-align: bottom;
										height: 40px;
										width: 100%;
										background: rgba(10,150,250,0.3);
										color: #ffffff;
										display: none;
									}		
		
/*	***	NewTicket drop-down structure and styling 	***	*/
#panel{
	background: transparent;
}
#panel a{
	color: #0000ff;
	}
		#panel a:hover{
			color: #000000;
			text-decoration: underline;
		}
		#NewTicket{
				position: fixed;
				top: 47px;
				left: 0px;
				display: inline-block;
				text-align: left;
				background: rgba(0,0,10, 0.3);
				padding: 0.5em;
				border: none;
				border-radius: 2px;
			}
				#linx{
					position: fixed;
					top: 47px;
					right: 0px;
				}
				#hotlinks{
					background: rgba(0,0,10,0.3);
					color: #ffffff;
					padding: 1em;
					vertical-align: top;
					float: right;
					clear: both;
					display: inline-block;
					border-radius: 4px;
					z-index: 99;
					}
					#eTicket{
						position: fixed;
						top: 47px;
						left: 0px;
						display: inline-block;
						width: 100%;
						text-align: left;
						background: rgba(0,80,50, 0.3);
						padding: 0.5em;
						border: none;
					}
					#tStat{
						position: fixed;
						top: 47px;
						left: 0px;
						width: 100%;
						display: inline-block;
						background:(100,200,150,0.3);
						padding: 0.5em;
						border: none;
					}
					#Style{
						position: fixed;
						top: 47px;
						left: 0px;
						width: 100%;
						display: inline-block;
						background: rgba(200,10,18, 0.3);
						padding: 0.5em;
						border: none;
						}
					#email{
						float: right;
						clear: none;
						background: transparent;
						cursor: pointer;
						padding: 0px;
						margin: 0px;
						border-radius: 15px;
					}
					#forma {
						padding:5px;
						text-align: left;
						background:transparent;		/* #add8e6; */
						border: none;
						overflow: hidden;
					}
			#aTechs{
					vertical-align: bottom;
					padding: 1em;
					display: block;
				}
			.emails { 
				word-spacing:2px;
				letter-spacing:1px;
				background: transparent;
				border: none;
				font: 14px "Segoe UI";
				color: #000000;
				overflow:hidden;
			} 

/*		***	Ticket Editing Styling and Design Layout		***	*/
		
#eTicket input {
padding:5px;
border-radius: 4px;
}
	#TicketTable {
		background: transparent;
		color: #ffffff;
	}
		#content{
		background: transparent;
		}
	#table {
		text-align: center;
		vertical-align: top;
		color: #000000;
	}

	#table td{
		padding: 5px;
		border-radius: 2px;
	}
	#divtop {
	display: inline;
	text-align: center;
	vertical-align: top;
	}
	#divbottom {
	text-align: left;
	vertical-align: top;
	display: block;
	padding: 5px;
	background: transparent;
	}
	
	.outline {
	border: 1px solid #444444;
	}
	
	#status {
		display: none;
	 padding:10px;
	 margin: 5px auto;
	 border-radius: 4px;
	 clear:both;
	 }
		.success{
		background: #32cd32;
		color: #EEFFCC;
		border:1px solid #006400;
		}
		.error{
		background: #FFCCCC;
		color: #BD0000;
		border: 1px solid #FF0000;
		}
	 #noticket {
	 background: transparent;
	 color: #eeeeee;
	 text-shadow: #444444 0.15em 0.15em 0.25em;
	 font-size: 1.25em;
	 line-height: 1.5;
	 }
	 
	 #save {
	 margin: 5px auto;
	 }
	 
	 #pgTitle{
	 display:block;
	 font-family: Arial Black, Arial, Sans-serif;
	 font-size: 14px;
	 background: #599fcf;
	 color: #f5fffa;
	 text-align: center;
	 padding: 5px;
	 }
		#pgTitle sub{
		font-family: Courier New, Arial, sans-serif;
		font-size: 12px;
		color: #ffffff;
		line-height: 0.75;
		}
			#PutInQ{
			display:none;
			padding:10px;
			margin: 5px auto;
			border-radius: 4px;
			float:right;
			}
				#Putback{
					background: #0073ea;
					text-shadow: #000000 0.1em 0.1em 0.25em;
					color: #ffffff;
					border-radius: 4px;
					border: 1px solid #0000FF;
					}
					#Putback:hover{
						background: #006400;
						color: #EEFFCC;
						border: 1px solid #32cd32;
						}
						
/*	***	Ticket Search Display and Styling	***	*/
#talkbubble {
   width: 120px;
   height: 50px; 
   background: #FFFFCC;
   position: relative;
   -moz-border-radius:    10px; 
   -webkit-border-radius: 10px; 
   border-radius:         10px;
}
#talkbubble:before {
   content:"";
   position: absolute;
   right: 100%;
   top: 15px;
   width: 0;
   height: 0;
   border-top: 13px solid transparent;
   border-right: 26px solid #FFFFCC;
   border-bottom: 13px solid transparent;
}

.removed {
background:#EFC2C2;
padding:5px;
display:block;
cursor:pointer;
}

.added{
background:#D8E6AD;
padding:5px;
display:block;
cursor:pointer;
} 						

/*		***	Database Ticket Listing Display Classes and Stylings		***	*/
	.tblOclr {
	background:  #d9d9d9;
	color: #0064CD;
	padding: 3px;
	}
	.tblEclr {
	background: #e6e6e6;
	color: #00438A;
	padding:3px;
	}
	.tblFclr {
	background:  #f5f5f5;
	color: #cd0a0a;
	text-shadow: #212121 0.1em 0.1em 0.15em;
	padding:3px;
	}
	.tblbrdr{
	border-right: 0px solid #bbbbbb;
	border-bottom: 0px solid #bbbbbb;
	padding: 5px;
	}

.database{
display: none;
}
</style>

	</head>
	
	<body>
<!--				<div id="title"> 
		<div id="growl"> </div>
<div id="titleimg"></div>	
		</div>	-->
	<div id="loginout">
	<ul id="firstlinks">
			<li id="open"><img src="icons/Application_go.png" />
					<br>	<sub>New Ticket</sub>
			</li>
			<li id="tEdit"><img src="icons/folder_explore.png" title="Edit Tickets in Real-time!"/>
				<br>	<sub>Edit Tickets</sub> 
			</li>
			<li id="Stats"><img src="icons/calendar.png" title="Generate Ticket Statistics" />
				<br>	<sub>Search Tickets</sub>
			</li>
			<li id="links"><img src="icons/Application.png" />
					<br>  <sub>Quick Links</sub>
			</li>
			<li id="Themes"><img src="icons/color_swatch.png" title="Update TAC Alert Style" />
				<br>	<sub>Themes</sub>
			</li>
		</ul>
				<?php require("TAClogin.php"); ?>
<span id="panel">				
					<div id="NewTicket"></div>
					<div id="linx"></div>
					<div id="eTicket"></div>
					<div id="tStat"></div>
						<div id="Style"> <small>Themes & Styles <em>Coming Soon!</small></em>
<!--							 <a href="#"  rel="css/Bootstrap/jquery-Bootstrap.css" id="Bootstrap">BootStrap</a>&nbsp;&nbsp;|&nbsp;&nbsp;
							  <a href="#" rel="css/flick/jquery-flick.css" id="flick">Flickr</a>&nbsp;&nbsp;|&nbsp;&nbsp;
							  <a href="#" rel="css/fbook/jquery-fbook.css" id="fbook">f-book</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
							  <a href="#"  rel="css/ICS/jquery-ICS.css" id="ICS">Ice Cream Sammy</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
							  <a href="#"  rel="css/RainyDay/jquery-RainyDay.css" id="RainyDay">Rainy Day</a>&nbsp;&nbsp;|&nbsp;&nbsp;  
							<a href="#" rel="css/vader/jquery-vader.css" id="vader">Vader</a>	-->
						</div>
					</span>
	</div>
<br>
			<div id="Database">
	<?php require('dbb.php'); ?>
	</div>
<br>
<div id='dialog' title='Email Recipients' class='talk'></div>
<div id="growl"></div>	
<div id="foot"></div>	
<div id="notice"></div>	
<div id="removal" title='Are you sure?' class='talk'> </div>

<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Source+Sans+Pro::latin', 'Droid+Sans::latin', 'Lato::latin', 'Cantora+One::latin', 'Cabin+Condensed::latin', 'Istok+Web::latin', 'Ubuntu:500:latin', 'Share::latin', 'Open+Sans+Condensed:300:latin', 'Oswald:700:latin', 'Electrolize::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://tac-alert01/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>	
		
<script>
/* 
	Set up cookie usage for future theming of the Alert System	
			***	 Future Challenge: Create themes using the LESS extension for CSS stylesheets.	***	
																																							
	var theme = $.cookie('theme');
				if($.cookie("theme")) {
	$("link").attr("href",$.cookie("theme"));
}		
*/

$(document).ready( function() {
		/* Load each segment of the Alert System to decrease overall page load on first render	*/

	$('#NewTicket').load('NewTicket.php').hide();
	$('#linx').load('links.php').hide();
	$('#eTicket').load('eTicket.php').hide();
	$('#tStat').load('tick2stats.php').hide();
	$('#Style').hide();
//		$('#Database').load('dbb.php');
	
		/*			 Functions for dropping down individual segments of the top activity bar. 
				These will eventually become an unsorted list of links across the opaque top of the Alert System.
											*/
	$('#open').live("click", function() {
		$('#NewTicket').slideToggle('slow');
		$('#eTicket, #linx, #tStat, #Style').slideUp('slow');
		
	});
				$('#links').live("click", function() {
					$('#linx').slideToggle('slow');
					$('#eTicket, #NewTicket, #tStat, #Style').slideUp('slow');
					
			});
				$('#tEdit').live("click", function() {
					$('#eTicket').slideToggle('slow');
					$('#NewTicket, #linx, #tStat, #Style').slideUp('slow');
				});
					$('#Stats').live("click",function() {
						$('#tStat').slideToggle('slow');
						$('#NewTicket, #linx, #eTicket, #Style').slideUp('slow');
					});
					$('#Themes').live("click", function() {
						$('#Style').slideToggle('slow');
						$('#NewTicket, #tStat, #linx, #eTicket').slideUp('slow');
							return false;
					});
					$('#loginout ul li').live("click", function(){
						$('#Database').toggle("drop");
					});
//	Functions for refreshing TACALERT via Ajax calls	//

			function f() {   
				setTimeout('window.location.reload()', 10); 
			};
	
	/*				The main reloading function of the Database. 
								*	Clears the current render
								*	Creates a spinner out of HTML elements
								*	Spins and fades the spinner
								*	Renders a refreshed database load via Ajax.
													USE CAUTION WHEN MAKING EDITS TO THIS		*/
function Reload() { 	
	$('#table').fadeOut(1000, function() {
			$(this).html('<p><div id="foo"> </div></p>').fadeIn(900);
var opts = {
  lines: 11, // The number of lines to draw
  length: 45, // The length of each line
  width: 6, // The line thickness
  radius: 50, // The radius of the inner circle
  corners: 0.8, // Corner roundness (0..1)
  rotate: 5, // The rotation offset
  color: '#00438A', // #rgb or #rrggbb
  speed: 1.6, // Rounds per second
  trail: 70, // Afterglow percentage
  shadow: true, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '10px', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
}
var target = document.getElementById('foo');
var spinner = new Spinner(opts).spin(target);
 });
		$('#Database').fadeOut(1500, function() {
			$(this).load('dbb.php').fadeIn(2000);
				setTimeout('apply()', 10);
				$('#NewTicket, #tStat, #linx, #eTicket, #Style').slideUp('slow');
			});

};
		/*		When no tickets are available, 
					clicking the speech bubble will explode and refresh the db 
						in case new tickets have arrived	*/
							$('#all_clear').live("click", function() {
								$(this).hide("explode", 2000 );
									Reload();
							});

/*		Ticket submission via ajax, after dropping open the New Ticket div	
*	 		Sends $_POST request to NewTicket.php and rolls through error checking on the server-side.
*			*** Implement jQuery error-checking to future updates so errors appear seamlessly and in realtime 														*/
$("#SubButton").live("click",  function() {
		var $Priority =  $(" input:radio[name=priority]:checked").val();
		var $TicketNumber = $("#TicketNumber").val();
		var $SiteID = $("#SiteName").val();
		var $Comments = $("#comments").val();
		var $dataString = 'ticket='+ $TicketNumber +'&siteName='+ $SiteID +'&priority='+ $Priority +'&Comments='+ $Comments;
	$.ajax({
		url:  'insertPDO.php?',
		type: 'POST',
		data: $dataString, 
		success: function(data){
				if (data == '1'){
			$("#NewTicket").html('<p><b>Awesome!</b><br> <img src="loadinganimation.gif" /> <br> Your Ticket Posted!</p>').fadeIn('slow')
					.delay(1000).fadeOut('slow', function(){
						$('#NewTicket').load("NewTicket.php").fadeIn('slow');
						$('#NewTicket').delay(800).slideUp(1000);
							Reload();
					});
				}
				else {
						$("#NewTicket").html('<p><br>'+  data +'</p>').fadeIn('slow')
							.delay(8000).fadeOut('slow', function(){
								$('#NewTicket').load("NewTicket.php").fadeIn('slow');
								Reload().delay(800);
						});
				}
		}
	});
		return false;
	});
		

	$(document).keyup(function(e) {
		if (e.keyCode == 27) { 
			Reload();
		}  });				
		
	
function addNotice(notice){
	$('<div class="notice"></div>')
		.append('<div class="skin"></div>')
		.append('<a href="#" class="Gclose"><img src="http://tac-alert01/icons/cross.png" /></a>')
		.append($('<div class="content"></div>').html($(notice)) )
		.hide()
		.appendTo('#growl')
		.fadeTo('slow', 0.15)
	    .animate({
			top: '+=100',
			opacity: 0.75
			}, 1000);

	};
/*	
***		Function for removing tickets in the Alert System		***
	*	Prompts confirmation in a Dialog before removing ticket from page.
	* Confirm fades out DB and refreshes via Ajax - page remains static.
	* A Notice function is generated after DB refresh, confirming the removal of ticket.
	* Ticket is updated in SQL to append 'X' in 'Removedby' column, which toggles the SQL to display tickets.
	*	*	*		DO NOT MAKE ADJUSTMENTS TO THIS FUNCTION UNLESS MOVING TO A SEPARATE PAGE		*	*	*
					*		 * * * * 		* 		H E R E   B E   D R A G O N S 	* 		* * * *		 *										
*/
			
	   	   var $USER = "<?php echo $_SESSION['myusername']; ?>";
	$('#delTable td a.delete').live("click", function () {
		 var id = $(this).parent().parent().attr('id');
		 var userid = '&user=' + $USER;
		 var data = 'id=' + id + userid; 
		 var parent = $(this).parent().parent();
		
				$('#removal').dialog('open');
					$('.talk').append('<p> Are you sure you want to remove Ticket <u>#<b>'+ id +' </b></u>? </p>');
			return false;
			});

		$('#removal').dialog({
			autoOpen: false,
			height: 200,
			width: 350,
			modal: true,
			title: '<img src="icon_trashLine.png" height="25px" width="25px"  /> Are you sure, <i>'+ $USER +'</i>?',
			resizeable: false,
			closeOnEscape: true,
			buttons: {
				Okay: function() {	
								var id = $('#delTable td a.delete').parent().parent().attr('id');
								 var userid = '&user=' + $USER;
								var data = 'id=' + id + userid; 
								var parent = $('#delTable td a.delete').parent().parent();
					$(this).dialog('close');	 
						$.ajax({
								type: "POST",
								url: "delete_row.php?",
								data: data,
								cache: false,
								error: function() {
								addNotice("<p>Failed to remove ticket "+ id +". <br> Please refresh the page and try again.</p>");
								},
								success: function () {
											parent.fadeOut(1000, function () {
										$(this).remove();
									});
							},
								complete:	function() {	 
										$('#delTable').fadeOut(1500, function() {
												$('#Database').load('dbb.php').fadeIn('slow');
													addNotice("<p>"+ $USER +" successfully removed Ticket # "+ id +"! </p>");
										});
								}
										
						});
					},
				Cancel: function() {
					$(this).dialog('close');
						setTimeout('window.location.reload()', 100); 
				}
			}
	});

		 
			 $('#growl')
				.find('.Gclose')
				.live("click", function() {
					$(this).closest('.notice')
						.fadeOut(1250);
						return false;
			});
});


$(window).ready(function(){  
 setInterval( 'Reload()',  99999);
	});
</script>		
	</body>
</html>