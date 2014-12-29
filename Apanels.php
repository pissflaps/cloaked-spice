<!DOCTYPE html>
<?php
    require_once( "session.php"); 
    require_once( "database.php"); 
	if(! isset($_SESSION["myusername"])) {
      $login = $_COOKIE["LoggedInAs"];
      $UserLink = '<li class="active"><a href="TACLogout.php" title="Log out of TAC Alert" class="success button expand"><i class="fi-torsos"></i> '. ucwords($_COOKIE["LoggedInAs"]) .' </a></li>';
        if(empty($_COOKIE["LoggedInAs"]) ){
          $login = $_SERVER["REMOTE_ADDR"];
          $_COOKIE["LoggedInAs"] = $_SERVER["REMOTE_ADDR"];
          $UserLink = '<li class="alert"><a href="#" title="Log in to TAC Alert" data-reveal-id="TacLogin" data-reveal class="alert button expand"><i class="fi-torsos"></i> '. $_SERVER["REMOTE_ADDR"] .'</a></li>';
        }
    }
        else{
          $login = $_SESSION["myusername"];
          $UserLink = '<li class="active"><a href="TACLogout.php" title="Log out of TAC Alert" class="success button expand"><i class="fi-torsos"></i> '. ucwords($_COOKIE["LoggedInAs"]) .' </a></li>';
		}
?>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
    <title>TAC's Alert System</title>
  <link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/production.css" type="text/css">
  <link rel="stylesheet" href="Foundation/css/foundation.css" type="text/css">
  <link rel="stylesheet" href="Foundation/icons/foundation-icons.css" type="text/css">
  <link rel="stylesheet" href="css/alert-panels.css" type="text/css">
  <!-- // Style sheets loaded in succession for structure elements and button layout configuration -->
</head>

<body>
<div id="BodyWrapper" class="off-canvas-wrap">
<!-- // BodyWrapper contains the entire site's content. We wrap it in this container so that the inner-wrap section
     // can contain the off-canvas side bar elements without displaying on page load. -->

<div class="fixed">
  <nav class="top-bar" data-topbar>
     <ul class="title-area">
    <li class="name">
      <h1><a class="left-off-canvas-toggle" title="Expand the Quick Links" >TAC Alert</a></h1>
    </li>
  </ul>
  <!-- // BEGIN TopBar section -->
  <section class="top-bar-section"> 
    <!-- // Right Nav Section -->
    <ul class="right">
 	<li class="divider"></li>
      <?php echo $UserLink;?>
    </ul>
    <!-- // Left Nav Section -->
    <ul class="left">
  <li class="divider"></li>

<!-- // Menu segment for  Modal windows (triggers) located in the TopBar section -->

<li><a href="#" data-reveal-id="TicketWindow" data-reveal class="button success expand" id="oTicketModal"><i class="fi-page-add"></i> New Ticket</a></li>
  <li class="divider"></li>
<li><a href="#" data-reveal-id="TicketSearch" data-reveal class="button secondary expand"><i class="fi-magnifying-glass"></i> Search Tickets</a></li>
  <li class="divider"></li>
<li><a href="#" data-reveal-id="EditTickets" data-reveal class="button alert expand"><i class="fi-clipboard-pencil"></i> Ticket Editor</a></li>  
  <li class="divider"></li>
<li><a href="#" id="Tweather" data-reveal-id="tacWeather"  data-reveal title="How is the weather?" class="button primary expand"><i class="fi-cloud"></i> Weather</a></li>
    </ul>
  </section>
  </nav>
</div> <!-- // END TopBar section -->

<!-- // OffCanvas Slider Content inner - wrap -->
<div id="SideBar" class="inner-wrap">
<aside class="left-off-canvas-menu">
  <ul class="off-canvas-list side-nav">
    <li><label>Quick Links</label></li>
	    <li class="has-form">
	<!-- // BEGIN Search Container -->
<div id="SearchContainer" class="medium-2 large-10 small-offset-1">
  <div class="row collapse">
  	 <div class="small-1 columns">
      <span class="prefix"><i class="fi-magnifying-glass"></i></span>
    </div>
    <div class="medium-9 columns">	<!-- // Wiki Search using Sphinx - taken from legacy TACALERT code -->
	  <form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' id='WikiForm' method='get' name='wSearch' target='_new'>
         <input id='sValue' name='title' type='hidden' value='Special:SphinxSearch'> 
         <input id='search_text' maxlength='150' name='sphinxsearch' placeholder='Search the Wiki' tabindex='5' type='search'> 
       </div>  
      <div class="small-2 columns" >
        <input name='Search_Wiki' id='search_button' name='fulltext' type='submit' value='Go' class="button postfix" >  </form>
      </div>
  </div>
