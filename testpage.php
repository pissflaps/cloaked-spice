<!DOCTYPE html>
<?php require('CDRMS.php'); ?>
<html>

	<head>
	
	<script src="jQuery/jquery-1.8.0.js"></script>
	<script src="jquery/jquery-ui-1.8.23.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/jQuery_default.css" />
		<style>
		body {
		font-family: Share, Segoe UI, Arial, Tahoma, Verdana, sans-serif;
		font-size: 11pt;
		background: rgba(20,50,80, 0.3) url(img/windowfrost.png);
				background-attachment: fixed;
		color: #444444;
		padding: 1em;
		}
		
		h1{
		font-family: Lucida Bright, Times New Roman, serif;
		font-size: 4em;
		text-decoration: bold;
		padding: 0.05em;
		}
		
		h2{
		font-family: Monospace, sans-serif;
		font-size: 2em;
		}
		
		h3{
		font-family: Tahoma, Verdana, sans-serif;
		font-size: 14pt;
		}
		
		#Second_half{
		font-family: Source Sans Pro, Arial, sans-serif;
		padding: 2em;
		border: 1px solid #000000;
		border-radius: 4px;
		background: rgba(50,55,55, 0.6);
		color: #eeeeee;
		display: inline-block;
		}
		select, option{
		font-family: Segoe UI, Arial, sans-serif;
		padding: 0.25em;
		border: 1px solid #000000;
		border-radius: 2px;
		background: rgba(25,45,75, 0.8);
		color: #eee9bf;
		float: left;
		display: block;
		}
		
		sub{
		font-size: 0.75em;
		clear: both;
		padding: 0.5em;
		}
		table, td{
		text-align: center;
		font-size: 1.25em;
		}
		#hi{
		float: middle;
		width: 90%;
		}
		#toppathwrap { 
		position:fixed;
		top:0px;
		right:0px;
		background-color:rgba(255,250,205,0.8);
		color: #555555;
		padding:1em;
		font-size: 1.5em;
		border-radius: 2px;
		box-shadow:  6px 5px 4px 3px #212121;
		display:none; 
	}
	#customer{
	background: rgba(255,255,255,0.3);
	color: #212121;
	border-radius: 4px;
	padding: 0.25em;
	display: inline-block;
	}
	</style>
	
</head>
	<body>

<h1>CDRMS Servers:</h1>
<p>	
<form name="userpick"  method="POST">
<?php 
	MakeOpts();
?>
&nbsp; <button id="subbutt" type="submit" >Submit!</button>
</form>
</p>

	
<script type="text/javascript">
	$(document).ready(function() {
		$('button').button();
	
			if( $('#toppathwrap').is(':visible')){
				$(this).fadeIn(1250);
			};
			
  $('#userpick').live('submit', function (event) {
  
	   $.ajax({
                type: "POST",
                url: "testpage.php",
				data: "id=$id",
                cache: false,
				success: function(result) {
					console.log(result);		
					$('#listing').append(result);
				},
				error: function(response){
					console.log(response);		
					$('#listing').append(response);
				}		
		});
	event.preventDefault;
	});
	
$('#hi tr :even').css({'background': '#f1f1f1', 'color': '#212121' });
$('#hi tr :odd').css({'background': '#778899', 'color': '#f1f1f1' });
	
    $('#rel img').live('click', function(){
        var path = $('#server').html();
        path = path.replace(/ &amp;gt; /g,".");
        console.log(path);
        addtoppath(path);
		$(this).effect('highlight', {}, 2000);
    });
    //initially hide copy window
    $('#toppathwrap').hide();

    function addtoppath(path) {
        //console.log(path);
        $('#server').val(path);
        $('#toppathwrap').fadeIn(1000).html(path);
        $('#toppathwrap').focus();
        $('#toppathwrap').select();
    }   

});	
</script>

<div id="Second_Half">
	<center>
<?php 
if(!isset($_POST['id'])) {
		NoTicket();
	}
else {
MakeFields();
MakeRow();
			
}			?>
</center>	
</div>
<sub><br>Click the Client to copy the path to their data!</sub>
</p>
<div id="toppathwrap">
    <textarea id="copypath"></textarea>
</div>
	</body>
</html>
