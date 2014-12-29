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
</style>
</head>

<body>
<h1 class="subheader text-center">Search Tickets by Year</h1>
    <div id="Containerblock" class="panel callout clearfix">

<div id="iDate" class="has-form">
<FORM name="date"  id="input_date" TYPE="GET" ACTION="<?php $_SERVER['PHP_SELF']; ?>" >
<div class="medium-6 ">
<div class="row collapse">
  <div class="medium-2 columns">
       <span class="prefix">Enter Date:</span>
    </div>
    <div class="medium-3 columns">
	<select name="date">
	  <option value='null' selected>Choose Year</option>
	  <option value='2012'>2012</option>
	  <option value='2013'>2013</option>
	  <option value='2014'>2014</option>
	 </select>
        </div>
    <div class="medium-3 columns">
	 <select name="month">
	  <option value='null' >Choose Month</option>
	  <option value='01' >January</option>
	  <option value='02'>February</option>
	  <option value='03'>March</option>
	  <option value='04'>April</option>
	  <option value='05'>May</option>
	  <option value='06'>June</option>
	  <option value='07'>July</option>
	  <option value='08'>August</option>
	  <option value='09'>September</option>
	  <option value='10'>October</option>
	  <option value='11'>November</option>
	  <option value='12'>December</option>
	 </select>
      <!-- <INPUT TYPE="text" NAME="date" id="input_date" MAXLENGTH=4 placeholder="YYYY" tabindex="1" > -->
    </div></form>   
	<div class="medium-4 columns">
          	<input type="submit" class="button postfix" value="Submit!" />
        </div>

  </div>
</div>

</div> <!-- END #iDate -->

</div> <!-- END #Containerblock -->
<?php
require('session.php');

$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";
$date = $_GET['date'];
$month = $_GET['month'];

	if (!empty ($_GET['date'])) {
?>

<div id="rowCount" class="panel notice left"></div>
<div id="DBContainer" class="large-8" >
<table id="removed_tickets" class="large-8 columns centered text-center responsive">
<tr>
<th>Removed_On</th><th>Removed_By</th>
</tr>
<tbody>
<?php
try {
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

$sql = "SELECT * FROM dbase.removed_tickets order by REMOVED_ON ASC";
  $stmt = $dbh->prepare("SELECT Removed_On, LOGIN FROM dbase.removed_tickets where substr(Removed_On,1,4)= :date AND substr(Removed_On,6,2)= :month Group By Removed_On order by REMOVED_ON ASC");
    $stmt->setFetchMode(PDO::FETCH_NUM);			
      $stmt->execute(array(':date'=>$date,
                                  ':month'=>$month));

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
    echo '<tr><td>'.$val[0].'</td><td>'. $val[1] .'</td></tr>';
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
            echo '<div id="DataTable" class="alert-box warning text-center round">';
            echo "Query returns an empty result. <br> Please enter a year and try again.</div>";
}
?>

<script type="text/javascript">
    $(document).ready(function() {
      var $RowCounts = $("#removed_tickets  tr").length;
      var $COUNT = parseInt( ($RowCounts - 1), 10);
      $('#rowCount').html("<h1> Total count:"+ $COUNT +"</h1>");
    });
</script>  

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
</body>
</html>