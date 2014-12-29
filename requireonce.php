<?php

$num = rand (1,3);
$num2 = rand (1,2);
$num4 = rand (1,4);
$num5 = rand (1,5);
$num6 = rand (1,6);
$num7 = rand (1,7);
$num8 = rand (1,8);
$num11 = rand (1,11);
$num13 = rand (1,13);

global $success;

include('autologin.php');


if(! isset($_SESSION['myusername'])) {
$user = "Not Logged In";
}
 else {
$Uuser = $_SESSION['myusername'];
$user = ucwords($Uuser);
$_SESSION['auth'] = 1;
}

?>
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	  		<script type="text/javascript" src="js/modernizr.js"></script>
<link rel="stylesheet" href="css/Base.css" type="text/css" />

		<script type="text/javascript">
$(document).ready(function () {	
	$('#loginout').css("display", "hidden");
	$('#loginout').show("bounce", {"times": 5}, 'fast');
	
var $USER = "<?php echo $user ?>";

	$('#delTable td a.delete').live("click", function () {
		 var id = $(this).parent().parent().attr('id');
		 var userid = '&user=' + $USER;
		 var data = 'id=' + id + userid; 
		 var parent = $(this).parent().parent();
		 $.ajaxSetup({
					type: "POST",
					url: "delete_row.php?",
					data: data,
					cache: false,
					error: function() {
					addNotice("<p>Failed to remove ticket "+ id +". <br> Please refresh the page and try again.</p>");
					},
					success: function () {
						parent.fadeOut(1000, function () {
							$(this).parent.remove();
						});
				/* If we decide to implement AJAX later in the Alert System, the database can be loaded again using the following code. 
					 * The Database page is 'db.php', and is included in the second tab div, which brings it into view on document load. If we decide
						 * to implement AJAX, the php include will need to be modified or removed.*/
				  	  $('#delTable').fadeOut(1500, function() {
							$('#tabs-2').load('db.php').fadeIn('slow');
						});
					 

				},
					complete:	function() {
				addNotice("<p>"+ $USER +" successfully removed Ticket # "+ id +"! </p>");
				
							}
			});
				$('#dialog').dialog('open');
					$('.talk').append('<p>Are you sure you want to remove Ticket # '+ id +'? </p>');
			return false;
			});

		$('#dialog').dialog({
			autoOpen: false,
			height: 200,
			width: 350,
			modal: true,
			title: 'Are you sure, '+ $USER +'?',
			resizeable: false,
			closeOnEscape: true,
			buttons: {
				Okay: function() {	
					$(this).dialog('close');	 
					$.ajax();
					},
				Cancel: function() {
					$(this).dialog('close');
					f();
				}
			}
	});

			//  *** STYLING SECTION *** //

			// Set up styles for the default theme
			// Basically theme whatever holiday comes up next //
		
				$('table#delTable tr:odd').addClass('tblOclr');
				$('table#delTable tr:even').addClass('tblEclr');
				$('table#delTable tr:first').addClass('tblFclr');
				$('table#delTable td').addClass('tblbrdr');
				
/*			
		// * Double-click the top Table Row to collapse all rows into one. * //
	var divdbl = $("table#delTable tr:first");
    divdbl.dblclick(function () { 
      $('table#delTable tr:not(:first)').slideToggle(1000);
    });
		
		// * Make the Database Table draggable around the entire page * //
		// $('table#delTable').addClass("draggable");
*/			

    $(function () {
        $("button").button();
    });
	$(function () {
        $("#buttonDiv").buttonset();
    });

});
</script>
<script>
		$(document).ready(function () {
			   // COOKIES
            var logbar = $.cookie('logbar');
    var section = $.cookie('section');
	var theme = $.cookie('theme');
	
		
		$('a#first ').live('click', function(){
			$.cookie('section', 'first', { expires: 365, path: '/' });
			});
	
			$('a#second ').live('click', function(){
			$.cookie('section', 'second', { expires: 365, path: '/' });
			});

					$('a#third ').live('click', function(){
			$.cookie('section', 'third', { expires: 365, path: '/' });
			});

					$('a#fourth ').live('click', function(){
			$.cookie('section', 'fourth', { expires: 365, path: '/' });
			});
	jQuery(function($) {
        var userpanel = $("#accordion");
        var index = $.cookie("section");
        var active;
        if (index !== undefined) {
                active = userpanel.find("h3:eq(" + index + ")");
        }
        userpanel.accordion({
                header: "h3",
                event: "click",
                active: active,
                change: function(event, ui) {
                        var index = $(this).find("h3").index ( ui.newHeader[0] );
                        $.cookie("section", index, { expires: 365, path: '/' });
                }
        });
});

	});
	
</script>

