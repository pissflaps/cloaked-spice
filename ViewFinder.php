<!DOCTYPE html>
<head>
<script type="text/javascript" src="jQuery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>

<style>
body {
background: #eeeeee;
text-align: center;
padding: 2px;
}

table td:nth-child(odd){
color: #f1f7f9;
background: #212121;
}

table td:nth-child(even){
color: #f1f7f9;
background: #888888;
}


/*		***		GROWL SECTION		***	*/

#growl {position: absolute;bottom:50px;left:0;
width:350px;
z-index: 99;
color: #ffffff;
padding: 1em;
display:inline-block;
border-radius: 4px;
}
	.notice {
		position: relative;
	}
	
	.skin {
		position: absolute;
		background: rgba(0, 0, 0, 0.5); 
		bottom: 0;
		left: 0;
		right: 0;
		top: 0;
		z-index: -1;
		border-radius: 4px;
	}
	.content{
		display:block;
		padding: 25px;
		margin-left: 5px;
		font-weight: bold;
		background: rgba(0,0,0,0.5);
		background-position: bottom right;
	}
	
	.Gclose {
		vertical-align: top;
		float:right;
		font-family: Arial Black, Impact, Arial sans-serif;
		font-size: 11pt;
		color: #FF0000;
		padding: 2px;
	}	
</style>
</head>
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

    /*** The SQL SELECT statement ***/
    $sql = "SELECT Ticket, Site, Deleted FROM today_tickets ORDER BY Ticket DESC LIMIT 1";

    /*** fetch into an PDOStatement object ***/
    $stmt = $dbh->query($sql);

    /*** echo number of columns ***/
    $result = $stmt->fetchall(PDO::FETCH_NUM);
		 $Tval = $result[0];
		 $Sval = $result[1];
		 $Deleted = $result[2];

    /*** loop over the object directly ***/
		echo '<table id="hello"><tbody>';
		
    foreach($result as $key=>$val)
    {
    echo '<tr><td id="key">'.$key.'</td> <td id="val">'.$val.'</td></tr>';
	}	
		echo "</tbody></table>";
    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
</div>

<div id="bottomTable">
<?php
switch ($Deleted)
{
case 'R':
  echo "<script> Returned(); </script>";
  break;
case 'X':
  echo "<script> Deleted(); </script>";
  break;

default:
  echo "<script> Added(); </script>";
}
?>

<br> Thanks!
</div>
<div id="growl"></div>	
<div id="notice"></div>	
<script type="text/javascript">
var SVAL = "<?php echo $Sval; ?>";
var TVAL = "<?php echo $Tval; ?>";

function addNotice(notice){
	$('<div class="notice"></div>')
		.append('<div class="skin"></div>')
		.append('<b class="Gclose" title="Close Notice">x</b>')
		.append($('<div class="content"></div>').html($(notice)) )
		.hide()
		.appendTo('#growl')
		.fadeTo('slow', 0.33)
	    .animate({
    top: '-=405',
    opacity: '0.8',
    left: '-10',
    }, 1500);
	$('.notice').fadeOut(4500);
	};
	
function Returned(){ 
addNotice('Ticket#'+ TVAL +' for '+ SVAL +' has been returned to the Open Queue.'); 
}

function Added() {
addNotice('Ticket#'+ TVAL +' for '+ SVAL +' has been added into the Open Queue.'); 
}

function Deleted() {
addNotice('Ticket#'+ TVAL +' for '+ SVAL +' has been removed from the Queue.'); 
}
</script>
</body>
</html>