<!DOCTYPE  html>
<meta http-equiv="x-ua-compatible" content="IE=9">
<meta http-equiv="content-script-type" content="text/javascript">
<meta charset="utf-8">
<html lang="en">
<head>
<script src="js/head.js" type="text/javascript"></script>	
<?php 
		require_once( "session.php"); 
		require_once( "database.php"); 
?>



<script>
       var start = new Date();	
	head.js("jQuery/JQ.NoConflict.js")
	.js("js/jquery.cookie.js")
	.js("js/jquery.form.js")
	.js("js/spin.min.js")
	.js("jQuery/jquery-ui-1.9.2.custom.min.js")
	.js("css/tacalert.css");
	
</script>	

<title>Tac's Alert System</title>

<title>Tac's Alert System</title>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

</head>
<!-- 
Images for 	div#firstlinks > ul > li	 have been moved over to stylesheets to allow more customized theming of the Alert System.
		Icons will be stored in the htdocs\img folder, and are used as background images for each section. 
	The background has been positioned to allow the text below it, line height will play a major role in getting the structure correct,
as some fonts will not cooperate with tiny spaces.
-->
<body>
<header>	<nav id="firstlinks">
		<ul>	
			<li id="open" title="Open a new ticket."><br>
					<br><sub>New Ticket</sub>
			</li>
			<li id="tEdit" title="Edit Tickets in Real-time!"><br>
				<br><sub>Edit Tickets</sub> 
			</li>
			<li id="Stats" title="Generate Ticket Statistics."><br>
				<br><sub>Search Tickets</sub>
			</li>
			<li id="links" title="Get where you need to be."><br>
				<br><sub>Quick Links</sub>
			</li>
			<li id="Themes" title="Update TAC Alert Style."><br>
				<br><sub>Themes</sub>
			</li>
			<li id="Tweather" title="How's the weather?"><br>
				<br><sub>Weather</sub>
			</li>
	</ul>
	<div id="spaceme">
		<!--
		/*	The Wiki search bar has been moved to the top-center of the Alert System. 
		***	The functionalty has been modified to adjust the size as someone begins typing.
		***	
		*/
		-->
<form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' method='GET' TARGET="_new" id="WikiForm">
<input type='hidden' name='title' value='Special:SphinxSearch'>
	<input type="search" id="search" name='sphinxsearch' maxlength='150' TABINDEX="4" placeholder="Search the Wiki">
	<button type='submit' name='fulltext' id="WikiSearch" value='Search' > <img src="/icons/AP/zoom.png" height="16px" width="16px" border="0" alt=""/>  </button>
						</form>
</div>				

</nav>
<!-- 
The Login bar will appear at the top of the page - it will display a different state depending on whether the user has a login cookie present.
	If no cookie for their IP address can be located, they will be displayed a login prompt of a checkbox, two input boxes and a submit button. 
  Within the login dialog, a DIV has been assembled to offer registration, whereby the user inputs a name and password for use in the Alert System.
If a cookie has been loaded, a message will display indicating they are logged in [cookied], and an option for logging out is available to the far right.
-->	
	<div id="loginout">
				<?php require("AlertLogin.php"); ?>
<UL id="panel">				
					<li id="NewTicket"></li>
					<li id="linx"></li>
					<li id="eTicket"></li>
					<li id="tStat"></li>
						<li id="Style">	
					<UL class="themes"> 
						<li class="themes"><a href="#"  rel="css/Vader.css" id="Vader">Vader</a> | </li> 
						<li class="themes"><a href="#"  rel="css/ISI.css" id="ISItheme">ISI</a> |  </li> 
						<li class="themes"><a href="#"  rel="css/ExciteBike.css" id="Excite">Excite Bike</a>  |  </li> 
						<li class="themes"><a href="#"  rel="css/Darkness.css" id="Darkness">Darkness</a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/Mario.css" id="Mario">Mario Twins</a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/Professional.css" id="Professional">Pro-Fession</a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/MicroSop.css" id="MicroSop">Micro Sop</a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/Flickr.css" id="Flickr">Flickr</a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/Aquaman.css" id="Aquaman">AquaMan</a> </li> 						
					</UL>
						<!--			
	* *	 These are excluded themes due to compatability with the new layout structure 	::	 use as reference ONLY 	* *
						<a href="#"  rel="css/snow.css" id="snow">SnowDay</a>  | 
						  <a href="#" rel="css/fbook/jquery-fbook.css" id="fbook">f-book</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
						  <a href="#"  rel="css/ICS/jquery-ICS.css" id="ICS">Ice Cream Sammy</a>&nbsp;&nbsp;|&nbsp;&nbsp; 	
						  <a href="#"  rel="css/Jurassic.css" id="Jurassic">Jurassic Park</a>  |   
						  <a href="#"  rel="css/sunny.css" id="sunny">Sunny</a>    
						-->
							<button name="killtheme" id="kill" value="" style="float:right">Default Theme</button> 	
						</li>
					</UL>
	</div>
