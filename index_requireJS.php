<!DOCTYPE  html>
<meta http-equiv="x-ua-compatible" content="IE=9">
<meta charset="utf-8">
<html lang="en">
<head>
<?php 
		require_once( "session.php"); 
		require_once( "database.php"); 
?>

<script>
  require.config({
    paths: {
        "js": "js/"
    },
    waitSeconds: 15
  });
  require( ["js/jquery-1.8.3.min", "js/jquery-ui-1.9.2.custom.min", "js/bootstrap", "js/jquery.cookie", "js/jquery.form", "js/jquery.spin.min", "js/modernizr"] );
</script>
<script src="js/require.js"></script>


<title>Tac's Alert System</title>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link type="text/css" rel="stylesheet" href="css/tacalert.css" >
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
						<li class="themes"><a href="#"  rel="css/Aquaman.css" id="Aquaman">AquaMan</a> </li> 						
					</UL>
						<!--			
	* *	 These are excluded themes due to compatability with the new layout structure 	::	 use as reference ONLY 	* *
						<a href="#"  rel="css/snow.css" id="snow">SnowDay</a>  | 
						  <a href="#" rel="css/fbook/jquery-fbook.css" id="fbook">f-book</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
						  <a href="#"  rel="css/ICS/jquery-ICS.css" id="ICS">Ice Cream Sammy</a>&nbsp;&nbsp;|&nbsp;&nbsp; 	
						  <a href="#"  rel="css/Jurassic.css" id="Jurassic">Jurassic Park</a>  |   
						  <a href="#"  rel="css/sunny.css" id="sunny">Sunny</a>    
						  <a href="#"  rel="css/Flickr.css" id="Flickr">Flickr</a>  |   
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
			
	
<div id="tacWeather"></div>
<div id="sunny"></div>

<script type="text/javascript" src="js/TACALERT.js"> </script>	
	</body>
</html>