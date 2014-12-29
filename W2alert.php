<script type="text/javascript">
$(document).ready( function($) {
	 $.ajax({
  url : "http://api.wunderground.com/api/679813d8a5bcf543/alerts/q/IL/Chicago.json",
  dataType : "jsonp",
  success : function(parsed_json) {
  var alerts = parsed_json['response']['features']['alerts'];
  var alertType = parsed_json['alerts']['description'];
  var date = parsed_json['alerts']['date'];
  var expires = parsed_json['alerts']['expires'];
  var message = parsed_json['alerts']['message'];

	$('#Weather')
		.append(alerts + " alerts have been established by Weather Underground. <br> Alert: <b  id='temp'>"+
		alertType +"</b> will expire at:" + expires +".<br> <b>"+	message +"</b> <br><span id='time'>"+ date +" </span>");

  },
  error: function(err){
	$('#Weather')
		.append("Something went wrong. Check your <b id='temp'>JSONP</b> response."+ err);
  }
 });
  
});
</script>
<div id="Container">
	<span id="Weather">
	</span>
</div>