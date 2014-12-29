<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
    <title>TAC's Removed Tickets</title>
  <!-- // Style sheets loaded in succession for structure elements and button layout configuration -->
  <link rel="stylesheet" href="css/production.css" type="text/css">
  <link rel="stylesheet" href="Foundation/css/foundation.min.css" type="text/css">
  <link rel="stylesheet" href="Foundation/icons/foundation-icons.css" type="text/css">
<style>
body {
padding-top: 10px;
}
</style>
</head>
<body>
<br>


<div id="chartdiv"><p>
<?php echo"<div id='allgone'><h2><b class='shadowZ'> Great job ". ucwords($login) .", all tickets have been called on</b>!</h2>
						<span id='all_clear' class='alert-box secondary radius'><font id='DateTimeString'>". $today .": </font>
							<h4>
							There have been <b> ". $DailyCount ."</b> tickets opened and
								<h4 class='subheader'>
								&nbsp;<b>". $Removed_Today ."</b> tickets have been removed from the queue.</h4></span> 
								    <div id='chartdiv' class='clearfix centered'><p>";
									include('dstat.php');
									echo "</p></div> </div>";
?>
</p>
</div>
</body>

</html>
