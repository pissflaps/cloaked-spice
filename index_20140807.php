<!DOCTYPE html>
<?php require('TAC_Userlink.php'); ?>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
    <title>TAC's Alert System</title>
  <!-- // Style sheets loaded in succession for structure elements and button layout configuration --> 
  <link rel="stylesheet" type="text/css" href="css/production.css" class="theme">
  
</head>

<body>
<div id="BodyWrapper" class="off-canvas-wrap" data-offcanvas>
<!-- // BodyWrapper contains the entire site's content. We wrap it in this container so that the inner-wrap section
     // can contain the off-canvas side bar elements without displaying on page load. -->

<div class="fixed">
  <nav class="top-bar" data-topbar>
     <ul class="title-area">
    <li class="name" id="navExpand">
      <h1><a class="left-off-canvas-toggle" title="Expand the Quick Links"><i id="Hamburger" class="fi-list"></i> TAC Alert</a></h1>	  
    </li>
  </ul>
  <!-- // BEGIN TopBar section -->
  <section class="top-bar-section"> 

    <!-- // Right Nav Section -->
    <ul class="right">
	    <li class="has-dropdown">
<a href="#" data-dropdown="drop"><i class="fi-paint-bucket"></i> Theme</a>
<ul id="drop" class="dropdown" data-dropdown-content>
   <li class="themes"><a href="#" rel="css/production.css" id="main" class="text-center">Default</a></li>
<!--   // Removed 6-16-14   	<li class="themes"><a href="#" rel="css/snowtheme.css" id="snow" class="text-center">Snow'din</a></li> 	<li class="themes"><a href="#" rel="css/gridtheme.css" id="grid" class="text-center">Gridlock</a></li>	<li class="themes"><a href="#" rel="css/ISItheme.css" id="ISItheme" class="text-center">I S I</a></li>	-->
   <li class="themes"><a href="#" rel="css/Chai.css" id="Chaitheme" class="text-center">AfternoonChai</a></li>
   <li class="themes"><a href="#" rel="css/AspirinC.css" id="AspirinC" class="text-center">AspirinC</a></li>
   <li class="themes"><a href="#" rel="css/BVintage.css" id="BVintage" class="text-center">BVintage</a></li>
   <li class="themes"><a href="#" rel="css/CS04.css" id="CS04" class="text-center">CS04</a></li>
   <li class="themes"><a href="#" rel="css/FrankLloydWright.css" id="FrankLloydWright" class="text-center">FrankLloydWright</a></li>
   <li class="themes"><a href="#" rel="css/Gettysburg.css" id="Gettysburg" class="text-center">Gettysburg</a></li>
   <li class="themes"><a href="#" rel="css/JapaneseGarden.css" id="JapaneseGarden" class="text-center">JapaneseGarden</a></li>
   <li class="themes"><a href="#" rel="css/SilentG.css" id="SilentG" class="text-center">SilentG</a></li>
   <li class="themes"><a href="#" rel="css/SunSplash.css" id="SunSplash" class="text-center">SunSplash</a></li>
   <li class="themes"><a href="#" rel="css/Watermelon.css" id="Watermelon" class="text-center">Watermelon</a></li>
   <li class="themes"><a href="#" rel="css/yospos.css" id="YOSPOS" class="text-center">Y.O.S.P.O.S.</a></li>
</ul> 
    </li>
      <li class="has-form"><a id="UserLink" data-tooltip class="has-tip tip-bottom radius" title="Toggle your login status.">Logged in:</a></li>
      <?php echo $UserLink;?>
    </ul>


    <!-- // Left Nav Section -->
<span class="row">
<div class="icon-bar three-up small-3 columns"><h6> 
<a class="item" data-reveal-id="TicketWindow" data-reveal id="oTicketModal"> 
<i class="fi-page-add"> </i>
<label>New Ticket</label> </a> 

<a class="item" data-reveal-id="TicketSearch" data-reveal> 
<i class="fi-magnifying-glass"> </i>
<label>Search Tickets</label> </a> 

<a class="item" data-reveal-id="EditTickets" data-reveal> 
<i class="fi-pencil"></i>
<label>Edit Ticket</label> </a></h6> </div>
<ul class="left">
   <li id="tacWeather" class="has-form">
	  <span id="Wcontainer" class="small-5">
          <div id="Weather" class="row"><p></p></div>
	  </span>
  </li>
    </ul> 
