<?php

$browser  =  $_SERVER['HTTP_USER_AGENT'] ;

$ip  =  $_SERVER['REMOTE_ADDR'] ;

$db  =  mysql_connect ( "localhost" , "infortel" , "T3lemanagement" );

mysql_select_db ( "dbase" , $db );

$sql  =  "INSERT INTO dbase.stats(ip,browser,received) VALUES('$ip','$browser',now())" ;

$results  =  mysql_query ( $sql);


print $browser ."<br>";
print $ip;

?>