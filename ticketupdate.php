<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<script src="js/jquery-1.7.1.js"></script>  
		<script src="jQuery/jquery-ui-1.8.19.js"></script>
  <link href="css/jquery-ui-custom1.css" rel="stylesheet" type="text/css"/>		
  <script type="text/javascript" src="js/jquery.form.js"></script> 


	<title>TAC's Ticket Updater - Update tickets and put 'em back in the Open Queue.</title>
		<script>
		$(document).ready(function()
			{ 	
			$('button#submit ').click(function()
			{
			$.ajax(
				{
					   type: "POST",
					   url: "update2.php?tickentry=$Aticket",
					   cache: false,
					   dataType: 'html'
					   
				});
			});
	$('#table tr:odd').css('background', ' #ABCDEF');
	$('#table tr:even').css('background', ' #FFFFFF');
    $('#table tr:first').css('background', ' #eeeeee');

		});
		</script>
	
		<style>
		body{
			position:relative;
			margin-top:2%;
			font: 12px Helvetica, Arial, sans-serif;
			width: 99%;
			background:#A6D8ED;
			color:#000000;
		}
@font-face {
	font-family: Script MT Bold;
	src: url('SCRIPTBL.ttf');
}
.corners{
		-moz-border-radius: 8px;
		border-bottom-right-radius: 8px;
		border-top-left-radius: 8px;
}

input {
padding:5px;
}

	.tab{
		background:#708090;
		position:relative;
		text-align:center; 
		bottom:0px; 
		left:10px; 
		padding:1px;
	}
	#table {
		text-align: center;
		vertical-align: top;
	}
	#divtop {
	display: inline;
	text-align: center;
	vertical-align: top;
	}
	#divbottom {
	text-align: left;
	vertical-align: bottom;
	display: block;
	padding: 5px;
	}
	#colright {
	display: block;
	padding: 4px;
	clear:both;
	float:left;
	background: #888888;
	color: #FFFFCC;
	border-radius: 2px;
	opacity: 0.75;
	text-align: center;
	margin: 10px auto;
	margin-left: 5%;
	}
	
	.outline {
	border: 1px solid #444444;
	}
	
	#update {
	 background:#FFFFCC;
	 color:#000000;
	 padding:15px;
	 border-radius:4px;
	 }
		</style>
		</head>

				<body>
<div id="divtop">	
			<script>
	  $(document).ready(function() { 
			   $("button").button();
			$('table, button, tr, span, a, p, div, textarea, input, img').addClass('corners');
			$('input, table').addClass('outline');
			});
	</script>
		<center>
<font face="Script MT Bold" size=6>After submitting a ticket number, make adjustments below:</font>
<br><br/>

<form name="Zticket" METHOD="POST" action="update2.php">
<input type="text" name="tickentry" placeholder="Ticket Number" MAXLENGTH=6 TABINDEX=1 class='outline' required/> &nbsp;&nbsp;

<button type="submit" id="Submit"  border="0" >Submit <img src="/icons/bullet_go.png" border="0" alt=""/></button> &nbsp;
<BR>
</form>

<br />


</div> <!-- #End DivTop# -->
		

			<div id="homelink" style="position:fixed;bottom:20px;right:20px;padding:15px;background:#eeeeee;color:#000000;" target="_SELF">
		<a href="http://tac-alert01/index.php" title="Get me back to the Alert Queue">Head back to the Alert System</a>
		</div>

	</body>
  </html>