<?php
error_reporting(E_ALL ^ E_NOTICE); 
require('session.php');

$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";

$year = ( $_GET['year'] ? $_GET['year'] : date('Y') );
$month = ( $_GET['month'] ? $_GET['month'] : date('n') );
$day = ( $_GET['day'] ? $_GET['day'] : date('j') );
?>
<!DOCTYPE html>
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
#Containerblock {
display: inline;
background-color: #7f8c8d;
color: #212121;
padding: 10px auto;
}
</style>
</head>

<body>
<h1 class="text-center"><u> Tickets Statistics </u> </h1>
    <div id="Containerblock" class="clearfix centered">

<div id="iDate" class="has-form">
<div class="row">
<FORM name="datemonth"  id="input_date" TYPE="GET" ACTION="<?php $_SERVER['PHP_SELF']; ?>" >
<div class="large-6 medium-offset-3"> 
<div class="row collapse">
  <div class="large-2 columns">
       <span class="prefix ">Enter Date:</span>
    </div>
    <div class="large-3 columns">
	 <select name="month">
	  <option value='null' >Choose Month</option>
	  <option <?php if ($month == '01' ) echo 'selected'; ?> value='01' >January</option>
	  <option <?php if ($month == '02' ) echo 'selected'; ?> value='02'>February</option>
	  <option <?php if ($month == '03' ) echo 'selected'; ?> value='03'>March</option>
	  <option <?php if ($month == '04' ) echo 'selected'; ?> value='04'>April</option>
	  <option <?php if ($month == '05' ) echo 'selected'; ?> value='05'>May</option>
	  <option <?php if ($month == '06' ) echo 'selected'; ?> value='06'>June</option>
	  <option <?php if ($month == '07' ) echo 'selected'; ?> value='07'>July</option>
	  <option <?php if ($month == '08' ) echo 'selected'; ?> value='08'>August</option>
	  <option <?php if ($month == '09' ) echo 'selected'; ?> value='09'>September</option>
	  <option <?php if ($month == '10' ) echo 'selected'; ?> value='10'>October</option>
	  <option <?php if ($month == '11' ) echo 'selected'; ?> value='11'>November</option>
	  <option <?php if ($month == '12' ) echo 'selected'; ?> value='12'>December</option>
	 </select>
    </div><div class="large-2 columns">
	 <select name="day">
	  <option value='null' >Day</option>
	  <option <?php if ($day == '01' ) echo 'selected'; ?> value='01' >01</option>
	  <option <?php if ($day == '02' ) echo 'selected'; ?> value='02'>02</option>
	  <option <?php if ($day == '03' ) echo 'selected'; ?> value='03'>03</option>
	  <option <?php if ($day == '04' ) echo 'selected'; ?> value='04'>04</option>
	  <option <?php if ($day == '05' ) echo 'selected'; ?> value='05'>05</option>
	  <option <?php if ($day == '06' ) echo 'selected'; ?> value='06'>06</option>
	  <option <?php if ($day == '07' ) echo 'selected'; ?> value='07'>07</option>
	  <option <?php if ($day == '08' ) echo 'selected'; ?> value='08'>08</option>
	  <option <?php if ($day == '09' ) echo 'selected'; ?> value='09'>09</option>
	  <option <?php if ($day == '10' ) echo 'selected'; ?> value='10'>10</option>
	  <option <?php if ($day == '11' ) echo 'selected'; ?> value='11'>11</option>
	  <option <?php if ($day == '12' ) echo 'selected'; ?> value='12'>12</option>
	  <option <?php if ($day == '13' ) echo 'selected'; ?> value='13'>13</option>
	  <option <?php if ($day == '14' ) echo 'selected'; ?> value='14'>14</option>
	  <option <?php if ($day == '15' ) echo 'selected'; ?> value='15'>15</option>
	  <option <?php if ($day == '16' ) echo 'selected'; ?> value='16'>16</option>
	  <option <?php if ($day == '17' ) echo 'selected'; ?> value='17'>17</option>
	  <option <?php if ($day == '18' ) echo 'selected'; ?> value='18'>18</option>
	  <option <?php if ($day == '19' ) echo 'selected'; ?> value='19'>19</option>
	  <option <?php if ($day == '20' ) echo 'selected'; ?> value='20'>20</option>
	  <option <?php if ($day == '21' ) echo 'selected'; ?> value='21'>21</option>
	  <option <?php if ($day == '22' ) echo 'selected'; ?> value='22'>22</option>
	  <option <?php if ($day == '23' ) echo 'selected'; ?> value='23'>23</option>
	  <option <?php if ($day == '24' ) echo 'selected'; ?> value='24'>24</option>
	  <option <?php if ($day == '25' ) echo 'selected'; ?> value='25'>25</option>
	  <option <?php if ($day == '26' ) echo 'selected'; ?> value='26'>26</option>
	  <option <?php if ($day == '27' ) echo 'selected'; ?> value='27'>27</option>
	  <option <?php if ($day == '28' ) echo 'selected'; ?> value='28'>28</option>
	  <option <?php if ($day == '29' ) echo 'selected'; ?> value='29'>29</option>
	  <option <?php if ($day == '30' ) echo 'selected'; ?> value='30'>30</option>
	  <option <?php if ($day == '31' ) echo 'selected'; ?> value='31'>31</option>
	 </select>
    </div>
	<div class="large-2 columns">
	<select name="year">
	  <option value='null' selected>Choose Year</option>
	  <option <?php if ($year == '2012' ) echo 'selected'; ?>  value='2012'>2012</option>
	  <option <?php if ($year == '2013' ) echo 'selected'; ?> value='2013'>2013</option>
	  <option <?php if ($year == '2014' ) echo 'selected'; ?> value='2014'>2014</option>
	 </select>
        </div>
  </form> 
	 <div class="large-3 columns">
          	<input type="submit" class="small radius button success postfix" value="Statistics!"></input>
     </div>
 
    </div> <!-- END .row collapse -->
	  </div> <!-- END .row -->
