/*global $:false, Favico:false, document:false, window:false, console:false, setInterval:false, localStorage:false, weatherMan:false, pgLoad:false, IP:false, date:false, event:false */ 

function Notify() {
 $RowCounts = $("#delTable tr").length;
 $COUNT = parseInt( ($RowCounts - 1), 10);	
 favicon = new Favico({
 "type" : "rectangle",
 "bgColor" : '#FADC00',
 "textColor" : '#000000',
 animation: "popFade"
 });
favicon.badge($COUNT);
}			

function RefreshAlerts() {
$('#Alerts').fadeOut();
$('#Alerts').load('viewFetch.php')
.slideDown( 
{
  'direction' : 'up'
}, 'slow');
new Notify();
}

function f() {
    window.location.reload(); 
}


function Reload() { 
$('#delTable').fadeOut(800, function() {
    $(this).html('<p><div id="foo" class="ajaxloader"> </div></p>').fadeIn(600);
 });
    $('#Database').fadeOut(800, function() {
	$('.off-canvas-wrap').removeClass('move-right');
      $(this).load("dbb.php", function() {
      }).fadeIn(600);
    });
new RefreshAlerts();
$('#TicketWindow').foundation('reveal', 'close');
}


 //  Set up variables to report Date and Time in console.log()    //
var getTime = function() {
    var d = new Date(), curr_hour = d.getHours(), minute = d.getMinutes();
      if( d.getHours() > 12) {
         curr_hour = curr_hour - 12;
      } if( curr_hour < 12 ){
         hours = curr_hour;
        }  var hours = curr_hour;
   
      if (minute.toString().length < 2){
          minute = "0" + minute;
      } var minutes = minute;

  return  hours +":"+ minutes;	 
};

// Construct a timer to refresh the DB without needing the user to hit F5 //

    function startTimer (){
      timer = setInterval(Continue, 250000);
      pgTimer = setInterval(pgLoad, 750000);
        console.log('Timer started. '+ getTime() );
    }
    
    function stopTimer (){
      clearInterval( timer );
      console.log('DB Refresh Timer stopped. '+ getTime() );
    }	
   
	function Continue (){
	new stopTimer();
      console.log('DB Refreshed. '+ getTime() ); 
        new Reload(); 
	new startTimer();
    }
   function pgLoad (){
      console.log('Page Reloaded. '+ getTime() ); 
      new f(); 
    }	

function weatherMan(){
  var URL = "weatherMan.json";
//  var URL = "http://api.wunderground.com/api/f4de0ee4ffd72094/geolookup/conditions/q/IL/Chicago.json?callback=?",
//      JSONcache = JSON.parse(sessionStorage.getItem('JSONcache'));
//  if (!JSONcache){

    $.getJSON(URL, function() {
//   console.log("weatherMan() generating report...");
    })
    .done(function(parsed_json) {
        var pattern=  new RegExp("^(.{26})([a-z])"), 
	    temperF = parsed_json.current_observation.temp_f, 
	    humidity = parsed_json.current_observation.relative_humidity, 
	    Wreport = parsed_json.current_observation.weather, 
	    time = parsed_json.current_observation.observation_time, 
	    Icon = parsed_json.current_observation.icon_url, 
	    IconURL = Icon.replace(pattern, "$1h"), 
	    htmlString = "<span class='small-4 left'><img id='wIcon' src='"+ IconURL +"' /><h4 id='temp'>" + temperF +    "<sup>&deg;</sup></h4></span><span id='wReport' class='small-4'><h7 class='subheader'>Humidity: <b id='humid'>"+ humidity +"</b> | <strong>"+ Wreport +".</strong><small id='time' class='left'>"+ time +"</small></h7></span>";
   $('#Weather').html(htmlString).fadeIn(900); 
// JSONcache = sessionStorage.setItem('JSONcache', JSON.stringify(htmlString));
    })
    .fail(function(){
        $('#Weather').empty().html("<b>Sorry</b>, something's not quite right here.");
      })
    .always(function(){
    console.log("weatherMan() has completed updating.");
    });
  }
