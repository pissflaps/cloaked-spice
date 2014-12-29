<?php
require_once('database.php');

function WhoIsLoggedIn() {
 
		date_default_timezone_set('America/Chicago');
		$LastLogged = date('n/j/Y');
 $Whois = mysql_query("select username from dbase.members where LastLoggedIn like '$LastLogged%' ORDER BY username ASC");
$WhoLogged = array(); 
 while($row = mysql_fetch_assoc($Whois)){
		array_push($WhoLogged, $row['username']);
	}
	
  echo "&nbsp; <span id='WhoIs'><em>Logged in today:</em> <b>";
  if(!empty($WhoLogged) ){
	foreach( $WhoLogged as $user){
		echo "&nbsp;". $user ." &nbsp";
	}
	
}
	else{
		echo "&nbsp;" . "Nobody has logged in yet today!";
	}	
echo "</b></span>";
}
	
WhoIsLoggedIn();

?>