</div>

</div> <!-- END #iDate -->
<?php 
	if (!empty ($_GET['year']) ) {
	
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
?>

<div id="donutchart" class="large-3 left"></div>
<div id="DBContainer" class="large-10" data-equalizer>
<!-- <div id="rowCount" class="panel left" data-equalizer-watch></div> -->
<table id="LABEL" class="right">
<script type="text/javascript">
    $(document).ready(function() {
      var $RowCounts = $("#removed_tickets  tr").length;
      var $COUNT = parseInt( ($RowCounts - 1), 10);
      $('#header').html("<h4 class='subheader'>"+ $COUNT +" Tickets Removed.</h4>");
    });
</script>  
<tr>
<th id='header'></th>
<th><?php print "<h4 class='subheader'>Date Chosen: ". $month."/".$day."/".$year." </h4>"; ?></th>
</tr>
</table>
<table id="removed_tickets" class="large-8 columns right text-center responsive" >
  <thead>
    <tr>
      <th>Removed_On</th><th>Removed_By</th><th class='text-center'>Customer</th>
    </tr>
  </thead>
<tbody>
<?php
try {


$sql = "SELECT * FROM dbase.removed_tickets order by REMOVED_ON ASC";
  $stmt = $dbh->prepare("SELECT Removed_On, LOGIN, Customer FROM dbase.removed_tickets where substr(Removed_On,1,4)= :year AND substr(Removed_On,6,2)= :month AND substr(Removed_On,9,2)= :day  Group By Removed_On order by REMOVED_ON ASC");
    $stmt->setFetchMode(PDO::FETCH_NUM);			
      $stmt->execute(array(':year'=>$year,
                                  ':month'=>$month,
								  ':day'=>$day));

	  //      $stmt->execute(array("$date%"));
      $RowCount= $stmt->rowCount();

    /*** fetch into an PDOStatement object **
    $stmt = $dbh->query($sql); */

    /*** echo number of columns **
    $result = $stmt->fetchall(PDO::FETCH_NUM); */
	

			$result = $stmt->fetchAll();

    /*** loop over the object directly ***/
    foreach($result as $key=>$val)
    {
    echo "<tr class=".strtolower($val[1])."><td>".$val[0]."</td><td>". $val[1] ."</td><td>". $val[2] ."</td></tr>";
    }
    /*** close the database connection ***/
    $dbh = null;
}	
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
</tbody>
</table>
    </div>
<?php 
  } else {
            echo "<div id='DataTable' class='alert-box warning text-center round'>";
            echo "Query returns an empty result. <br> Please enter a year and try again.</div>";
}
?>