</div> <!-- // END Search Container -->
</li>
    <li><a href="http://tac-wiki/wiki/index.php" title="TAC's Wiki knowledgebase" target="_NEW">TAC Wikibase</a></li>
    <li><a href="http://thesource.isi-info.com"  title="The Source"target="_NEW">ISI's The Source</a></li>
    <li><a href="http://tac-alert01/CDRMS.php" title="Navigate CDRMS Servers!" target="_NEW">CDRMS Server Locator</a></li>
    <li><a href="https://isi-info.webex.com/mw0401l/mywebex/default.do?siteurl=isi-info&service=9" title="Start a WebEx Support Session" target="_NEW">WebEx Support Center</a></li>
    <li><a href="http://badger/EngWiki/Default.aspx" title="Engineering Wiki on Badger" target="_new">The Engineering Wiki</a></li>
    <li><a href="http://tac-alert01/tickadd.php" title="Add a Ticket back into the Queue" target="_NEW">TAC's Ticket Adder</a></li>
    <li><a href="http://tac-alert01/tbyc.php" title="Ticket Creation Statistics" target="_NEW">Search Tickets by Creator</a></li>
  </ul>
</aside>

<div id="DBContainer" class="medium-9 large-offset-1 columns centered text-center" >
	  <div id="Database" class="centered text-center">
    <!-- // Database now inserted via jQuery .load() function in TACALERT.JS -->
	  </div>
</div>

<!-- // Modal Window targets, triggered by buttons in TopBar.
     // These are hidden on PageLoad and activated via the triggers -->
<div id="TicketWindow" class="tiny reveal-modal" data-reveal>
    <div id="NTicket"></div>
  <a class="close-reveal-modal"><i class="fi-x-circle"></i></a>
</div>

<div id="EditTickets" class="tiny reveal-modal" data-reveal>
    <div id="ETicket"></div>
  <a class="close-reveal-modal"><i class="fi-x-circle"></i></a>
</div>

<div id="TicketSearch" class="tiny reveal-modal" data-reveal>
    <div id="TSearch"></div>
  <a class="close-reveal-modal"><i class="fi-x-circle"></i></a>
</div>
<div id="TacLogin" class="tiny reveal-modal" data-reveal>
    <div id="Log-in"></div>
  <a class="close-reveal-modal"><i class="fi-x-circle"></i></a>
</div>
<!-- // Weather Modal Window Target.
     // Activated from #Tweather trigger in TopBar -->
<div id="tacWeather" class="tiny reveal-modal" data-reveal>
    <div id="Container">
	  <span id="Weather"></span>
    </div>
  <a class="close-reveal-modal"><i class="fi-x-circle"></i></a>
	</div>

  </div>
</div>

<!-- //Begin Footer -->
  <footer id="Footer"> 
    <section>
	  <div class="right">
	    <div id="Whois" class="alert-box secondary">
		</div> 
      </div>
	    <div class="left">
		  <div id="Alerts">
		  </div>
	    </div>
	  </section>
  </footer>
<div id="notice"></div>	  
<div id='removal' title='Are you sure?' class='talk'> </div>
  <div id="username" style="color:transparent;background:transparent;"><?php echo $login;?></div>
  <!-- // Per the FOUNDATION docs, load all external libraries near the end of BODY in the DOM -->
<script type="text/javascript" src="Foundation/Tables/responsive-tables.js"></script>
  <!-- // Responsive Tables Plug-in provided by Foundation Framework // -->
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
  <!-- // jQuery and Foundation frameworks apply before DOM load -->
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
  <!-- // Load Foundation vendor-specific library additions -->
<script type="text/javascript" src="js/jQuery_Plugins.js"></script>
<!-- // Compressed version of all related vendor plug-ins used in jQuery -->
  
<script src="js/TACALERT.js" type="text/javascript"></script>
<!-- // TACALERT will now contain a majority of the site's functions. Initialization of functions and elements is done below.
    //  *** MODIFY AT YOUR OWN RISK *** // -->
</body>
</html>