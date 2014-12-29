<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
</head>

<body>

<?php
require('session.php');

$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";
$DATE = date('n/j/Y');
$Tdate = date('Y-m-d');

	if (!empty ($Tdate)) {
?>
    <div id="chart_div" class="clearfix left"></div>
<div id="DBContainer" class="large-8" style="display:none;">
<table id="removed_tickets" class="large-8 columns centered text-center responsive">
<tr>
<th>Removed_On</th><th>Removed_By</th>
</tr>
<tbody>
<?php
try {
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

$sql = "SELECT * FROM dbase.removed_tickets order by REMOVED_ON ASC";
  $stmt = $dbh->prepare("SELECT Removed_On, LOGIN FROM dbase.removed_tickets where Removed_On like ? Group By Removed_On order by REMOVED_ON ASC");
    $stmt->setFetchMode(PDO::FETCH_NUM);			
      $stmt->execute(array("$Tdate%") );

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
    echo "<tr class=".strtolower($val[1])."><td>".$val[0]."</td><td>". $val[1] ."</td></tr>";
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
</div>
<?php 
  }else {
            echo "<div id='DataTable' class='alert-box warning text-center round'>";
            echo "Query returns an empty result. <br> Please enter a year and try again.</div>";
}
?>

<script type="text/javascript">
    $(document).ready(function() {
      var $RowCounts = $("#removed_tickets  tr").length;
      var $COUNT = parseInt( ($RowCounts - 1), 10);
      $('#rowCount').html("<h1> Total Tickets:"+ $COUNT +"</h1>");
    });
</script>  

  <!-- // Per the FOUNDATION docs, load all external libraries near the end of BODY in the DOM -->
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
  <script type="text/javascript" src="js/googleAjax.js"></script>
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
var $dino = document.getElementsByClassName("dino");
var $dennis = document.getElementsByClassName("dgrondin")
var $dschmitt = document.getElementsByClassName("dschmitt");
var $dwoods = document.getElementsByClassName("dwoods");
var $jim = document.getElementsByClassName("jim");
var $jdehlin = document.getElementsByClassName("jdehlin");
var $jscholtens = document.getElementsByClassName("jscholtens");
var $mrsikes = document.getElementsByClassName("mrsikes");
var $mstratton = document.getElementsByClassName("mstratton");
var $pmathewsian = document.getElementsByClassName("pmathewsian");
var $rburquist = document.getElementsByClassName("rburquist");
var $shoctor = document.getElementsByClassName("shoctor");
var $sgarcia = document.getElementsByClassName("sgarcia");
var $terry = document.getElementsByClassName("terry");
var $tgarza = document.getElementsByClassName("tgarza");
var $tiver = document.getElementsByClassName("tiver43809");
var $vvrba = document.getElementsByClassName("vvrba");

        var data = new google.visualization.arrayToDataTable([
		['Login', 'Tickets', {'role' : 'style' }, { 'role': 'annotation' } ],
		  ['Admin', $admin.length, '#1abc9c', $admin.length],
          ['Allen', $abaum.length,'#2ecc71', $abaum.length],
          ['Andrew', $apark.length,'#3498db', $apark.length],
          ['Dan', $dschmitt.length,'#34495e', $dschmitt.length],
          ['Dennis', $dennis.length,'#c0392b', $dennis.length],
          ['Dino', $dino.length,'#9b59b6', $dino.length],
          ['Dorothy', $dwoods.length,'#3aa95e', $dwoods.length],
          ['Jim M', $jim.length,'#f1c40f', $jim.length],
          ['Jim S', $jscholtens.length,'#f39c12', $jscholtens.length],
          ['Jon', $jdehlin.length,'#e74c3c', $jdehlin.length],
          ['Matt', $mrsikes.length,'#16a085',$mrsikes.length],
          ['Mike', $mstratton.length,'#27aa60',$mstratton.length],
          ['Peter', $pmathewsian.length,'#2c3e50',$pmathewsian.length],
          ['Ray', $rburquist.length,'#8e44ad',$rburquist.length],
          ['Sarah', $shoctor.length,'#95a5a6', $shoctor.length],
          ['Sonia', $sgarcia.length,'#95a5a6', $sgarcia.length],
		  ['Terry', $terry.length,'#d35400',$terry.length],
          ['Tom', $tgarza.length,'#7f8c8d',$tgarza.length],
          ['Tiver43809', $tiver.length,'#d35400',$tiver.length],
          ['Victor', $vvrba.length,'#DC143C',$vvrba.length]
		]);
		
var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                             { calc: "stringify",
                               sourceColumn: 1,
                               type: "string",
                               role: "annotation" },
                              2]);		
//        var data = new google.visualization.DataTable();
//        data.addColumn('string', 'Login');
//        data.addColumn('number', 'Tickets');
//        data.addRows([   ]);

        // Set chart options
        var options = {'title':'TAC Alert Stats for Today:',
		               'hAxis': {'title': 'Tickets Called Back', 'minValue': '6', 'format':'#', 'titleTextStyle': {'fontName': 'Verdana', 'color' : '#000000', 'italic' :'false', 'fontSize' : '14'} },
                       'width':600,
                       'height':400,
					   'backgroundColor': '#bbbbbb',
                       bar: {groupWidth: "95%"},
                       'legend': { 'position': 'none' }
					   };
// 					   'colors': ['#1abc9c','#2ecc71','#3498db','#9b59b6','#34495e','#f1c40f','#e74c3c','#f39c12','#16a085','#27ae60','#2980b9','#2c3e50','#8e44ad','#95a5a6','#c0392b','#d35400','#7f8c8d' ],
var chart_div = document.getElementById('chart_div');
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
		 google.visualization.events.addListener(chart, 'ready', function () {
        chart_div.innerHTML = '<a target="_NEW" href="http://tac-alert01/statistics.php" alt="Look at stats!" title="View statistics!"> <img src="' + chart.getImageURI() + '" /></a>';
        // console.log(chart_div.innerHTML);
      });		
        chart.draw(view, options);
      };
</script>
</body>
</html>