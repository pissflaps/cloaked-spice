	//				WEATHER	-- Cookie determines if page reload will also load Weather div, 
	//						or if it remains hidden until user event loads the container.
	var Weather = $.cookie("Weather");
			


$(document).ready( function() {
	
/* Load each segment of the Alert System to decrease overall page load on first render	
		

***				*/

	$('#NewTicket').load('NewTicket.php');		//Loads in the functions for opening new tickets.
	$('#linx').load('links.php');		//Loads the Quick Links and populates the random banner image.
	$('#eTicket').load('eTicket.php');		//Loads the Ticket editor input box. Type the ticket and open a new page to edit it.	
	$('#tStat').load('tick2stats.php');		//Loads the calendar input box, select a date and see its ticket activity on a new page.
	$('#Whois').load('WhoisLogged.php');		//Loads the calendar input box, select a date and see its ticket activity on a new page.
	//		$('#Database').load('dbb.php');
	$('#NewTicket, #linx, #eTicket, #tStat, #Style').hide();
	

			if($.cookie("Weather")) {
		$('#tacWeather').load('TACweather.php').fadeIn(1000);
}		


	/*				The main reloading function of the Database. 
								*	Clears the current render
								*	Creates a spinner out of HTML elements
								*	Spins and fades the spinner
								*	Renders a refreshed database load via Ajax.
								* * * * * * 	USE CAUTION WHEN MAKING EDITS TO THIS		*/
function Reload() { 	
	$('#delTable').fadeOut(900, function() {
			$(this).html('<p><div id="foo"> </div></p>').fadeIn(600);
var $Color = $("#Style a").css("color");

var opts = {
  lines: 15, // The number of lines to draw
  length: 55, // The length of each line
  width: 6, // The line thickness
  radius: 50, // The radius of the inner circle
  corners: 0.6, // Corner roundness (0..1)
  rotate: 6, // The rotation offset
  color: $Color, // #rgb or #rrggbb
  speed: 1.8, // Rounds per second
  trail: 70, // Afterglow percentage
  shadow: true, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: 'auto', // Top position relative to parent in px
  left: '200px' // Left position relative to parent in px
}
var target = document.getElementById('foo');
var spinner = new Spinner(opts).spin(target);
 });
		$('#Database').fadeOut(1500, function() {
			$(this).load('dbb.php').fadeIn(2000);
				$('#NewTicket, #tStat, #linx, #eTicket, #Style').slideUp('slow');
			});

}


/*	***	EXPAND the SEARCH 
	***	Focus [click] on the input box to expand the search
	***	bar. Type your query and submit search on
	*** the Wiki powered by Sphinx
*/
		var inputWidth = '350px';
		var inputWidthReturn = '150px';

	$('#search').focus(function(){
if( ($(this).val) == null){
		//clear the text in the box.
	$(this).val(function() {
		$(this).val('');
	});
}
		//animate the box
	$(this).animate({
		width: inputWidth
		}, 500 )
	});
	$('#search').blur(function(){
				var $STORAGE = $(this).val();
		if($STORAGE == null) {
				$(this).val('Search the Wiki');
		}
		$(this).animate({
		width: inputWidthReturn
		}, 800 )
	});
/*	*** END Searchbar Stretch function	***	*/

					$('#tacWeather').dblclick(function(){
						$(this).fadeOut(2000).remove();
						$.cookie("Weather", null);
					});
			
		/*			 Functions for dropping down individual segments of the top activity bar. 
				These will eventually become an unsorted list of links across the opaque top of the Alert System.												*/
				
	$('#open').live("click", function() {
		$('#NewTicket').slideToggle('slow');
		$('#eTicket, #linx, #tStat, #Style').slideUp('slow');
		
	});
				$('#links').live("click", function() {
					$('#linx').slideToggle('slow');
					$('#eTicket, #NewTicket, #tStat, #Style').slideUp('slow');
					
			});
				$('#tEdit').live("click", function() {
					$('#eTicket').slideToggle('slow');
					$('#NewTicket, #linx, #tStat, #Style').slideUp('slow');
				});
					$('#Stats').live("click",function() {
						$('#tStat').slideToggle('slow');
						$('#NewTicket, #linx, #eTicket, #Style').slideUp('slow');
					});
					$('#Themes').live("click", function() {
						$('#Style').slideToggle('slow');
						$('#NewTicket, #tStat, #linx, #eTicket').slideUp('slow');
							return false;
					});
						$('#Tweather').live("click", function() {
							$('#tacWeather').load('TACweather.php').fadeIn(1000);
								$.cookie("Weather", "On", {expires: 9999, path: '/'});
							});
					$('#open, #links, #tEdit, #Stats, #Themes').live("click", function(){
						$('#Database').toggle("drop");
					});
						
					$('#WikiForm, #Ticketform, #EditForm').on('submit', function(){
						$form.find('input:text').blur();
					});
						
//	Functions for refreshing TACALERT via Ajax calls	//

/*
function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

// to call, use: resetForm($('form[name=myName]')); // by name
*/
	function f() {  
		setTimeout('window.location.reload()', 10); 
	}
	

		/*		When no tickets are available, 
					clicking the speech bubble will explode and refresh the db 
						in case new tickets have arrived. Otherwise,
							the default refresh rate applies. 		*/
							$('#all_clear').live("click", function() {
								$(this).hide("explode", 1000 );
									Reload();
							});

/*		Ticket submission via ajax, after dropping open the New Ticket div	
*	 		Sends $_POST request to NewTicket.php and rolls through error checking on the server-side.
*			*** Implement jQuery error-checking to future updates so errors appear seamlessly and in realtime 														*/
$("#SubButton").live("click",  function() {
		var $Priority =  $("input:radio[name=priority]:checked").val();
		var $TicketNumber = $("#TicketNumber").val();
		var $SiteID = $("#SiteName").val();
		var $Comments = $("#comments").val();
		var $dataString = 'ticket='+ $TicketNumber +'&siteName='+ $SiteID +'&priority='+ $Priority +'&Comments='+ $Comments;
	$.ajax({
		url:  'insertPDO.php?',
		type: 'POST',
		data: $dataString, 
		success: function(response){
				if (response == '1'){
$("#NewTicket").html('<p id="success"><b>Awesome!</b><br> <img src="loadinganimation.gif" /> <br> You posted Ticket #' + $TicketNumber +'! <br> Let\'s refresh the Database.</p>').fadeIn('slow')
					.delay(1000).fadeOut('slow', function(){
						$('#NewTicket').load("NewTicket.php").fadeIn('slow');
													Reload();
					});
				}	
				else if (response == '2'){
$("#NewTicket").html('<p id="resuccess">Ticket #<strong>'+ $TicketNumber +' </strong>has been added back into the Open Queue successfully! <br>'+
'<sub>This module will automatically refresh in six seconds. </sub></p>')
					.fadeIn('slow')
					.delay(6000)
					.fadeOut('slow', function(){
				$('#NewTicket').load("NewTicket.php").fadeIn('slow');
													Reload();
					});
				}
		}		//End Sucess: function
	});
		return false;		// Return False to ensure the page does not refresh while sending the request to update the ticket database.
	});
		
	
/*		Bind the ESC key to run the scripted function to reload the database 	*/
	$(document).keyup(function(e) {
		if (e.keyCode == 27) { 
			Reload();
		}  
	});				
		
/* 	Notification script for use with dbb.php when events trigger by user action.
*	Creates a div with inner html using data from $_POST to pop a message up to a user that removes a ticket from the queue.
*		Future project: 	combine Node.js to broadcast the notify function to all users when a ticket is removed. This will require research to preserve data
* 									being fed into the generated div, making the function global should be a good start.
*/

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
			left: '-10',
			}, 1500);
	$('.notice').fadeOut(4500);
	};
