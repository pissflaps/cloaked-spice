<!DOCTYPE html>
<html ng-app="TacApp">
 <head>
 <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">      
<title> TAC Alert System - JSON test</title>

  <script src="js/Angular/Angular.js"></script>
  <script src="js/Angular/AngularUI/modules/utils.js"></script>
    <script src="js/Angular/TacJSON.js"></script>  

<!-- //
// Do not use until you have this understood	
//
//  <script src="js/Angular/Angular-route.js"></script>
//  <script src="js/Angular/Tacroutes.js"></script>
//
// These relate to the 'ngRoute' module 
// -->
  <script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
  <script src="Bootstrap/js/Bootstrap.js"></script>

  <link rel="stylesheet" href="Bootstrap/css/Bootstrap.css" type="text/css">
  <link rel="stylesheet" href="css/gumby.css" type="text/css">
  <link rel="stylesheet" href="css/jquery.fbook.css" type="text/css">

 <style>
	body{
		margin: 5px;
		padding: 10px;
	}
    #JSONdump{ 
	 padding: 5px;
	 clear:both;
	}
	#delTable{
	text-align: center;
	}
	#delTable tbody td{
	color: #212121;
	 display: table-cell;
	 text-align: center;
	}
	#JSONP{
	 position: fixed;
	 bottom: 5px;
	 right: 5px;
	 vertical-align: bottom;
	 padding: 5px;
	}
	#pCheck{
	position: fixed;
    left: 20px;
	bottom: 10px;
	margin: 10px;
	padding: 5px;
	}
	hr{
	 width: 50%;
	 margin-left: 20%;
	}
	#New_Ticket{
		background-color: rgba(200,200,200,.5);
		color: #212121;
		border: 5px solid rgba(0,0,0,.5);
		border-radius: 4px;
		max-width: 550px;
	}
	#ifram{
	 color: #212121;
     background: rgba(80,200,255,.5);
	 border: 0px;
	 max-height: 420px;
	 border-radius: 2px;
	 vertical-align: bottom;
	 padding: 10px;
	}

	#SearchForm{
	padding: 5px;
	clear:both;
	}
/*    
//  EXPERIMENTAL  //    

::-webkit-scrollbar {
    width: 12px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}	

*/
</style>  
 </head>

<body>
<nav role="navigation">
<ul class="nav nav-pills navbar-left navbar-fixed-top">
<li class="navbar-brand">TAC Alert</li>
<li ng-init="shouldShow = false" ng-click="shouldShow = !shouldShow"> <a href="#"><span class="glyphicon glyphicon-file"></span> New Ticket</a></li>
<li ng-init="shouldShow = false" ng-click="shouldShow = !shouldShow"><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Search Tickets</a></li>
<li ><a href="#"><span class="glyphicon glyphicon-wrench"></span> Edit Tickets</a></li>
<li ><a href="http://tac-wiki/wiki/"><span class="glyphicon glyphicon-th-large"></span> Wikibase</a></li>
<li ><a href="#" ng-init="loggedIn = false" ng-click="loggedIn = true" ng-hide="loggedIn"><span class="glyphicon glyphicon-user"></span> Login / LogOut</a></li>
<li ng-show="loggedIn" class="navbar-text"><?php include('AlertLogin.php'); ?> </li>
</ul>
  <form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' id='WikiForm' method='get' name='wSearch' target='_new' class="navbar-form navbar-right" role="search">
    <div class="form-group">
	 <input id='sValue' name='title' type='hidden' value='Special:SphinxSearch'> 
      <input  id='search_text' maxlength='150' name='sphinxsearch' type="text" class="form-control" placeholder="Search Wiki">
    </div>
    <button id='search_button' name='fulltext' type='submit' value='Search' type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Search</button>
  </form>
</nav>

<br>


<div id="SearchForm" class="form-group form-inline pull-left" >
    <div class="col-xs-5">
