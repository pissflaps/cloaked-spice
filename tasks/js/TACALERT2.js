$(document).ready( function() {"use strict";
/*global $:false, Favico:false, document:false, Spinner:false, window:false, console:false, setInterval:false */
var Weather = $.cookie("Weather");
var theme = $.cookie("theme");
var $USER = $("#username").text();
var id, userid, data, parent, site = null;

  var $RowCounts = $("#delTable tr").length;
  var $COUNT = parseInt( ($RowCounts - 1), 10);
    var favicon = new Favico({
"type" : "circle",
"bgColor" : '#FF0000',
"textColor" : '#FFFFFF',
   animation: "popFade"
    });
  favicon.badge($COUNT);

$("button").button();
$("#buttonDiv").buttonset();

function Notify() {
$RowCounts = $("#delTable tr").length;
 $COUNT = parseInt( ($RowCounts - 1), 10);	
 favicon = Favico({
 "type" : "rectangle",
"bgColor" : '#FADC00',
"textColor" : '#000000',
animation: "pop"
 });
favicon.badge($COUNT);
}			
function apply() {
    $('table#delTable tr:odd').addClass('tblOclr');
    $('table#delTable tr:even').addClass('tblEclr');
    $('table#delTable tr:first').addClass('tblFclr');
    $('table#delTable td').addClass('tblbrdr');	
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

function Reload() { 
$('#delTable').fadeOut(800, function() {
    $(this).html('<p><div id="foo"> </div></p>').fadeIn(600);
var $Color = $("#Style a").css("color");
var opts = {
  lines: 15, 
  length: 55, 
  width: 8, 
  radius: 55,
  corners: 0.8,
  rotate: 5, 
  color: $Color,
  speed: 2.1, 
  trail: 75, 
  shadow: true, 
  hwaccel: false, 
  className: 'spinner', 
  zIndex: 2e9, 
  top: '2px', 
  left: '100px' 
};
var target = document.getElementById('foo');
var spinner = new Spinner(opts).spin(target);
 });
    $('#Database').fadeOut(800, function() {
    $('#NewTicket, #tStat, #linx, #eTicket, #Style').slideUp('slow');
  $(this).load("dbb.php", function() {apply(); }).fadeIn(800);
  
    });
new RefreshAlerts();
}



$('#dialog').dialog({
autoOpen: false,
height: 625,
width: 325,
modal: false,
title: "Email Subscribers",
resizeable: false,
closeOnEscape: true,
open: function(){
    $(this).load('e2mails.html');
},
close: function(event, ui) {
$(this).remove();
    window.location.reload(); 
 }
});
 $(document).on("click", '#email img', function() {
    $('#dialog').dialog('open');
    return false;
 });


if($.cookie("theme")) { 
$('head').append($("link").attr({
href: $.cookie("theme"),
rel: "alternate stylesheet",
type: "text/css"
}) );
favicon.badge($COUNT);

}

function weatherMan(){
  $.ajax({
  url : "http://api.wunderground.com/api/f4de0ee4ffd72094/geolookup/conditions/q/IL/Chicago.json?callback=?",
  dataType : "jsonp",
  error : function(){
  $('#Weather').append("<b>Sorry</b>, something's not quite right here.");
   },
  success : function(parsed_json) {
  var location = parsed_json.location.city;
  var temper = parsed_json.current_observation.temperature_string;
  var humidity = parsed_json.current_observation.relative_humidity;
  var Wreport = parsed_json.current_observation.weather;
  var wind = parsed_json.current_observation.wind_string;
  var visibility_mi = parsed_json.current_observation.visibility_mi;
  var time = parsed_json.current_observation.observation_time;
  var imgURL= parsed_json.current_observation.image.url;
  var FeelsLike = parsed_json.current_observation.feelslike_string;
  var IconURL = parsed_json.current_observation.icon_url;
$('#Weather').append("<img id='wIcon' src='"+ IconURL +"' /> " + location + " Temperature: <b id='temp'>" + temper +" &deg;</b> <br> Humidity: <b id='humid'>"+ humidity +
"</b> with winds <b>"+ wind +"</b>. <br> Currently: "+ Wreport +", with a visibility of: "+ visibility_mi +
"mi. <br><span id='time'>"+ time +" </span>");
   }
  });
}

if($.cookie("Weather")) {
weatherMan();
  $('#tacWeather').load("TACweather.php").fadeIn(1000);
}
$('#tacWeather').dblclick(function(){
$(this).fadeOut(2000).remove();
$.cookie("Weather", null);
});
    
    
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
    $(document).on('click','#Tweather', function() {
weatherMan();
   $('#tacWeather').load('TACweather.php').fadeIn(800);
$.cookie("Weather", "On", {expires: 9999, path: '/'});
   });
    $('#open, #links, #tEdit, #Stats, #Themes').on("click", function(){
    $('#Database').toggle("drop");
    });

function f() {  
window.location.reload(); 
}


    $(document).on("click","#all_clear", function() {
    $(this).hide("explode", 1000 ).remove();
   new Reload();
    });


    
$(document).on("click","#SubButton",  function() {
var $Priority =  $("input:radio[name=priority]:checked").val();
var $TicketNumber = $("#TicketNumber").val();
var $SiteID = $("#SiteName").val();
var $Comments = $("#comments").val();
var $tCreator = $("#username").text();
var $cPreference = $("#cPreference option:selected").text();
var $dataString = 'ticket='+ $TicketNumber +'&siteName='+ $SiteID +'&priority='+ $Priority +'&Comments='+ $Comments +'&Creator=' + $tCreator +'&ContactPref=' + $cPreference;
$.ajax({
url:  "insertPDO.php?",
type: "POST",
data: $dataString, 
success: function(response){
    if (response == '1'){
$("#NewTicket").html('<p id="success"><b>Awesome!</b><br> <img src="loadinganimation.gif" /> <br> You posted Ticket #' + $TicketNumber +'! <br> Let\'s refresh the Database.</p>').fadeIn('slow')
    .delay(1000).fadeOut('slow', function(){
    $('#NewTicket').load("NewTicket.php").fadeIn('slow');
  new Reload();
    });
    }
    else if (response == '2'){
$("#NewTicket").html('<p id="resuccess">Ticket #<strong>'+ $TicketNumber +' </strong>has been added back into the Open Queue successfully! <br>'+
'<sub>This module will automatically refresh in six seconds. </sub></p>')
    .fadeIn('slow')
    .delay(6000)
    .fadeOut('slow', function(){
    $('#NewTicket').load("NewTicket.php").fadeIn('slow');
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
 
$(document)
    .find('.Gclose')
    .on("click","#growl", function() {
    $(this).closest('.notice')
    .fadeOut(850);
    return false;
    });
 setInterval( function() {
    new RefreshAlerts();
    },  30000);

    setInterval( function() {
    new Reload();
    },  555555);

    setInterval( function() {
    f();
    }, 1111111);


$('#tacWeather').draggable();

$("#Style a").click(function() { 
$('table#delTable tr:odd').addClass('tblOclr');
$('table#delTable tr:even').addClass('tblEclr');
$('table#delTable tr:first').addClass('tblFclr');
$('table#delTable td').addClass('tblbrdr');
$("link").attr("href",$(this).attr('rel'));
$.cookie("theme",$(this).attr('rel'), {expires: 9999, path: '/'});
    new Reload();
return false;
});


$("#kill").on('click', function(){
$('table#delTable tr:odd').removeClass('tblOclr');
$('table#delTable tr:even').removeClass('tblEclr');
$('table#delTable tr:first').removeClass('tblFclr');
$('table#delTable td').removeClass('tblbrdr');
$.cookie("theme", null);
window.location.reload();
    });


$('#NewTicket').load("NewTicket.php"); 
$('#linx').load("links.php");
$('#eTicket').load("eTicket.php");
$('#tStat').load("tick2stats.php", function() { $("#datepicker").datepicker();$("button").button(); });
$('#Whois').load("WhoisLogged.php");
    $('#Alerts').load("viewFetch.php").slideDown( {'direction': 'up'},'slow');
 $('#NewTicket, #linx, #eTicket, #tStat, #Style').hide();
   
   $("#Database").load("dbb.php", function() { apply(); new RefreshAlerts(); });
 
/*@cc_on
var console = window.console || {log: function(){ }}; // Help IE get the f*** over itself

@*/ 

console.log("JS Initialized!");
});