//  else {
//  htmlString = JSONcache;
//     $('#Weather').html(htmlString).fadeIn(900); 
//  }

 
function checked() {

var name = "<?php echo $MyLogin ?>", IP = "<?php echo $_SERVER['REMOTE_ADDR']; ?>", PASS = "<?php echo $MyPass ?>";	
// REMOVED $.COOKIE TO REDUCE PLUGIN LOADS. LOCALSTORAGE WILL CONTAIN A COOKIE OF LOGIN PROPERTIES //

     $("#auto").on('change', function() {
       var value = $(this).prop("checked") ? 'true' : 'false';
         if( value === 'true'){
                $('#myusername').val(name);
                $('#mypassword').val(PASS);
                localStorage.setItem("User", name);
				localStorage.setItem("Pass", PASS);
		} else{
                var inputName= $('#myusername').val();
                var inputPass= $('#mypassword').val();
                      localStorage.setItem("User", inputName);
                      localStorage.setItem("Pass", inputPass);
		  }
     });	
}

// Get Browser-Specifc Prefix
function getBrowserPrefix() {
   
  // Check for the unprefixed property.
  if ('hidden' in document) {
    return null;
  }
 
  // All the possible prefixes.
  var browserPrefixes = ['moz', 'ms', 'o', 'webkit'];
 
  for (var i = 0; i < browserPrefixes.length; i++) {
    var prefix = browserPrefixes[i] + 'Hidden';
    if (prefix in document) {
      return browserPrefixes[i];
    }
  }
 
  // The API is not supported in browser.
  return null;
}
 
// Get Browser Specific Hidden Property
function hiddenProperty(prefix) {
  if (prefix) {
    return prefix + 'Hidden';
  } else {
    return 'hidden';
  }
}
 
// Get Browser Specific Visibility State
function visibilityState(prefix) {
  if (prefix) {
    return prefix + 'VisibilityState';
  } else {
    return 'visibilityState';
  }
}
 
// Get Browser Specific Event
function visibilityEvent(prefix) {
  if (prefix) {
    return prefix + 'visibilitychange';
  } else {
    return 'visibilitychange';
  }
}


// ::BROWSER TAB ONFOCUS EVENT::

// Get Browser Prefix
var prefix = getBrowserPrefix(), hidden = hiddenProperty(prefix), visibilityState = visibilityState(prefix), visibilityEvent = visibilityEvent(prefix);
 
document.addEventListener(visibilityEvent, function(event) {
  if (!document[hidden]) {
    new Continue();
  } else {
     new stopTimer();
  }
});
/* 

*** END FUNCTION DECLARATIONS ***

*/
 
    $(document).foundation({
          alert: {
            animation_speed: 500,
            animation: 'fadeOut'
          },
          abide: {
            live_validate : true,
            focus_on_invalid : true,
            timeout : 1000
         }
        }); 
		
