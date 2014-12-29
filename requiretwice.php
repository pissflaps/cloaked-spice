<?php

global $success;

$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$database = 'dbase';
$table = 'tickets';
$Tdate = date('Y-m-d');
$DATE = date('n/j/Y');
$today = date('l, F jS');


if(! isset($_SESSION['myusername'])) {
$user = "Not Logged In";
$_SESSION['auth'] = 0;
}
 else {
$Uuser = $_SESSION['myusername'];
$user = ucwords($Uuser);
$_SESSION['auth'] = 1;
}

?>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Source+Sans+Pro::latin', 'Droid+Sans::latin', 'Lato::latin', 'Cantora+One::latin', 'Cabin+Condensed::latin', 'Istok+Web::latin', 'Ubuntu:500:latin', 'Share::latin', 'Open+Sans+Condensed:300:latin', 'Oswald:700:latin', 'Electrolize::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://tac-alert01/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>	
		
		<link rel="stylesheet" href="css/Hween/jquery-Hween.css" type="text/css" >
<!-- 
	<link rel="stylesheet" href="css/bootstrap/jquery-Bootstrapt.css">
	<link rel="stylesheet" href="css/smoothness/jquery-ui-smoothness.css">
	<link rel="stylesheet" href="css/jquery-Default.css" type="text/css" />
 -->

		<script type="text/javascript">
$(document).ready(function () {	


	$('#loginout').css("display", "hidden");
	$('#loginout').show("bounce", {"times": 5}, 'fast');
	/*	$('#close').live("click", function() { 
			$('#loginout').hide("scale", {direction: 'vertical', origin: ['top', 'center'] },  1000);
			});
	*/

var $USER = "<?php echo $user ?>";


			//  *** STYLING SECTION *** //

			/* Set up styles for the default theme by using classes defined in each Theme's CSS page. */
		
				$('table#delTable tr:odd').addClass('tblOclr');
				$('table#delTable tr:even').addClass('tblEclr');
				$('table#delTable tr:first').addClass('tblFclr');
				$('table#delTable td').addClass('tblbrdr');
				
				
/*		Outtakes from older Alert systems::: 
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
	$('#all_clear').live("click", function() {
				$(this).hide("explode", 2000 );
				Reload();
				});
});
</script>
<script>
		$(document).ready(function () {
			   /* 			***	** 	COOKIES 	**		***			 */

       var logbar = $.cookie('logbar');
    
	// Themes will be applied based upon how they are named, the CSS file is in a folder using all the correct naming paths for this to work.
		// See the index_tabs.php source to understand that link structure.
		
	$("#themes a").click(function() { 
		$('table#delTable tr:odd').addClass('tblOclr');
		$('table#delTable tr:even').addClass('tblEclr');
		$('table#delTable tr:first').addClass('tblFclr');
		$('table#delTable td').addClass('tblbrdr');
		$("link").attr("href",$(this).attr('rel'));
		$.cookie("theme",$(this).attr('rel'), {expires: 365, path: '/'});
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
			
			$('img, tr, #poster ').addClass('round');
			$('#kill, #tabs').addClass('shadow');
			$('input, textarea, #search').addClass('corners');
//			$('#search, #del').removeClass('round');
		
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
	$('#tabs-2').fadeOut(1000, function() {
					 $(this).load('db.php').fadeIn(900);
	});		
}

function Reload() { 	
	$('#tabs-2').fadeOut(1000, function() {
			$(this).html('<center><div id="foo"> </div></center>').fadeIn(900);
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
  trail: 75, // Afterglow percentage
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
		<script type="text/javascript">
		
		$(document).ready(function() {
// Precache the Array of images:
				var imageArray = [
					'delete.png', 'TD_delete.png', 'img/tactitle_flick.png', 'img/tactitle_hotsneaks.png', 
					'img/tactitle_vader2.png', 'img/tactitle_ICS.png', 'img/tactitle-fbook.png', 'img/tactitle-bootstrappa.gif',  
					'img/tactitle-rainyday.png', 'img/tactitle-Sstreet.png','icons/status_offline.png','icon_trash.png', 'icons/user.png', 'icons/house.png', 'icons/comment.png',
					'icons/isicon.gif', 'icons/user_gray.png'
				];
			// Add hidden element
				var hidden = $('body').append('<div id="img-cache" style="display:none/>').children('#img-cache');
					// Add images to hidden element.
						$.each(imageArray, function (i, val) {
							$('<img/>').attr('src', val).appendTo(hidden);
						});

						
// Type out the Konami Code on your keyboard and watch a fun, short animation.
	//This is entirely governed by the animation steps, so please take care when
		// making any edits to this code. //
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

	