</div> <!-- END #Containerblock -->



  <!-- // Per the FOUNDATION docs, load all external libraries near the end of BODY in the DOM -->
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
  <!-- // Foundation.min contains all modules in the event of expansion being needed into other library functions -->
<script type="text/javascript" src="Foundation/Tables/responsive-tables.js"></script>
  <!-- // Responsive Tables Plug-in provided by Foundation Framework // -->
  <!-- // jQuery and Foundation frameworks apply before DOM load -->
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
  <!-- // Load Foundation vendor-specific library additions -->
<script type="text/javascript" src="js/jQuery_Plugins.js"></script>
<!-- // Compressed version of all related vendor plug-ins used in jQuery -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
  function drawChart() {
var $admin = document.getElementsByClassName("admin");
var $abaum = document.getElementsByClassName("abaum");
var $apark = document.getElementsByClassName("apark");
var $dino= document.getElementsByClassName("dino");
var $dschmitt= document.getElementsByClassName("dschmitt");
var $dwoods= document.getElementsByClassName("dwoods");
var $jim= document.getElementsByClassName("jim");
var $jdehlin= document.getElementsByClassName("jdehlin");
var $jscholtens= document.getElementsByClassName("jscholtens");
var $mrsikes= document.getElementsByClassName("mrsikes");
var $mstratton= document.getElementsByClassName("mstratton");
var $pmathewsian= document.getElementsByClassName("pmathewsian");
var $rburquist= document.getElementsByClassName("rburquist");
var $shoctor= document.getElementsByClassName("shoctor");
var $terry= document.getElementsByClassName("terry");
var $tgarza= document.getElementsByClassName("tgarza");
var $tiver= document.getElementsByClassName("tiver43809");
var $vvrba= document.getElementsByClassName("vvrba");

        var data = new google.visualization.arrayToDataTable([
		['Login', 'Tickets', {'role' : 'style' }, { 'role': 'annotation' } ],
		  ['Admin', $admin.length, '#1abc9c', $admin.length],
          ['Abaum', $abaum.length,'#2ecc71', $abaum.length],
          ['Apark', $apark.length,'#3498db', $apark.length],
          ['Dino', $dino.length,'#9b59b6', $dino.length],
          ['Dschmitt', $dschmitt.length,'#34495e', $dschmitt.length],
          ['Dwoods', $dwoods.length,'#3aa95e', $dwoods.length],
          ['Jim', $jim.length,'#f1c40f', $jim.length],
          ['Jdehlin', $jdehlin.length,'#e74c3c', $jdehlin.length],
          ['Jscholtens', $jscholtens.length,'#f39c12', $jscholtens.length],
          ['Mrsikes', $mrsikes.length,'#16a085',$mrsikes.length],
          ['Mstratton', $mstratton.length,'#27aa60',$mstratton.length],
          ['Pmathewsian', $pmathewsian.length,'#2c3e50',$pmathewsian.length],
          ['Rburquist', $rburquist.length,'#8e44ad',$rburquist.length],
          ['Shoctor', $shoctor.length,'#95a5a6', $shoctor.length],
          ['Terry', $terry.length,'#d35400',$terry.length],
          ['Tgarza', $tgarza.length,'#7f8c8d',$tgarza.length],
          ['Tiver43809', $tiver.length,'#d35400',$tiver.length],
          ['Vvrba', $vvrba.length,'#DC143C',$vvrba.length]
		]);
		
        // Set chart options
        var options = {'title':'Whom Removed How Many Tickets',
                       'width':450,
                       'height':400,
                       'tooltip.text': 'both',
					   'backgroundColor': 'transparent',
                       'pieStartAngle': 90,
                       'pieHole': 0.25 };
// 					   'colors': ['#1abc9c','#2ecc71','#3498db','#9b59b6','#34495e','#f1c40f','#e74c3c','#f39c12','#16a085','#27ae60','#2980b9','#2c3e50','#8e44ad','#95a5a6','#c0392b','#d35400','#7f8c8d' ],
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
</body>
</html>