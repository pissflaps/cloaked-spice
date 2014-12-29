	while($row = mysql_fetch_row($Listing)){ 
		
				$ids = mysql_fetch_assoc($Display);
					$id = $ids['Ticket'];
					$deletelink = "<img class='delete' id='del' border='0' src='icon_trash.png' height='15px' width='15px' title='Remove Ticket #$id' />";		
				echo "<tr id=$id>";
							foreach ($row as $cell)     
								echo "<td>$cell</td>";
								echo "<td>$deletelink</td>";
								echo "</tr>";
			}
};
	
	



		while($row = mysql_fetch_row($Listing)){ 
		
				$ids = mysql_fetch_assoc($Display);
					$id = $ids['Ticket'];
					$deletelink = "<img class='delete' id='del' border='0' src='icon_trash.png' height='15px' width='15px' title='Remove Ticket #$id' />";		
				echo "<tr id=$id>";
														
							foreach ($row as $cell)
list($ticket,$date,$stime,$eta,$priority,$site,$comments) = $cell;							
								echo "<td>$ticket</td><td>$date</td><td>$stime</td><td>$eta</td><td='notification'>$priority</td><td>$site</td><td>$comments</td>";
								echo "<td>$deletelink</td>";
								echo "</tr>";
			}
};


					while($row as $cell)
							$ticket=$row['Ticket'];
							$date=$row['Date'];
							$stime=$row['Stime'];
							$eta=$row['ETA'];
							$priority=$row['Priority'];
							$site=$row['Site'];
							$comm=$row['Comments'];													
								echo "<td>$ticket</td><td>$date</td><td>$stime</td><td>$eta</td><td class='notification'>$priority</td><td>$site</td><td>$comm</td>";
								echo "<td>$deletelink</td>";
								echo "</tr>";