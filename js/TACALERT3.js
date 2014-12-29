$(document).ready( function() {"use strict";
/*global $:false, Favico:false, document:false, Spinner:false, window:false, console:false, setInterval:false, $TicketNumber:false, $dataString:false */
new weatherMan();
var $USER = $("#username").text();
var id, userid, data, parent, site = null;

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
  
  var $RowCounts = $("#delTable tr").length;
  var $COUNT = parseInt( ($RowCounts - 1), 10);
    var favicon = new Favico({
"type" : "rectangle",
"bgColor" : '#FADC00',
"textColor" : '#000000',
   animation: "popFade"
    });
  favicon.badge($COUNT);

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
function apply() {
  $("button").button();
  $("#buttonDiv").buttonset();
  new Notify();
}

function RefreshAlerts() {
$('#Alerts').fadeOut()
.load('viewFetch.php')
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
    $(this).html('<p><div id="foo"> </div></p>').fadeIn(600);
var $Color = $("#Style a").css("color");
var opts = {
  lines: 10, 
  length: 45, 
  width: 6, 
  radius: 35,
  corners: 0.8,
  rotate: 8, 
  color: $Color,
  speed: 2.1, 
  trail: 75, 
  shadow: true, 
  hwaccel: false, 
  className: 'spinner', 
  zIndex: 2e9, 
  top: '10px', 
  left: '450px' 
};
var target = document.getElementById('foo');
var spinner = new Spinner(opts).spin(target);
 });
    $('#Database').fadeOut(800, function() {
      $(this).load("dbb.php", function() {
         apply(); 
      }).fadeIn(800);
    });
new RefreshAlerts();
$('#TicketWindow').foundation('reveal', 'close');
$('.off-canvas-wrap').removeClass('move-right');
}


function weatherMan(){
  $.ajax({
  url : "http://api.wunderground.com/api/f4de0ee4ffd72094/geolookup/conditions/q/IL/Chicago.json?callback=?",
  dataType : "jsonp",
  error : function(){
  $('#Weather').html("<b>Sorry</b>, something's not quite right here.");
   },
  success : function(parsed_json) {
  var location = parsed_json.location.city;
  var temperF = parsed_json.current_observation.temp_f;
  var temperC = parsed_json.current_observation.temp_c;
  var humidity = parsed_json.current_observation.relative_humidity;
  var Wreport = parsed_json.current_observation.weather;
  var time = parsed_json.current_observation.observation_time;
  var IconURL = parsed_json.current_observation.icon_url;
$('#Weather').html("<div class='row collapse'><span class='small-4 columns left'><img id='wIcon' src='"+ IconURL +"' /><h5 id='temp'>" + temperF +
"F&deg;<small>("+ temperC +"C&deg;)</small></h5></span><span class='medium-7 columns'><h6>Humidity: <b id='humid'>"+ humidity +"</b> <strong>| "
+ Wreport +".</strong></h6></span><small id='time' class='left'>"+ time +"</small></div>");
   }
  });
}
 

    $(document).on("click","#all_clear", function() {
    $(this).hide("explode", 1000 ).remove();
   new Reload();
    });

$(document).on("click","#SubButton", function() {
var $Priority =  $("input:radio[name=priority]:checked").val();
var $TicketNumber = $("#TicketNumber").val();
var $SiteID = $("#SiteName").val();
var $Comments = $("#comments").val();
var $tCreator = $("#username").text();
var $cPreference = $("#cPreference option:selected").text();
var $dataString = 'ticket='+ $TicketNumber +'&siteName='+ $SiteID +'&priority='+ $Priority +'&Comments='+ $Comments +'&Creator=' + $tCreator +'&ContactPref=' + $cPreference;

$.ajax({
type: "POST",
url:  "insertPDO.php",
data: $dataString, 
  success: function(response){
    if (response == '1'){
        $("#NTicket").html('<p id="success"><b>Awesome!</b><br> <img src="loadinganimation.gif" /> <br> You posted Ticket #' + $TicketNumber +'! <br> Let\'s refresh the Database.</p>').fadeIn('slow')
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
	
$(document).keyup(function(e) {
if (e.keyCode == 27) { 
    new Reload();
}  
});    


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
    left: '-10'
    }, 1500);
$('.notice').fadeOut(4500);
}

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
   addNotice("<p>Failed to remove ticket "+ id +". <br> Please refresh the page and try again.</p>");
   },
   success: function () {
  $(this).parent().parent().fadeOut(1500, function () {
   $(this).remove();
   console.log('Ticket #'+ id +' for '+ site +' was removed from the open queue');
   });
   },
   complete:function() {
   $('#table').fadeOut(1000, function() {
  $('#Database').load("dbb.php", function(){ apply(); }).fadeIn('slow');
   });
new RefreshAlerts();
   }
    });
    $(this).dialog('close');
    addNotice("<p>"+ $USER +" successfully removed <br>Ticket # "+ id +" for "+ site +"! </p>");
    },
    Cancel: function() {
    $(this).dialog('close');
    window.location.reload(); 
    }
    }
});
 
$('#Alerts').load("viewFetch.php").slideDown( {'direction': 'up'},'slow');

   
   $("#Database").load("dbb.php", function() { apply(); new RefreshAlerts(); });

    $("#TSearch").load("tick2stats.php", function() { 
      $("#datepicker").datepicker(); 
	});
    $("#NTicket").load("NTicket.php", function(){
      $("#buttonDiv").buttonset();	
	});
    $('#Whois').load("WhoisLogged.php");
    $('#ETicket').load("eTicket.php");
    $('#Log-in').load("TLogin.php");


    setInterval(function(){
      new Reload(); 
      console.log('DB Refreshed.');
    }, 95000);
	
    setInterval(function(){
      f(); 
      console.log('Page Reloaded.');
    }, 350000);		
});
/* *** Foundation Modal functions *** */
// $('#TicketWindow').foundation('reveal', 'open');
// $('#TicketWindow').foundation('reveal', 'close');

$(document).ready( function() {
var newDate = new Date();
var name = "<?php echo $MyLogin ?>";
var IP = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
var date = "<?php echo $DATE ?>";
var PASS = "<?php echo $MyPass ?>";
	
function checked() {
	if($('input:checkbox').is(':checked')) {	
				$('#myusername').val(name);
				$('#mypassword').val(PASS);
				$.cookie('LoggedInAs', name, { expires: '9999', path: '/' });	
				$.cookie('LoginPass', PASS, { expires: '9999', path: '/' });	
		}
			else{
				var inputName= $('#myusername').val();
				var inputPass= $('#mypassword').val();
					$.cookie('LoggedInAs', inputName, { expires: '9999', path: '/' });	
					$.cookie('LoginPass', inputPass, { expires: '9999', path: '/' });	
		}
	}
	$("#auto").on("click", function(){
		checked();
		});
});