<?

/**
 * Connect to the mysql database.
 */
 
$conn = mysql_connect("localhost", "infortel", "T3lemanagement") or die(mysql_error());
mysql_select_db('dbase', $conn) or die(mysql_error());


?>