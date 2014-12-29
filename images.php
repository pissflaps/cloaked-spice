<!DOCTYPE html>
<?php

function getImage(){

  if (empty ($_POST['Ticket']  ) ){
    print "<div id='NoTicket' ><h2>Please enter a ticket. </h2></div>";
  }	
  else {
    $Ticket = $_POST['Ticket'];
	
$dbtype		= "mysql";
$dbhost        = "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";
  try {
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

    /*** The SQL SELECT statement ***/
    $sql = "SELECT Name FROM images where Ticket='$Ticket' ";

    /*** fetch into an PDOStatement object ***/
    $stmt = $dbh->query($sql);

    /*** echo number of columns ***/
    $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
	$rowcount = $stmt->rowCount();
   print "<h1>Found the following $rowcount image(s) for Ticket #$Ticket </h1>";
   print "<ul class='inline-list'>";
    for ($i=0;$i < $rowcount; $i++) {
      print "<li> <a href='$result[$i]'><img src='$result[$i]' /></a></li>";
    }
    print "</ul>";

    /*** print_r($result)
	      close the database connection ***/
    $dbh = null;
  }
    catch(PDOException $e)
      {
      echo $e->getMessage();
      }
  }
}
?>
<head>
<title>Image Attachments for TAC Alert</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <link rel="stylesheet" href="Foundation/css/foundation.min.css" type="text/css">
  <link rel="stylesheet" href="Foundation/icons/foundation-icons.css" type="text/css">
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script> 
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script> 
</head>
<body>
<span class="has-form">

<form name="TicketID" method="POST" ACTION="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="large-3 columns">
	  <div class="row">
        <div class="row collapse">
          <div class="medium-10 columns">
            <input type="text" name="Ticket" id="TicketNum" placeholder="Ticket" MAXLENGTH=6> 
        </div>
        <div class="small-2 columns">
          <button type="submit" class="button postfix">Go</button>
        </div>
      </div>
    </div>
  </div>
</form>
</span>

<div id="images" class="left">
<?php getImage(); ?>
</div>
</body>
</html>