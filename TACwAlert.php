<!DOCTYPE HTML>
<meta http-equiv="x-ua-compatible" content="IE=9">
<meta charset="utf-8">
<html lang="en">
<head>
	<link rel="shortcut icon" href="img/bookmark.ico" type="image/x-icon" />
<script src="jQuery/jquery-1.8.0.js"></script>
<script src="jquery/jquery-ui-1.8.23.min.js"></script>


<style >
body{
background: 888888;
color: 212121;
}

#tacWeather{
	position: fixed;
	bottom: 25%;
	left: 25%;
	width: 700px;
	height: 420px;
	z-index: 98;
	cursor: pointer;
}	

#Container{
	display: inline-block;
	background: rgba(200,200,200,0.15);
	color: #f5fffa;
	border: none;
	vertical-align: top;
	border-radius: 25px;
	padding: 0.5em;
	}
	
	#Weather{
		display: block;
		font-family: arial,verdana, sans-serif;
		font-size: 11px;
		background: rgba(75,105,150, 0.5);
		color: #ffffff;
		border-radius: 4px;
		padding: 0.25em;
		text-shadow: #888888 0.1em 0.1em 0.25em;
		text-align: left;
		vertical-align: bottom;
		}
			#wIcon{
			float: left;
			padding: 0.5em;
			border-radius: 8px;
			}
				#time{
					font-family: arial, sans-serif;
					font-size: 10px;
					line-height: 1.5;
					text-align: right;
					float: right;
					clear: both;
					padding: 0.05em;
					color: #ffffff;
					vertical-align: top;
					}
	#temp, #humid, #realfeel{
		color: #eeff00;
		font-weight: bold;
		}

</style>
</head>
<body>

<div id="tacWeather">


</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tacWeather').load('W2alert.php').fadeIn(2000);
	});
</script>

</body>
</html>