</header>
<br>
<!-- 
The Database is called from the PHP page (dbb.php); The PHP page contains two major functions: the first determines if any tickets have not yet been removed.
If no tickets are available, the function will display a message indicating the Database has been cleared for the day.
If any tickets are available, the second function formats the display of the database to make it human-legible. This also includes the functionality for
removing tickets from the Alert System.
-->
			<div id="Database">
	<?php require('dbb.php'); ?>
	</div>
<br>
<!-- 
The Dialog box is a hidden div until certain jQueryUI elements call it to display.
A message is contained in a separate class, inserted when the Dialog is called to display.
	** There are two other layers of 'skin' and 'content' within each Stylesheet that are used in jQuery to pump a message into each layer and style them
	according to the jQueryUI specifications.
	*** This function uses the Growl and Notice divs respectively to skin and insert content.
--> 
<div id='dialog' title='Email Recipients' class='talk'></div>
<div id="growl"></div>	
<div id="notice"></div>	
<div id='removal' title='Are you sure?' class='talk'> </div>
	<div id="ISI"><img src="img/ISI_ex150.gif" border="0" /></div>

	
<!-- Flickr Photo Set Captions :: These overlay images used as a fullscreen background slideshow. 
		***	[STRUCTURE.CSS] WILL HAVE THIS ELEMENT MADE INVISIBLE, SO TAKE THAT INTO ACCOUNT
		*** WHEN INCLUDING THAT STYLESHEET 
		***	ON FUTURE THEMES 		-->

		<ul class="cb-slideshow">
            <li><SPAN> </SPAN><div><h3> </h3></div></li>
            <li><SPAN> </SPAN><div><h3> </h3></div></li>
            <li><SPAN> </SPAN><div><h3> </h3></div></li>
            <li><SPAN> </SPAN><div><h3> </h3></div></li>
            <li><SPAN> </SPAN><div><h3> </h3></div></li>
            <li><SPAN> </SPAN><div><h3> </h3></div></li>
        </ul>
	<div id="Whois"></div>
	<!--	
	// This area loads from a PHP script written to look into the login tables, 
	// where someone has recently logged in, whether by cookies or using the login.
	//  If the recorded date matches today's date [$_SERVER], we assume they are logged in for today.
	// Logging out destroys php's $_SESSION variable, so we're safe to assume closing the browser will 'log out' inactive users.
	// Entropy of cookies and sessions can be modified in [(xampp)/php/php.ini]
	-->
			
