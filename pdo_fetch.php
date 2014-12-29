<?php

$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";

try {
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

    /*** The SQL SELECT statement ***/
    $sql = "SELECT * FROM today_tickets ORDER BY Ticket DESC";

    /*** fetch into an PDOStatement object ***/
    $stmt = $dbh->query($sql);

    /*** echo number of columns ***/
    $result = $stmt->fetch(PDO::FETCH_NUM);
	
    /*** loop over the object directly ***/
    foreach($result as $key=>$val)
    {
    echo $key.' - '.$val.'<br />';
    }

    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>