<script type="text/javascript">
/* This section forces the Alert System to reload the page roughly every seven minutes. 
		The function for reloading the page is also bound to the escape key, so pressing it to close
			a modal window will also reload the page. The function is used in multiple pages, so 
																*** TAKE CAUTION *** when editing this section! */
	
		/* ***
		
				SET UP FUNCTIONS FOR REFRESHING // PORTIONS // OF THE PAGE			
		
		*** */
	
	function apply() {
				$('table#delTable tr:odd').addClass('tblOclr');
				$('table#delTable tr:even').addClass('tblEclr');
				$('table#delTable tr:first').addClass('tblFclr');
				$('table#delTable td').addClass('tblbrdr');
};
function Insert() {
	$('#dbb').fadeOut(1000, function() {
					 $(this).load('db.php').fadeIn(900);
	});		
}

function Reload() { 	
	$('#delTable').parent().fadeOut(1000, function() {
				$(this).html('<br><center><div id="foo"> </div></center>').fadeIn(900);
var $Color = $('#themes a').css("color");
				
var opts = {
  lines: 11, // The number of lines to draw
  length: 26, // The length of each line
  width: 5, // The line thickness
  radius: 26, // The radius of the inner circle
  corners: 0.8, // Corner roundness (0..1)
  rotate: 5, // The rotation offset
  color: $Color, // #rgb or #rrggbb
  speed: 1.75, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: true, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '15px', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
};
var target = document.getElementById('foo');
var spinner = new Spinner(opts).spin(target);

	});
	setTimeout('Insert()', 1000);
	Refroosh=	setTimeout('apply()', 750);
return Refroosh;
};


	function f() {   
		setTimeout('window.location.reload()', 10); 
	};


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

</script>
	<script>
		var theme = $.cookie('theme');
				if($.cookie("theme")) {
	$("link").attr("href",$.cookie("theme"));
}		

$(document).ready(function(){
	
	$("#themes a").click(function() { 
		$('table#delTable tr:odd').addClass('tblOclr');
		$('table#delTable tr:even').addClass('tblEclr');
		$('table#delTable tr:first').addClass('tblFclr');
		$('table#delTable td').addClass('tblbrdr');
		$("link").attr("href",$(this).attr('rel'));
		$.cookie("theme",$(this).attr('rel'), {expires: 365, path: '/'});
		return false;
	});
	
	$("#kill").live('click', function(){
		$('table#delTable tr:odd').removeClass('tblOclr');
		$('table#delTable tr:even').removeClass('tblEclr');
		$('table#delTable tr:first').removeClass('tblFclr');
		$('table#delTable td').removeClass('tblbrdr');
		$.cookie("theme", null);
		setTimeout('window.location.reload()', 10);
			});
			
$('div.fade').hide();
			$('img, tr, input, textarea, #poster ').addClass('round');
			$('#search').removeClass('round');
  });
</script>

<script type="text/javascript">

$(window).load(function(){  
		 
			 $('#growl')
				.find('.Gclose')
				.live("click", function() {
					$(this).closest('.notice')
						.fadeOut(1250);
						return false;
			});
});

	$(document).keyup(function(e) {
		if (e.keyCode == 27) { 
			Reload();
		}  
	});
	
	
$(window).ready(function(){  
 setInterval( 'f()',  759990);
	});
</script>
		<script type="text/javascript">
		$(document).ready(function() {
// Precache the Array of images:
	var imageArray = ['delete.png', 'TD_delete.png', 'img/ajaxBar.gif', 
'img/tactitle_flick.png', 'img/hotsneaks.png', 'img/vader2.png', 'img/tactitle_ICS.png', 'img/tactitle-fbook.png',  'img/tactitle-rainyday.png', 'img/tactitle-Sstreet.png' ];
			// Add hidden element
				var hidden = $('body').append('<div id="img-cache" style="display:none/>').children('#img-cache');
					// Add images to hidden element.
						$.each(imageArray, function (i, val) {
							$('<img/>').attr('src', val).appendTo(hidden);
						});
		
		
	if ( window.addEventListener ) {
        var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
        window.addEventListener("keydown", function(e){
                kkeys.push( e.keyCode );
                if ( kkeys.toString().indexOf( konami ) >= 0 ) {
                        $('img').css('-webkit-transition-duration', '10s').css('-webkit-transform', 'rotate(360deg)');
                        $('a,p,span,h1,h2,h3,input').css('-webkit-transition-duration', '10s').css('-webkit-transform', 'rotate(-360deg)');
                        $('img').css('-moz-transition-duration', '10s').css('-moz-transform', 'rotate(360deg)');
                        $('a,p,span,h1,h2,h3,input').css('-moz-transition-duration', '10s').css('-moz-transform', 'rotate(-360deg)');
                }
        }, true);
} 
});
	</script>