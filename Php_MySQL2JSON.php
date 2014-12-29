<!DOCTYPE html>
<html ng-app>
 <head>
 <title> TAC Alert System - JSON test</title>
  <script src="js/Angular/Angular.js"></script>
  <script src="js/Angular/TacJSON.js"></script>
  <script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>
  <link rel="stylesheet" href="Bootstrap/css/Bootstrap.min.css" type="text/css">
<style>
	body{
		margin: 10px auto;
		padding: 10px;
	}
	p#JSONdump{ 
	padding: 10px auto;
	}
	#delTable td{
	display: table-cell;
	text-align: center;
	}
</style>
 </head>
 
<body >
<div id="JSON">
<h2>Ticket Listing in JSON <small><sup>(JavaScript-Oriented Notation)</sup></small> </h2>
</div>

  <div id="parsed" >
    <h1>Latest Ticket information: </h1>
	
  </div>

<br> 
<div id='JSONdump'  ng-controller="TacCtrl" ng-app>
	<table id="delTable" class="table table-striped table-bordered"> 
		<thead>
	<tr id="fields"><td>Ticket</td><td>Date</td><td>Start Time</td><td>E.T.A.</td><td>Priority</td><td>Site</td><td>Comments</td><td>Remove</td></tr>
		</thead>
	<tbody>
        <tr ng-repeat="ticket in response" > 
	<td id="{{ticket.Ticket}}"><b>{{ticket.Ticket}}</b></td>	
	<td>{{ticket.Date}}</td>
	<td>{{ticket.Stime}}</td>
	<td>{{ticket.ETA}}</td>
	<td>{{ticket.Priority}}</td>
	<td>{{ticket.Site}}</td>
	<td>{{ticket.Comments}}</td>
	<td id="DelCel"><a href="#" ng-click="remoteTicket"><img class="delete" id="del" border="0" src="icon_trash.png" height="25px" width="25px" title="Remove Ticket #{{ticket.Ticket}}" /></a> </td>
        </tr>
</table>
<p>
<h4><i class="icon-thumbs-up"></i> Fully Qualified JSON: </h4>		

	<pre class="pre-scrollable">
		{{ response }}
	</pre>
</p>
  </div>

  </div>
</body>

<script>
$(document).ready( function() {

 $.ajax({
  url : "http://tac-alert01/PDO2JSON.php?",
  dataType : "json",
  error : function(xhr, ajaxOptions, thrownError){
       $('#parsed').append("<b>Sorry</b>, something's not quite right here. <br>" + xhr.status + " , " + thrownError +" <br> "+ ajaxOptions);
   },
  success : function(parsed_json) {
  var Ticket = parsed_json['dbase'][0]['Ticket'];
  var Date = parsed_json['dbase'][0]['Date'];
  var Stime = parsed_json['dbase'][0]['Stime'];
  var ETA = parsed_json['dbase'][0]['ETA'];
  var Site = parsed_json['dbase'][0]['Site'];
  var Priority = parsed_json['dbase'][0]['Priority'];
  var Comments = parsed_json['dbase'][0]['Comments'];
  var OpenedBy = parsed_json['dbase'][0]['Creator'];
	$('#parsed').append("Ticket #<b>" + Ticket +"</b> was opened by "+ OpenedBy +" on "+ Date +" at "+ Stime +" with an ETA of "+ ETA +", for customer "+ Site +" with a priority of "+ Priority 
	+" and the associated comments: '<em>"+ Comments +"</em>'.<br> It has not yet been removed from the open queue.");
   }
  });
});  
</script>

</html>