<input name="search" ng-model="query" class="form-control search-query" type="text" placeholder="Filter Tickets..">
</div>
  <label for="SortBy">Sort by:</label> 
    <select name="SortBy" ng-model="orderProp" class="form-control" ng-init="orderProp='Ticket'">
     <option value="Ticket" selected>Ticket</option>
     <option value="Date">Date</option>
     <option value="Priority">Priority</option>
     <option value="Stime">Start Time</option>
    </select>
</div>
 <br>
<div id='JSONdump' ng-controller="TacCtrl" ng-app="TacApp">
	<table id="delTable" class="table table-striped table-bordered" ng-controller="TacReload" ng-model="getAllTickets"> 
		<thead>
	<tr id="fields"><td>Ticket</td><td>Date</td><td>Start Time</td><td>E.T.A.</td><td>Priority</td><td>Site</td><td>Comments</td><td>Remove Ticket</td></tr>
		</thead>
  <tbody>
        <tr ng-repeat="ticket in Tickets | filter:query | orderBy:orderProp track by $index"  id="{{ticket.Ticket}}">
	<td><b>{{ticket.Ticket}}</b></td>	
	<td>{{ticket.Date}}</td>
	<td>{{ticket.Stime}}</td>
	<td>{{ticket.ETA}}</td>
	<td>{{ticket.Priority}}</td>
	<td>{{ticket.Site}}</td>
	<td>{{ticket.Comments}}</td>
	<td id="DelCel" ><a href="#" data="{{ticket.Ticket}}"><span id="del" class="glyphicon glyphicon-trash" title="Remove Ticket #{{ticket.Ticket}}"></span></a> </td>
        </tr>
  </tbody>
 
</table>
 
<hr>
  <div id="pCheck" class="checkbox">
    <h5><label for="showRaw"><input name="showRaw" type="checkbox" ng-model="onOff"> Raw Data</h5></label>
  </div>
	<div id="JSONP" ng-show="onOff"> 
		<span id="unParsed" class="container">
          <h4><i class="icon-thumbs-up"></i> Fully-Qualified JSON:</h4>
			<pre id="ifram" class="pre-scrollable">
			<?php include('PDO2JSON.PHP');?>
			</pre>
        </span>
		<?php   echo "<br><b>". $totalCount ." open tickets:</b><br>";?>
	</div>
	
  <div id="tRemoval">
	 <p class="talk"> 
	 <!-- // Are you sure you want to remove Ticket <u>#<b>{{ticket.Ticket}}</b></u>? // -->
	 </p>
<!-- 
<button class="btn btn-success">Remove</button> <button class="btn btn-danger" ng-click="Delete = !Delete">Cancel</button>
-->
  </div>		

  
  <div id="New_Ticket" ng-show="shouldShow" class="panel panel-primary form-horizontal">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
   <div class="panel-heading">Open A New Ticket </div>
  <div class="panel-body"> <form name="nTicketForm" role="form" class="pull-left">
  <div id="priority" class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary">
        <input type="radio" id="PRI2" value="2">2
  </label>
  <label class="btn btn-primary">
        <input type="radio" id="PRI4" value="4">4
  </label>
  <label class="btn btn-primary">
        <input type="radio" id="PRI9" value="9">9
  </label>
    </div>
	  <br>
	<div class="input-group">
       <span class="input-group-addon">#</span><input name="ticket" class="form-control" placeholder="Ticket Number" class="col-xs-3"></span>
    </div>
	  <br>
  <input name="site" class="form-control" placeholder="Site Name" class="col-xs-4">
    <br>
    <textarea name="comments" class="form-control" rows="2" placeholder="Comments"> </textarea>
	</form></div>
	<div class="panel-footer">
	  <button ng-click="shouldShow = !shouldShow" class="btn btn-success btn-medium">Submit</button>
	  <button ng-click="shouldShow = !shouldShow" class="btn btn-danger btn-medium">Cancel</button>
  </div>
 </div>
  
</body>