$(document).ready(function () {"use strict";
     var $USER = $("#username").text(), $RowCounts = $("#delTable tr").length, $COUNT = parseInt( ($RowCounts - 1), 10); 
	 var id, userid, data, parent, site = null; 
    new weatherMan();

    new startTimer();
	
  var favicon = new Favico({
    "type" : "rectangle",
    "bgColor" : '#FADC00',
    "textColor" : '#000000',
    animation: "popFade"
  });
  favicon.badge($COUNT);
	
    $(document).on("click", "#auto", function(){
        new checked();
	});

var cookie = localStorage.getItem("style");
if(cookie) {
    $("link.theme").attr("href",cookie);
}
if(cookie === null) {
	$("link.theme").attr("href", "css/production.css");
	
}

$(document).keyup(function(e) {
if (e.keyCode == 27) { 
    new Continue();
console.log('Manual DB refresh call @ ' + getTime());	
}  
});  

  $(document).keyup(function(e) {
    if (e.keyCode == 192) { 
      $('.off-canvas-wrap').toggleClass('move-right');
    }  
  });    

  $(document).on("click","#all_clear", function() {
    $(this).hide("explode", 1000 ).remove();
    new Reload();
      console.log('Manual DB refresh call @ ' + getTime());
  });

$(document).on("click","#SubButton", function() {
var $Priority =  $("input:radio[name=priority]:checked").val(),
    $TicketNumber = $("#TicketNumber").val(),
    $SiteID = $("#SiteName").val(),
    $Comments = $("#comments").val(),
    $tCreator = $("#username").text(),
    $cPreference = $("#cPreference option:selected").text(),
    $dataString = 'ticket='+ $TicketNumber +'&siteName='+ $SiteID +'&priority='+ $Priority +'&Comments='+ $Comments +'&Creator=' + $tCreator +'&ContactPref=' + $cPreference;

$.ajax({
type: "POST",
url:  "insertPDO.php",
data: $dataString, 
  success: function(response){
    if (response == '1'){
        $("#NTicket").html('<p id="success" class="centered text-center"><b>Awesome!</b><br> <img src="loadinganimation.gif" /> <br> You posted Ticket #' + $TicketNumber +'! <br> Let\'s refresh the Database.</p>').fadeIn('slow')
          .delay(1000).fadeOut('slow', function(){
             $('#NTicket').load("NTicket.php").fadeIn('slow');
           new Reload();
     });
    } else if (response == '2'){
      $("#NTicket").html('<p id="resuccess">Ticket #<strong>'+ $TicketNumber +
      ' </strong>has been added back into the Open Queue successfully! <br>'+
      '<sub>This module will automatically refresh in six seconds.</sub></p>')
        .fadeIn('slow').delay(6000).fadeOut('slow', function(){
     $('#NTicket').load("NTicket.php").fadeIn('slow');
       new Reload();
     });
    }
  }
});
return false;
});
	

$(document).on("click","#del", function () {
  id = $(this).parent().parent().attr('id');
  userid = '&user=' + $USER;
 data = 'id=' + id + userid; 
  parent = $(this).parent().parent();
  site = $('#delTable').find('tr[id^='+id+'] td:nth-child(6)').text();
    $('#removal').dialog('open');
    $('.talk').html('<p> Are you sure you want to remove Ticket <u>#<b>'+ id +' </b></u>? </p>');
    return false;
    });

$('#removal').dialog({
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
    url: "delete_row.php?",
    data: data,
    cache: false,
    error: function() {
     console.log("<p>Failed to remove ticket "+ id +". <br> Please refresh the page and try again.</p>");
    },
   success: function () {
     $(this).parent().parent().fadeOut(1500, function () {
     $(this).remove();
     console.log('Ticket #'+ id +' for '+ site +' was removed from the open queue');
     });
   },
   complete:function() {
     $('#table').fadeOut(1000, function() {
       $('#Database').load("dbb.php").fadeIn('slow');
     });
     new RefreshAlerts();
   }
  });
    $(this).dialog('close');
//    addNotice("<p>"+ $USER +" successfully removed <br>Ticket # "+ id +" for "+ site +"! </p>"); // -- Removed 7/9/14
    },
    Cancel: function() {
    $(this).dialog('close');
    window.location.reload(); 
    }
  }
});
 
$('#Alerts').load("viewFetch.php").slideDown( {'direction': 'up'},'slow');

   
   $("#Database").load("dbb.php", function() { new RefreshAlerts(); });

    $("#TSearch").load("tick2stats.php", function() { 
      $("#datepicker").datepicker(); 
	});
    $("#NTicket").load("new_ticket.php", function(){
      $("#buttonDiv").buttonset();	
	});
    $('#Whois').load("WhoisLogged.php");
    $('#ETicket').load("eTicket.php");
    $('#Log-in').load("TLogin.php");


  $(document).on("click", ".themes a", function() {
   $("link").attr("href",$(this).attr('rel'));
    var title= $(this).attr('rel');
  //   var styleSheet = localStorage.setItem("style", title);
  localStorage.setItem("style", title);
  console.log("Theme changed to: "+ title +" at "+ getTime());
      new Continue();
  });

});
