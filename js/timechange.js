		$(document).ready(function () {
	    var d = new Date(); // defaults to the current time in the current timezone
	    var t = d.getHours();
	    if (t < 6) {
	        $('table#delTable tr:odd').css('background', '#ADD8E6');
	        $('div#column_left').css('background', '#ADD8E6');
	        $('div#mail').css('background', '#13A0E8');
	        $('table#delTable tr:first').css('background', '#13A0E8');
	        $('body').css({
	            'background': '#CFDEE3 url(/img/bg6.png)',
	            'color': '#000000'
	        });
	    }
// Before 6AM, Original/Default theme will apply	
	    if (t > 6) {
	        $('table#delTable tr:odd').css('background', ' #0086B3');
	        $('div#column_left').css('background', '#0086B3');
	        $('div#mail').css('background', '#13A0E8');
	        $('table#delTable tr:first').css('background', ' #00A5DB');
	        $('body').css({
	            'background': '#006180 url(/img/bg5.png)',
	            'color': '#ffffff'
	        });
	    }
//early morning will be BLU
	    if (t >= 9) {
	        $('table#delTable tr:odd').css('background', ' #F5BF0C');
	        $('div#column_left').css('background', '#F5BF0C');
	        $('div#mail').css('background', '#DE9547');
	        $('table#delTable tr:first').css('background', ' #DE9547');
	        $('body').css({
	            'background': '#B09A82 url(/img/bg4.png)',
	            'color': '#ffffff'
	        });
	    }
// after 10AM will be ORG
	    if (t >= 11) {
	        $('table#delTable tr:odd').css('background', ' #FFFFCC');
	        $('div#column_left').css('background', '#FFFFCC');
	        $('div#mail').css('background', '#fff007');
	        $('table#delTable tr:first').css('background', ' #FFF007');
	        $('body').css({
	            'background': '#BDBF97 url(/img/bg3.png)',
	            'color': '#000000'
	        });
	    }
// after noon will be YLO
	    if (t >= 13) {
	        $('table#delTable tr:odd').css('background', ' #eeffcc');
	        $('div#column_left').css('background', '#eeffcc');
	        $('div#mail').css('background', '#129C00');
	        $('table#delTable tr:first').css('background', ' #C5EB52');
	        $('body').css({
	            'background': '#B1BAA8 url(/img/bg2.png)',
	            'color': '#000000'
	        });
	    }
// after 1PM will be GRN

	    if (t >= 15) {
	        $('table#delTable tr:odd').css('background', ' #000000');
		    $('div#column_left').css('background', '#cccccc');
		    $('div#mail').css('background', '#818181');
		    $('table#delTable tr:first').css('background', ' #A3A3A3');
		    $('body').css({
		        'background': '#b8b8b8 url(/img/bg8.png)',
		        'color': '#ffffff'
		        });
	    }
// after 3PM will be B/W
	    if (t > 16) {
	       $('table#delTable tr:odd').css('background', ' #FF0000');
		   $('div#column_left').css('background', '#FF0000');
		   $('div#mail').css('background', '#BD0000');
		   $('table#delTable tr:first').css('background', ' #DE4A47');
		   $('body').css({
		       'background': '#D6A696 url(/img/bg7.png)',
		       'color': '#ffffff'
		   });
	    }
// After 5PM, theme will be RED
		
	    //			else {
	    //				$('table#delTable tr:odd').css('background', ' #ADD8E6');
	    //		        $('div#column_left').css('background', '#ADD8E6');
	    //		        $('div#mail').css('background', '#13A0E8');
	    //		        $('table#delTable tr:first').css('background', ' #13A0E8');
	    //		        $('body').css({
	    //		            'background': '#CFDEE3 url(bg6.png)',
	    //		            'color': '#000000'
	    //		        });
	    //			}	
	    //anything else will default BLU2
	});
	
