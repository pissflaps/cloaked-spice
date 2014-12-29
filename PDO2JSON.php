<?php
/* // header("refresh: 5;"); // */
$DATE = date('n/j/Y');
$pdo = new PDO("mysql:dbname=dbase;host=localhost","infortel","T3lemanagement");
$statement = $pdo->prepare("SELECT Ticket, Date, Stime, ETA, Site, Priority, Comments, Removed_Datetime, Removedby, Creator from tickets where Deleted !='X' ORDER BY Ticket DESC");
 $result =  $statement->execute();

    
$totalCount = $statement->rowCount($result);
if($statement->rowCount($result)){
 //    echo "<b>". $totalCount ." open tickets:</b><br>";
    $first = true;
   while($row = $statement->fetchAll(PDO::FETCH_ASSOC)){
        //  cast results to specific data types
        if($first) {
            $first = false;
        } else {
            echo ',';
        }
$fp = fopen('dbase.json', 'w');
fwrite($fp, json_encode($row, JSON_PRETTY_PRINT));
fclose($fp);
        echo json_encode($row, JSON_PRETTY_PRINT);
		// return json_encode($result);
   }
} else {
  while($row = $statement->fetchAll(PDO::FETCH_ASSOC)){
  $fp = fopen('dbase.json', 'w');
  fwrite($fp, json_encode($row));
  fclose($fp);
        echo json_encode($row, JSON_PRETTY_PRINT);
    }
        echo "<center><h2>Hey! ". $totalCount ." tickets need a callback!</h2></center><br>";
 }

?>