/*	
***		Function for removing tickets in the Alert System		***
	*	Prompts confirmation in a Dialog before removing ticket from page.
	* Confirm fades out DB and refreshes via Ajax - page remains static.
	* A Notice function is generated after DB refresh, confirming the removal of ticket.
	* Ticket is updated in SQL to append 'X' in 'Removedby' column, which toggles the SQL to display tickets.
	*	*	*		DO NOT MAKE ADJUSTMENTS TO THIS FUNCTION UNLESS MOVING TO A SEPARATE PAGE		*	*	*
					*		 * * * * 		* 		H E R E   B E   D R A G O N S 	* 		* * * *		 *										
*/
			
	   	   var $USER = "<?php echo $_SESSION['myusername']; ?>";
	$('#del').live("click", function () {
		  id = $(this).parent().parent().attr('id');
		  userid = '&user=' + $USER;
		  data = 'id=' + id + userid; 
		  parent = $(this).parent().parent();
		
				$('#removal').dialog('open');
					$('.talk').html('<p> Are you sure you want to remove Ticket <u>#<b>'+ id +' </b></u>? </p>');
			return false;
			});

		$('#removal').dialog({
			autoOpen: false,
			height: 225,
			width: 325,
			modal: true,
			title: 'Are you sure, '+ $USER +'?', 		/*	 <img src="icon_trashLine.png" height="25px" width="25px"  /> 	*/
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
											parent.fadeOut(1500, function () {
										$(this).remove();
									});
							},
								complete:	function() {	 
										$('#table').fadeOut(1000, function() {
												$('#Database').load('dbb.php').fadeIn('slow');
										});
								}
						});
						$(this).dialog('close');
							addNotice("<p>"+ $USER +" successfully removed Ticket # "+ id +"! </p>");
					},
				Cancel: function() {
					$(this).dialog('close');
						setTimeout('window.location.reload()', 50); 
				}
			}
	});
		 
			 $('#growl')
				.find('.Gclose')
				.live("click", function() {
					$(this).closest('.notice')
						.fadeOut(850);
						return false;
			});
			
			setInterval( function() {
				Reload();
			},  555555);

			setInterval( function() {
				f();
			}, 1111111);
				$('#tacWeather').draggable();
				

/*
*	Styling functions:
*		use cookies and determine if a cookie is present for the theme styling. If no theme cookie exists, the default 'tacalert.css' will be used. The CSS 
*		themes should all begin with the normalize.css and the corresponding jqueryUI.css to include styled UI elements in use [buttons, input, animations, etc].
*		When applied, the #Style div will roll up and the DB should automatically reload. The page should not refresh unless clicking the "Default Theme" button, 
*		which will roll the page back to tacalert.css and clear the theme cookie.
*					Consider accessing additional divs that aren't used in other themes. 
*/				
	$("#Style a").click(function() { 
		$('table#delTable tr:odd').addClass('tblOclr');
		$('table#delTable tr:even').addClass('tblEclr');
		$('table#delTable tr:first').addClass('tblFclr');
		$('table#delTable td').addClass('tblbrdr');
		$("link").attr("href",$(this).attr('rel'));
		$.cookie("theme",$(this).attr('rel'), {expires: 9999, path: '/'});
			Reload();
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
		
		
}); //end Document.Ready(); //
