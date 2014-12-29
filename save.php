<?php require_once("session.php");
$db_host = 'localhost';
$db_user = 'infortel';
$db_pwd = 'T3lemanagement';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
global $content;

	$con = mysql_connect($db_host, $db_user, $db_pwd);
		mysql_select_db($database);
	
	if(! isset($_SESSION['myusername'])) {
				if(empty($_COOKIE['LoggedInAs']) ){
					$user = $_SERVER['REMOTE_ADDR'];
				} else {
				$user = $_COOKIE['LoggedInAs'];
				}
	}
		else{
			$user = $_SESSION['myusername'];
		}

	$content = implode(",", $_POST['content']);
		$pieces = explode(",", $content);
			list($T,$P,$S,$C,$c4,$cP) = $pieces;
			$C = filter_var($C, FILTER_SANITIZE_STRING);
			
  //	$sql = "UPDATE content SET T = '$content'	WHERE element_id = '1' ";
// UPDATE tickets SET Ticket='$T', Priority='$P', Site='$S', Comments='$C' WHERE Ticket='$C4'";

//    $result = "INSERT into dbase.tickets (Ticket,Priority,Site,Comments,ContactPref,Deleted,Creator) VALUES ('$T','$P','$S','$C','$cP','R','$user') ON DUPLICATE KEY UPDATE Ticket=VALUES(Ticket),Priority=VALUES(Priority),Site=VALUES(Site),Comments=VALUES(Comments),ContactPref=VALUES(ContactPref),Deleted=VALUES(Deleted),Creator=VALUES(Creator)";
  $result ="UPDATE tickets SET Ticket='$T',Priority='$P',Site='$S',Comments='$C',ContactPref='$cP',Deleted='R',Creator='$user' WHERE Ticket='$c4' ";
			if (mysql_query($result, $con)){
				echo '1';
/* 			*** RUN THIS IF THE TICKET SHOULD BE BROUGHT BACK INTO THE ALERT SYSTEM ***				
				mysql_query("UPDATE tickets SET Deleted='R' WHERE Ticket='$C4'",$con);
*/
exit();
			}
			else {
				echo "Please notify Jim: <br>". mysql_error();
				exit();
			}
?>