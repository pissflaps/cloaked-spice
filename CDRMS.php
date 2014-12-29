<!DOCTYPE  html>
<?php require('CDRMS_functions.php'); ?>
<html>
	<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>
	


<!-- // Compressed version of all related vendor plug-ins used in jQuery -->
  
  <link rel="stylesheet" href="Foundation/css/Foundation.min.css" type="text/css">	
		<title>CDRMS Server Locator</title>
<script src="js/jquery.zeroclipboard.js"></script>  
<style>
@import('css/structure.css');

		body {
		font-family: Share, Segoe UI, Arial, Tahoma, Verdana, sans-serif;
		font-size: 11pt;
		background: rgba(20,50,80, 0.3) url(img/windowfrost.png);
				background-attachment: fixed;
		color: #444444;
		}
		
		h1{
		font-family: Lucida Bright, Times New Roman, serif;
		font-size: 36pt;
		text-decoration: bold;
		padding-bottom: 0.05em;
		}
		
		h2{
		font-family: Arial Black, Monospace, sans-serif;
		font-size: 24pt;
		}
		
		h3{
		display: inline-block;
		font-family: Tahoma, Verdana, sans-serif;
		font-size: 14pt;
		text-align:center;
		clear: none;
		}
		
		#Second_Half{
		font-family: Source Sans Pro, Arial, sans-serif;
		padding: 2em;
		border: 1px solid #bbbbbb;
		border-radius: 4px;
		background: rgba(30,60,90, 0.3);
		color: #eeeeee;
		display: block;
		position: relative;
		padding-bottom: -1px;
		visibility: invisible;
		}
		
		sub{
		font-size: 0.75em;
		clear: both;
		padding: 0.5em;
		}
		table{
		text-align: center;
		font-size: 1.25em;
		position: relative;
		clear: none;
		}
		#hi{
		width: 90%;
		position: relative;
		z-index: 10;
		}
		#hi thead tr td{
			background: #0073EA;
			background-color: rgb(0, 115, 234);
			color: #f1f7f9;
			text-align: center;
		}
		#listing tr td{
		  background: #f1f7f9; 
		  color: #212121;
		}

		#toppathwrap { 
		position:fixed;
		top: 0px;
		left: 0px;
		display: inline;
		width: 100%;
		height: 250px;
		background-color:rgba(0,90,25,0.6);
		color: #f5fffa;
		padding:1em;
		font-size: 28pt;
		border-radius: 2px;
		box-shadow: 10px 10px 5px #444444;
		z-index: 999;
		text-align: center;
		vertical-align: bottom;
	}
	#customer{
	background: rgba(25,45,75, 0.8);
	color: #FFFFCC;
	border-radius:8px;
	padding: 0.5em;
	display: inline-block;
	position: relative;
	}


	#bottum{
		display:inline-block;
		position: relative;
		clear: none;
	}
	#zclip-ZeroClipboardMovie_2 *{
			margin-top: -20px;
			margin-left: -2px;
	}

#foot{
	display: block;
	padding: 0.75em;
	background: rgba(255,235,140,0.8);
	color: #212121;
	border: 1px solid #aaaaaa;
	position: absolute;
	top: 1%;
	left: 40%;
	border-radius: 6px;
	box-shadow: 6px 6px 3px #888888;
}

#rel{
position: relative !important;
clear: none;
}

select, button{
		border-radius: 2px;
		border: none;
}

#hidden{
display: inline;
position: absolute;
left: -10000px;
top: -1000px;
padding: 0px;
margin: 0px;
}

a:active, a.active{
color: #ffffff;
}
a:hover, a.hover{
color: #000000;
}
a:link, a.link {
color: #708090;
}

</style>
</head>
<body>
<div id="toppathwrap" >
</div>
<div id="formDiv" class="has-form">
<h1>CDRMS Clients:</h1>
<div class="large-3 columns">
<form name="userpick"  method="POST" >
    <select name='id' >
  <option value='null' selected> Please Choose... </option>
  <?php
    MakeOpts();
  ?>
    </select> </div>
    <button id="subbutt" type="submit" class="small button primary">Submit!</button>
</form>

</div>

<div id="Second_Half">

<?php 
if(!isset($_POST['id'])) {
		NoTicket();
	}
else {
MakeFields();
// echo "<div id='foot'>Click the <img src='icons/copy.gif' border=0/> icon to copy the Server location.</div>";
 
}
?>

</div>
	
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
<script type="text/javascript">	
 $(document).foundation();
 
  
$(document).ready(function() {	


$("#toppathwrap").hide();
$('button').button();
	
  $('#userpick').on('submit', function (event) {
           $event.ajax({
                type: "POST",
                url: "CDRMS.php",
                dataType:"html",
                data: "id=$id",
                cache: false,
                success: function(result) {
                               $('#listing > tbody:last').append(result); 
				},
				error: function(response){
                  console.log(response);
                  $('#listing tr').last().append(response);
				}
            });
    });

$('#hi tr :odd').css({'background': '#f5fffa', 'color': '#F0F8FF' });
  
$('body').on('copy', '.zclip', function(e){
        var CPY = $(this).data("zclip-text");
        var textToCopy =  CPY;
    // If there isn't any currently selected text, just ignore this event
    if (!textToCopy) {
      return;
    }

    // Clear out any existing data in the pending clipboard transaction
        e.clipboardData.clearData();
        e.clipboardData.setData("text/plain", textToCopy);
        e.preventDefault();
     $('#toppathwrap').slideDown('slow', function() {
			$(this).html("<span class='row collapse'><u>"+ CPY +"</u> copied to clipboard!</span>");
		}).slideUp(8000);
	      console.log(CPY +" successfully copied!");
   });
});	
</script>
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
</body>
</html>
