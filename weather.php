<!DOCTYPE html>
<head>
		<link rel="stylesheet" href="css/RESET.css">
<script type="text/javascript" src="js/modernizr.js"></script>
<script src="jQuery/jquery-1.8.0.js"></script>
<script src="jquery/jquery-ui-1.8.23.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.default.css">
<style>
/*
body {
font-family: arial, tahoma, sans-serif;
font-size: 12px;
background: rgba(0,0,0,0.3);
color: #ffffff;
padding: 2em;
margin: 10px auto;
}
*/

#Container{
	display: inline-block;
	background: rgba(200,200,200,0.3);
	color: #f5fffa;
	border: 1px solid #bbbbbb;
	vertical-align: top;
	border-radius: 15px;
	margin: 10px auto;
	padding: 0.25em;
	}
	
	#Weather{
		display: block;
		background: rgba(80,160,250, 0.6);
		color: #ffffff;
		border-radius: 4px;
		padding: 1em;
		margin: 10px auto;
		border: 1px solid #bbbbbb;
		text-shadow: #888888 0.1em 0.1em 0.2em;
		text-align: justify;
		vertical-align: top;
		}
			#wIcon{
			float: left;
			padding: 1em;
			border-radius: 4px;
			}
				#time{
					font-family: arial, sans-serif;
					font-size: 10px;
					line-height: 2.1;
					text-align: right;
					float: right;
					clear: both;
					padding: 1em;
					}
	#temp, #humid, #realfeel{
		color: #eeff00;
		font-weight: bold;
		}

</style>

<script>
$(document).ready(function($) {
  $.ajax({
  url : "http://api.wunderground.com/api/679813d8a5bcf543/geolookup/conditions/q/IL/Chicago.json",
  dataType : "jsonp",
  success : function(parsed_json) {
  var location = parsed_json['location']['city'];
  var temp_f = parsed_json['current_observation']['temp_f'];
  var humidity = parsed_json['current_observation']['relative_humidity'];
  var Wreport = parsed_json['current_observation']['weather'];
  var wind = parsed_json['current_observation']['wind_string'];
  var visibility_mi = parsed_json['current_observation']['visibility_mi'];
  var time = parsed_json['current_observation']['observation_time'];
  var imgURL= parsed_json['current_observation']['image']['url'];
  var FeelsLike = parsed_json['current_observation']['feelslike_string'];
  var IconURL = parsed_json['current_observation']['icon_url'];
	$('#Weather')
	//<br> The Weather is brought to you by <img src='" + imgURL + "' height='25' width='75' /> <br>
		.append("<img id='wIcon' src='"+ IconURL +"' /> Current temperature in " + location + " is: <b id='temp'>" + temp_f + "°</b> with a humidity of: <b id='humid'>"+ humidity 
		+"</b> <br>Feels Like: <b id='realfeel'>"+ FeelsLike +"</b>. <p>Wind: <em>"+ wind +"</em>. </p> <hr width='50%'>The Weather is currently: "+ Wreport +", with a visibility of: "+ visibility_mi 
		+"mi. <br><span id='time'>"+ time +" </span>");

  }
  });
});
</script>
</head>
<body>
<div id="Container">
	<span id="Weather">
	</span>
</div>

</body>