<script type="text/javascript"> 
head.ready( function() {

	//				WEATHER	-- Cookie determines if page reload will also load Weather div, 
	//						or if it remains hidden until user event loads the container.
		
	
jQuery(document).ready( function() {
	var Weather = $.cookie("Weather");

/* Load each segment of the Alert System to decrease overall page load on first render	
		

***				*/

	$('#NewTicket').load('NewTicket.php');		//Loads in the functions for opening new tickets.
	$('#linx').load('links.php');		//Loads the Quick Links and populates the random banner image.
	$('#eTicket').load('eTicket.php');		//Loads the Ticket editor input box. Type the ticket and open a new page to edit it.	
	$('#tStat').load('tick2stats.php');		//Loads the calendar input box, select a date and see its ticket activity on a new page.
	$('#Whois').load('WhoisLogged.php');		//Loads the calendar input box, select a date and see its ticket activity on a new page.
	//		$('#Database').load('dbb.php');
	$('#NewTicket, #linx, #eTicket, #tStat, #Style').hide();
	

			if($.cookie("Weather")) {
		$('#tacWeather').load('TACweather.php').fadeIn(1000);
}		


	/*				The main reloading function of the Database. 
								*	Clears the current render
								*	Creates a spinner out of HTML elements
								*	Spins and fades the spinner
								*	Renders a refreshed database load via Ajax.
								* * * * * * 	USE CAUTION WHEN MAKING EDITS TO THIS		*/
function Reload() { 	
	$('#delTable').fadeOut(900, function() {
			$(this).html('<p><div id="foo"> </div></p>').fadeIn(600);
var $Color = $("#Style a").css("color");

var opts = {
  lines: 15, // The number of lines to draw
  length: 55, // The length of each line
  width: 6, // The line thickness
  radius: 50, // The radius of the inner circle
  corners: 0.6, // Corner roundness (0..1)
  rotate: 6, // The rotation offset
  color: $Color, // #rgb or #rrggbb
  speed: 1.8, // Rounds per second
  trail: 70, // Afterglow percentage
  shadow: true, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: 'auto', // Top position relative to parent in px
  left: '200px' // Left position relative to parent in px
}
var target = document.getElementById('foo');
var spinner = new Spinner(opts).spin(target);
 });
		$('#Database').fadeOut(1500, function() {
			$(this).load('dbb.php').fadeIn(2000);
				$('#NewTicket, #tStat, #linx, #eTicket, #Style').slideUp('slow');
			});

}


/*	***	EXPAND the SEARCH 
	***	Focus [click] on the input box to expand the search
	***	bar. Type your query and submit search on
	*** the Wiki powered by Sphinx
*/
		var inputWidth = '350px';
		var inputWidthReturn = '150px';

	$('#search').focus(function(){
if( ($(this).val) == null){
		//clear the text in the box.
	$(this).val(function() {
		$(this).val('');
	});
}
		//animate the box
	$(this).animate({
		width: inputWidth
		}, 500 )
	});
	$('#search').blur(function(){
				var $STORAGE = $(this).val();
		if($STORAGE == null) {
				$(this).val('Search the Wiki');
		}
		$(this).animate({
		width: inputWidthReturn
		}, 800 )
	});
/*	*** END Searchbar Stretch function	***	*/

					$('#tacWeather').dblclick(function(){
						$(this).fadeOut(2000).remove();
						$.cookie("Weather", null);
					});
			
		/*			 Functions for dropping down individual segments of the top activity bar. 
				These will eventually become an unsorted list of links across the opaque top of the Alert System.												*/
				
	$('#open').on("click", function() {
		$('#NewTicket').slideToggle('slow');
		$('#eTicket, #linx, #tStat, #Style').slideUp('slow');
		
	});
				$('#links').on("click", function() {
					$('#linx').slideToggle('slow');
					$('#eTicket, #NewTicket, #tStat, #Style').slideUp('slow');
					
			});
				$('#tEdit').on("click", function() {
					$('#eTicket').slideToggle('slow');
					$('#NewTicket, #linx, #tStat, #Style').slideUp('slow');
				});
					$('#Stats').on("click",function() {
						$('#tStat').slideToggle('slow');
						$('#NewTicket, #linx, #eTicket, #Style').slideUp('slow');
					});
					$('#Themes').on("click", function() {
						$('#Style').slideToggle('slow');
						$('#NewTicket, #tStat, #linx, #eTicket').slideUp('slow');
							return false;
					});
						$('#Tweather').on("click", function() {
							$('#tacWeather').load('TACweather.php').fadeIn(1000);
								$.cookie("Weather", "On", {expires: 9999, path: '/'});
							});
					$('#open, #links, #tEdit, #Stats, #Themes').on("click", function(){
						$('#Database').toggle("drop");
					});
						
					$('#WikiForm, #Ticketform, #EditForm').on('submit', function(){
						$form.find('input:text').blur();
					});
						
//	Functions for refreshing TACALERT via Ajax calls	//

/*
function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

// to call, use: resetForm($('form[name=myName]')); // by name
*/
	function f() {  
		setTimeout('window.location.reload()', 10); 
	}
	

		/*		When no tickets are available, 
					clicking the speech bubble will explode and refresh the db 
						in case new tickets have arrived. Otherwise,
							the default refresh rate applies. 		*/
							$('#all_clear').on("click", function() {
								$(this).hide("explode", 1000 );
									Reload();
							});

/*		Ticket submission via ajax, after dropping open the New Ticket div	
*	 		Sends $_POST request to NewTicket.php and rolls through error checking on the server-side.
*			*** Implement jQuery error-checking to future updates so errors appear seamlessly and in realtime 														*/
$("#submissionForm").on("submit",  function(event) {
		var $Priority =  $("input:radio[name=priority]:checked").val();
		var $TicketNumber = $("#TicketNumber").val();
		var $SiteID = $("#SiteName").val();
		var $Comments = $("#comments").val();
		var $dataString = 'ticket='+ $TicketNumber +'&siteName='+ $SiteID +'&priority='+ $Priority +'&Comments='+ $Comments;
	$.ajax({
		url:  'insertPDO.php?',
		type: 'POST',
		data: $dataString,
		beforeSend: function() {
			var Value = $("#TicketNumber").val();
			var Site = $("#SiteName").val();
			if(Value.length < 6 || Value = "Ticket Number"){ 
		event.stopPropagation();
				$("#help1").html("Please check your ticket number and try again.").fadeIn(600);
				$("#help1").delay(800).fadeOut(3000);
			return false;
			}
			if( Site != "Site Name"){
		event.stopPropagation();
				$("#help2").html("Please check the Site Name and try again.").fadeIn(600);
				$("#help2").delay(800).fadeOut(3000);
			return false;
			}			
		},	
		success: function(response){
				if (response == '1'){
$("#NewTicket").html('<p id="success"><b>Awesome!</b><br> <img src="loadinganimation.gif" /> <br> You posted Ticket #' + $TicketNumber +'! <br> Let\'s refresh the Database.</p>').fadeIn('slow')
					.delay(1000).fadeOut('slow', function(){
						$('#NewTicket').load("NewTicket.php").fadeIn('slow');
													Reload();
					});
				}	
				else if (response == '2'){
$("#NewTicket").html('<p id="resuccess">Ticket #<strong>'+ $TicketNumber +' </strong>has been added back into the Open Queue successfully! <br>'+
'<sub>This module will automatically refresh in six seconds. </sub></p>')
					.fadeIn('slow')
					.delay(6000)
					.fadeOut('slow', function(){
				$('#NewTicket').load("NewTicket.php").fadeIn('slow');
													Reload();
					});
				}
		}		//End Sucess: function
	});
		return false;		// Return False to ensure the page does not refresh while sending the request to update the ticket database.
	});
		
	
/*		Bind the ESC key to run the scripted function to reload the database 	*/
	$(document).keyup(function(e) {
		if (e.keyCode == 27) { 
			Reload();
		}  
	});				
		
/* 	Notification script for use with dbb.php when events trigger by user action.
*	Creates a div with inner html using data from $_POST to pop a message up to a user that removes a ticket from the queue.
*		Future project: 	combine Node.js to broadcast the notify function to all users when a ticket is removed. This will require research to preserve data
* 									being fed into the generated div, making the function global should be a good start.
*/

function addNotice(notice){
	$('<div class="notice"></div>')
		.append('<div class="skin"></div>')
		.append('<b class="Gclose" title="Close Notice">x</b>')
		.append($('<div class="content"></div>').html($(notice)) )
		.hide()
		.appendTo('#growl')
		.fadeTo('slow', 0.33)
	    .animate({
			top: '-=405',
			opacity: '0.8',
			left: '-10',
			}, 1500);
	$('.notice').fadeOut(4500);
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
	$('#del').live("click", function () {
		  id = $(this).parent().parent().attr('id');
		  userid = '&user=' + $USER;
		  data = 'id=' + id + userid; 
		  parent = $(this).parent().parent();
		
				$('#removal').dialog('open');
					$('.talk').html('<p> Are you sure you want to remove Ticket <u>#<b>'+ id +' </b></u>? </p>');
			return false;
			});

		$('#removal').dialog({
			autoOpen: false,
			height: 225,
			width: 325,
			modal: true,
			title: 'Are you sure, '+ $USER +'?', 		/*	 <img src="icon_trashLine.png" height="25px" width="25px"  /> 	*/
			resizeable: false,
			closeOnEscape: true,
			buttons: {
				Okay: function() {	
						 
						$.ajax({
								type: "POST",
								url: "delete_row.php?",
								data: data,
								cache: false,
								error: function() {
								addNotice("<p>Failed to remove ticket "+ id +". <br> Please refresh the page and try again.</p>");
								},
								success: function () {
											parent.fadeOut(1500, function () {
										$(this).remove();
									});
							},
								complete:	function() {	 
										$('#table').fadeOut(1000, function() {
												$('#Database').load('dbb.php').fadeIn('slow');
										});
								}
						});
						$(this).dialog('close');
							addNotice("<p>"+ $USER +" successfully removed Ticket # "+ id +"! </p>");
					},
				Cancel: function() {
					$(this).dialog('close');
						setTimeout('window.location.reload()', 50); 
				}
			}
	});
		 
			 $('#growl')
				.find('.Gclose')
				.live("click", function() {
					$(this).closest('.notice')
						.fadeOut(850);
						return false;
			});
			
			setInterval( function() {
				Reload();
			},  555555);

			setInterval( function() {
				f();
			}, 1111111);
				$('#tacWeather').draggable();
				

/*
*	Styling functions:
*		use cookies and determine if a cookie is present for the theme styling. If no theme cookie exists, the default 'tacalert.css' will be used. The CSS 
*		themes should all begin with the normalize.css and the corresponding jqueryUI.css to include styled UI elements in use [buttons, input, animations, etc].
*		When applied, the #Style div will roll up and the DB should automatically reload. The page should not refresh unless clicking the "Default Theme" button, 
*		which will roll the page back to tacalert.css and clear the theme cookie.
*					Consider accessing additional divs that aren't used in other themes. 
*/				
	$("#Style a").click(function() { 
		$('table#delTable tr:odd').addClass('tblOclr');
		$('table#delTable tr:even').addClass('tblEclr');
		$('table#delTable tr:first').addClass('tblFclr');
		$('table#delTable td').addClass('tblbrdr');
		$("link").attr("href",$(this).attr('rel'));
		$.cookie("theme",$(this).attr('rel'), {expires: 9999, path: '/'});
			Reload();
		return false;
	});
		// The Kill button will eliminate the theme and force the page to reload with the default CSS applied.
			//The Kill button will also delete the cookie stored for which theme is in use. This applies to the Accordion AND Tabs layout.
		
	$("#kill").live('click', function(){
		$('table#delTable tr:odd').removeClass('tblOclr');
		$('table#delTable tr:even').removeClass('tblEclr');
		$('table#delTable tr:first').removeClass('tblFclr');
		$('table#delTable td').removeClass('tblbrdr');
		$.cookie("theme", null);
		setTimeout('window.location.reload()', 10);
			});
	
	/* ***	*	Google WebFont Archive 	*
	http://fonts.googleapis.com/css?family=Press+Start+2P|Noticia+Text|Cabin|Cabin+Condensed|Lato|Istok+Web|Source+Sans+Pro|Droid+Sans|Cantora+One|Electrolize|Ubuntu|Oswald|Share|Open+Sans|Dosis|Oxygen|UnifrakturCook
*	***	*/

var theme = $.cookie('theme');


if($.cookie("theme")) {
	$("link").attr({
		href: $.cookie("theme"),
		rel: "stylesheet",
		type: "text/css"
	});
	}
	
  WebFontConfig = {
    google: { families: [ 'Source+Sans+Pro::latin', 'Lato::latin', 'Cantora+One::latin', 'Cabin+Condensed::latin', 'Istok+Web::latin', 'Ubuntu::latin', 'Open+Sans::latin', 'Share::latin', 'Electrolize::latin', 'Noticia+Text::latin', 'Oswald::latin', 'Press+Start+2P::latin', 'Dosis:400,600:latin', 'UnifrakturCook:700:latin', 'Oxygen::latin', 'PT+Serif+Caption::latin' ] }
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


		console.log("Completed script loading!");
}); //end Document.Ready(); //

}); // End Head.READY(); //
</script>		
<div id="tacWeather"></div>
<div id="sunny"></div>
	</body>
</html>