<script type="text/javascript">
$(document).ready(function() {
var $USER = "jim";
var id, userid, data, parent, site = null;				
   
$(document).on("click","#SubButton",  function() {
		var $TicketNumber = $("#TicketNumber").val();
		var $SiteID = $("#SiteName").val();
		var $Comments = $("#comments").val();
		var $tCreator = $("#username").text();
		var $cPreference = $("#cPreference option:selected").text();
		var $dataString = 'ticket='+ $TicketNumber +'&siteName='+ $SiteID +'&priority='+ $Priority +'&Comments='+ $Comments +'&Creator=' + $tCreator +'&ContactPref=' + $cPreference;
	$.ajax({
		url:  "null",
		type: "POST",
		data: $dataString, 
		success: function(response){
    if (response == '1'){
	//something happens!
    	}
    },	
    error: function(response){
	//something does not happen!
    	}
	});
		return false;
});

	$(document).on("click","#del", function () {
		var $USER = "jim";
		  id = $(this).parent().parent().parent().attr('id');
		  userid = '&user=' + $USER;
          data = 'id=' + id + userid; 
		  parent = $(this).parent().parent();
		  site = $('#delTable').find('tr[id^='+id+'] td:nth-child(6)').text();
    $('#tRemoval').dialog('open');
    	$('.talk').html('<p> Are you sure you want to remove Ticket <u>#<b>'+ id +' </b></u> for '+ site +'? </p>');
    return false;
    });

$('#tRemoval').dialog({
    autoOpen: false,
    height: 225,
    width: 325,
    modal: true,
    title: 'Are you sure, '+ $USER +'?', 		
    resizeable: false,
    closeOnEscape: true,
    buttons: {
    Okay: function() {	
    		$.ajax({
        type: "POST",
        url: "null",
		data: data,
        cache: false,
        error: function() {
        //ERROR
        },
        success: function () {
            $(this).parent().parent().fadeOut(1500, function () {
        		$(this).remove();
        		console.log('Ticket #'+ id +' for '+ site +' was removed from the open queue');
        	});
        },
        complete:	function() {	 
        		//FADE OUT CODE
        }
    		});
    		$(this).dialog('close');
    		//DO SOMETHING!
    	},
    Cancel: function() {
    	$(this).dialog('close');
    		setTimeout('window.location.reload()', 50); 
    }
   }
  });
  /*
    
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
    	$('#Themes').on("click", function(e) {
    		$('#Style').slideToggle('slow');
    		$('#NewTicket, #tStat, #linx, #eTicket').slideUp('slow');
        e.preventDefault();
    	});
    		$(document).on('click','#Tweather', function() {
			weatherMan();
        $('#tacWeather').load('TACweather.php').fadeIn(800);
			$.cookie("Weather", "On", {expires: 9999, path: '/'});
        });
    	$('#open, #links, #tEdit, #Stats, #Themes').on("click", function(){
    		$('#Database').toggle("drop");
    	});
 
	$('#NewTicket').load("NewTicket.php"); 
	$('#linx').load("links.php");		
	$('#eTicket').load("eTicket.php");	
	$('#tStat').load("tick2stats.php", function() { $("#datepicker").datepicker();$("button").button(); });	
 	$('#NewTicket, #linx, #eTicket, #tStat, #Style').hide();
	$('#unParsed pre').load('PDO2JSON.PHP');
  */

});	
</script>

</html>


<!-- //
// Legacy Alert System Login 
// header rests above the Database table
//
// Replace individual page-loads from jQuery
// to AngularJS with Partials.
// 
// -- snip --
//
<header>
<nav id="firstlinks">
		<ul id="globalnav" class="nav nav-tabs">	
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
			<li id="searchWiki">
                        <div id="spaceme" class="form-group">
				<form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' id='WikiForm' method='get' name='wSearch' target='_new' class="form-inline" >
                <input id='sValue' name='title' type='hidden' value='Special:SphinxSearch'> 
				<input class='input-medium' id='search_text' maxlength='150' name='sphinxsearch' placeholder='Search the Wiki' tabindex='5' type='search'>
					<button id='search_button' name='fulltext' type='submit' value='Search'></button>
                            </form>
                        </div>
                </li>
            </ul>

</nav>
<div id="loginout">			
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
						<li class="themes"><a href="#"  rel="css/MicroSop.css" id="MicroSop">Micro Sop </a>  |   </li> 
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
// 
// -->