</span>	
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
  	 <div class="small-2 columns">
      <span class="prefix"><i class="fi-magnifying-glass"></i></span>
    </div>
    <div class="medium-8 columns">	<!-- // Wiki Search using Sphinx - taken from legacy TACALERT code -->
	  <form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' id='WikiForm' method='get' name='wSearch' target='_new'>
         <input id='sValue' name='title' type='hidden' value='Special:SphinxSearch'> 
         <input id='search_text' maxlength='150' name='sphinxsearch' placeholder='Search the Wiki' tabindex='1' type='search'> 
       </div>  
      <div class="small-2 columns" >
        <input name='Search_Wiki' id='search_button' name='fulltext' type='submit' value='Go' class="button postfix" >  </form>
      </div>
  </div>
</div> <!-- // END Search Container -->
</li>
    <li><a href="http://tac-wiki/wiki/index.php" title="TAC's Wiki knowledgebase" target="_NEW"><i class="fi-info"></i> TAC Wikibase</a> </li>
    <li><a href="http://tac-alert01/attach.php" title="Attach Files to Tickets" target="_NEW"><i class="fi-upload"></i> TAC Ticket Attachments </a> </li>
    <li><a href="http://tac-alert01/attachments.php" title="Attachment File Listing" target="_NEW"><i class="fi-list-thumbnails"></i> Attachment Listing </a> </li>
    <li><a href="http://tac-alert01/CDRMS.php" title="Navigate CDRMS Servers!" target="_NEW"><i class="fi-database"></i> CDRMS Server Locator</a> </li>
    <li><a href="https://isi-info.webex.com/mw0401l/mywebex/default.do?siteurl=isi-info&service=9" title="Start a WebEx Support Session" target="_NEW"><i class="fi-telephone"></i> WebEx Support Center</a> </li>
    <li><a href="http://thesource.isi-info.com"  title="The Source" target="_NEW"><i class="fi-bookmark"></i> ISI's The Source</a> </li>
    <li><a href="http://badger/EngWiki/Default.aspx" title="Engineering Wiki on Badger" target="_new"><i class="fi-lightbulb"></i> The Engineering Wiki</a> </li>
    <li><a href="http://tac-alert01/tickadd.php" title="Add a Ticket back into the Queue" target="_NEW"><i class="fi-ticket"></i> TAC's Ticket Adder</a> </li>
    <li><a href="http://tac-alert01/tbyc.php" title="Ticket Creation Statistics" target="_NEW"><i class="fi-results-demographics"></i> Search Tickets by Creator</a> </li>
    <li><a href="http://tac-alert01/search.php" title="Ticket  Search by Client" target="_NEW"><i class="fi-results"></i> Search Tickets by Customer</a> </li>
  </ul>
</aside>

<div id="DBContainer" class="large-9 columns centered text-center" >
	  <div id="Database" class="large-12 centered">
    <!-- // Database now inserted via jQuery .load() function in TACALERT.JS -->
	  </div>
</div>

<!-- // Modal Window targets, triggered by buttons in TopBar.
     // These are hidden on PageLoad and activated via the triggers -->
<div id="TicketWindow" class="tiny reveal-modal" data-reveal>
    <div id="NTicket"></div>
  <a class="close-reveal-modal">&#215;</a>
</div>

<div id="EditTickets" class="tiny reveal-modal" data-reveal>
    <div id="ETicket"></div>
  <a class="close-reveal-modal">&#215;</a>
</div>

<div id="TicketSearch" class="tiny reveal-modal" data-reveal>
    <div id="TSearch"></div>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="TacLogin" class="tiny reveal-modal" data-reveal>
    <div id="Log-in"></div>
  <a class="close-reveal-modal">&#215;</a>
</div>
	 
  </div>
</div>
<div id="ISI"><img src="img/ISI_ex150.gif" border="0" /></div>
<!-- //Begin Footer -->
  <footer id="Footer"> 
    <section>
	  <div class="right">
	    <div id="Whois" data-alert class="radius">
		</div> 
      </div>
	    <div >
		  <div id="Alerts" data-alert class="radius">
		  </div>
	    </div>
	  </section>
  </footer>
  <!-- //END Footer -->
  
  <!-- //Begin Modal and Dialog Windows -->
<div id="notice"></div>	  
<div id='removal' title='Are you sure?' class='talk'> </div>
	
  <!-- //END Modal & Dialog Window structures -->
  <!-- //Username Div is used for following PHP variables through Javascript -->
  <div id="username" style="color:transparent;background:transparent;"><?php echo $login;?></div>

  
  <!-- // Per the FOUNDATION docs, load all external libraries near the end of BODY in the DOM -->
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
  <!-- // Foundation.min contains all modules in the event of expansion being needed into other library functions -->
<script type="text/javascript" src="Foundation/Tables/responsive-tables.js"></script>
  <!-- // Responsive Tables Plug-in provided by Foundation Framework // -->
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