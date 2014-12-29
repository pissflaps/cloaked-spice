<!DOCTYPE html>
<body>
<div id="topTable">
<?php


$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";

try {
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*** The SQL SELECT statement ***/
    $sql = "SELECT Ticket, Site, Deleted, removedby, NOW() FROM today_tickets ORDER BY UNIX_TIMESTAMP(Removed_Datetime) DESC LIMIT 1";

    /*** fetch into an PDOStatement object ***/
   $stmt = $dbh->query($sql);

    /*** echo number of columns ***/
    $result = $stmt->fetch(PDO::FETCH_NUM);
		 $Tval = $result[0];
		 $Sval = $result[1];
		 $Deleted = $result[2];
		 $Removedby = $result[3];
		 $NOW = $result[4];

    /*** loop over the object directly **
		echo '<table id="hello"><tbody>';
		
    foreach($result as $key=>$val)
    {
    echo '<tr><td id="key">'.$key.'</td> <td id="val">'.$val.'</td></tr>';
	}	
		echo '</tbody></table>';
    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
</div>

<div id="bottomTable" >
<b>Latest Activity: </b><?php echo substr($NOW, 10); ?> 
<br>
<type>
<?php
switch($Deleted) {

  case "X":
      echo "Ticket #" .$Tval ." for ". $Sval ." has been removed from the Queue by ". $Removedby ."<br>";
  break;
  
  case "R":
      echo "Ticket #". $Tval ." for ". $Sval ." has been returned to the Open Queue. <br>";
  break;
  
  case "N":
     echo "Ticket #". $Tval ." has been added to the Open Queue for ". $Sval ."<br>";
  break;
default:
   echo "Sorry, no recent activity has been recorded yet.";
break;
}
?>
</type>
</div>

</body>
</html>