<?php
require_once('database.php'); 
require('session.php');

$db=mysql_connect('localhost', 'infortel', 'T3lemanagement') or die('Could not connect');
mysql_select_db('dbase', $db) or die('');
$DATE = date('n/j/Y');

$result = mysql_query("SELECT Ticket, Date, Stime, ETA, Site, Priority, Comments, Removed_Datetime, Removedby, Creator from tickets where Deleted !='X' ORDER BY Stime DESC") or die('Could not query');

if(mysql_num_rows($result)){
echo'{"dbase" : [ ';
    $first = true;
    $row=mysql_fetch_assoc($result);
    while($row=mysql_fetch_row($result)){
        //  cast results to specific data types
				

        if($first) {
            $first = false;

        } else {
		
            echo ',';
        }
		
	$data = ( $row['Tickets'][] = array('Ticket' => $row[0],'Date' => $row[1], 'Stime' => $row[2], 'ETA' => $row[3], 'Site' => $row[4], 'Priority' => $row[5], 'Comments' => $row[6], 'Removed_Datetime' => $row[7], 'Removedby' => $row[8], 'Creator' => $row[9]) );
        echo "<pre>". json_encode($data, JSON_PRETTY_PRINT) ."</pre>";
    }
    echo ']}';

} else {
    echo '{"dbase" : [] }';
}

mysql_close($db);

?>