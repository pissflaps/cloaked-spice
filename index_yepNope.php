<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en">
<head>
 <script type="text/javascript" src="js/yepnope.js"></script>
<?php
    require_once( "session.php"); 
    require_once( "database.php"); 
?>

 <link rel="shortcut icon" href="favicon.ico" type="image/png">	
<script type="text/javascript">
yepnope([{
  load: 'preload!jQuery/jquery-1.9.1.js',
  callback: function (url, result, key) {
    console.log('jQuery!');
  }
},{
  load: 'dist/html5shiv.js',
  callback: function (url, result, key) {
    console.log('html5shiv!');
  }
}, 
 {
  load: 'jQuery/jquery-ui-1.10.3/ui/jquery-ui.js',
  callback: function (url, result, key) {
    console.log('jQueryUI!');
  }
},
 {
  load: 'js/favico.js',
  callback: function (url, result, key) {
    console.log('favico!');
  }
},
{
  load: 'js/spin.min.js',
  callback: function (url, result, key) {
    console.log('spin.min!');
  }
},
{
  load: 'js/jquery.cookie.js',
  callback: function (url, result, key) {
    console.log('jscookies!');
  }
},
{
  load: 'js/jquery.form.js',
  callback: function (url, result, key) {
    console.log('jsforms!');
  }
},{
  load: 'js/tacalert2.js',
  callback: function (url, result, key) {
    console.log('tacalert!');
  }
}
]);

</script>


<link type="text/css" rel="Default stylesheet" href="css/MicroSop.css" title="MicroSop" />

  <title>Tac's Alert System</title>
  
   
</head>
<body class='metrouicss'>
<header>
    <nav id="firstlinks">
		<ul id="globalnav">	
			<li id="epple" title="Mock Apple!"> 
			</li>
			<li id="open" title="Open a new ticket." class="AWESOME"><br>
					<br><sub>New Ticket</sub>
			</li>
			<li id="tEdit" title="Edit Tickets in Real-time!" class="AWESOME"><br>
				<br><sub>Edit Tickets</sub> 
			</li>
			<li id="Stats" title="Generate Ticket Statistics." class="AWESOME"><br>
				<br><sub>Search Tickets</sub>
			</li>
			<li id="links" title="Get where you need to be." class="AWESOME"><br>
				<br><sub>Quick Links</sub>
			</li>
			<li id="Themes" title="Update TAC Alert Style." class="AWESOME"><br>
				<br><sub>Themes</sub>
			</li>
			<li id="Tweather" title="How's the weather?" class="AWESOME"><br>
				<br><sub>Weather</sub>
			</li>
			<li id="search">
                        <div id="spaceme">

				<form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' id='WikiForm' method='get' name='wSearch' target='_new'>
                <input id='sValue' name='title' type='hidden' value='Special:SphinxSearch'> 
				<input class='search' id='search_text' maxlength='150' name='sphinxsearch' placeholder='Search the Wiki' tabindex='5' type='search'>
					<button id='search_button' name='fulltext' type='submit' value='Search'></button>
                            </form>
                        </div>
                </li>
            </ul>
        </nav>

<div id="loginout"><?php require("AlertLogin.php"); ?>
<UL id="panel">		
					<li id="NewTicket"></li>
					<li id="linx"></li>
					<li id="eTicket"></li>
					<li id="tStat"></li>
						<li id="Style">	
					<UL class="themes"> 
						<li class="themes"><a href="#"  rel="css/Vader.css" id="Vader">Vader</a> | </li> 
						<li class="themes"><a href="#"  rel="css/tacalert.css" id="TACalert">TAC Alert</a> |  </li> 
						<li class="themes"><a href="#"  rel="css/ExciteBike.css" id="Excite">Excite Bike</a>  |  </li> 
						<li class="themes"><a href="#"  rel="css/Darkness.css" id="Darkness">Darkness</a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/Mario.css" id="Mario">Mario Twins</a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/ISI.css" id="ISItheme">ISI </a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/Professional.css" id="Professional">Pro-Fession</a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/FYAD.css" id="FYAD"> FYAD </a>  |   </li> 
						<li class="themes"><a href="#"  rel="css/python.css" id="python"> python </a>  |   </li> 
                        <li class="themes"><a href="#"  rel="css/epple.css" id="Epple">Epple</a> </li> 
					</UL>
					<button name="killtheme" id="kill" value="" style="float:right">Default Theme</button> 	
						</li>
					</UL>
	</div>
</header>
<br>
			<div id="Database">

	</div>

<div id='dialog' title='Email Recipients' class='talk'></div>
<div id="growl"></div>	
<div id="notice"></div>	
<div id='removal' title='Are you sure?' class='talk'> </div>
	<div id="ISI"><img src="img/ISI_ex150.gif" border="0" /></div>

		<div id="Alerts"></div>
		<div id="Whois"></div>
	
<div id="tacWeather"></div>

<div id="username" style="color:transparent;background:transparent;">
<?php 
	if(! isset($_SESSION["myusername"])) {
			$login = $_COOKIE["LoggedInAs"];
				if(empty($_COOKIE["LoggedInAs"]) ){
					$login = $_SERVER["REMOTE_ADDR"];
				}
	}
		else{
			$login = $_SESSION["myusername"];
		}
echo $login; 
?>
</div>

<script type="text/javascript" src="js/tacalert.js"></script>
</body>
</html>