<!DOCTYPE html>
<html>
<head>

<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<title>TAC's Alert System</title>
	<base href="http://tac-alert01/index_hde.php">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="/js/thickbox.js"></script>
		<script type="text/javascript" src="/js/jquery.form.js"></script> 
		<script src="jquery.ui.widget.js"></script>
				<link rel="stylesheet" href="/css/thickbox.css" type="text/css" />
  <link href="/jQuery/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
  <link href="/css/jquery.ui.button.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="/js/jquery.ui.button.js"></script> 
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script type="text/javascript" src="/js/jquery.cookie.js"></script>
  		  		<link rel="stylesheet" href="/css/hotdogstand.css" type="text/css" />
		<script type="text/javascript">
		window.setTimeout(' window.location="http://tac-alert01/index_hde.php"; ', 500000);
		
$(document).ready(function () {
    $('table#delTable td a.delete').click(function () {
        if (confirm("Are you sure you want to remove this ticket?")) {
            var id = $(this).parent().parent().attr('id');
            var data = 'id=' + id;
            var parent = $(this).parent().parent();

            $.ajax({
                type: "POST",
                url: "delete_row.php?id=$id",
                data: data,
                cache: false,

                success: function () {
                    parent.fadeOut(1500, function () {
                        $(this).remove();
                    });
                }
            });
        }
    });

    // style the table with alternate colors
    // sets specified color for every odd row
    $('table#delTable tr:odd').css('background', ' #FF0000');
	$('table#delTable tr:even').css('background', ' #DADADA');
    $('table#delTable tr:first').css('background', ' #FFFFFF');
	$('div#mail').css({
	'background' : '#000000',
	'color' : '#FFFFFF'
	});
    $(function() {
		$( "#draggable" ).draggable();
	});
	$(function () {
        $("button").button();
    });


});
</script>
<script>
		$(document).ready(function () { 
		    $('button#one ').live('click', function (red) {
			window.setTimeout(' window.location="http://tac-alert01/index.php"; ', 5);
		    });
		});
		
		</script>
		
			<script type="text/javascript">
		$(document).ready(function() {
	if ( window.addEventListener ) {
        var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
        window.addEventListener("keydown", function(e){
                kkeys.push( e.keyCode );
                if ( kkeys.toString().indexOf( konami ) >= 0 ) {
                        $('img').css('-webkit-transition-duration', '10s').css('-webkit-transform', 'rotate(360deg)');
                        $('a,p,span,h1,h2,h3,input').css('-webkit-transition-duration', '10s').css('-webkit-transform', 'rotate(-360deg)');
                        $('img').css('-moz-transition-duration', '10s').css('-moz-transform', 'rotate(360deg)');
                        $('a,p,span,h1,h2,h3,input').css('-moz-transition-duration', '10s').css('-moz-transform', 'rotate(-360deg)');
                }
        }, true);
} 
});
	</script>
	<script>
$(document).ready(function(){
	$('div.links').css('display', 'none');
		$('div.themes').css('display', 'none');
		$('button#linkswrap').live("click", function() {
			$('button#linkswrap').hide("slide", {direction : "right" }, 250);
				$('div.links').show("slide", { direction: "left" }, 1500);
		});
			$('button#themes').live("click", function() {
				$('button#themes').hide("slide", {direction : "right" }, 250);
					$('div.themes').show("slide", { direction: "left" }, 1000);
			});		
		
		$('div.fade').show("slide", { direction: "down" }, 1500);
	$('div.links').hover(function(){
    $(this).animate({
    opacity: 0.95,
  }, 500 );
  },
  function(){
	$(this).animate({
	opacity:0.25,
	}, 500 );
	});
		$('button.fade2').live("click", function(){
		$('div.fade').hide("slide", { direction: "down" }, 900);
		});
		$('table, button, tr, span, a, p, div, textarea, input, img').addClass('corners');
  });
</script>
	<style>
	@font-face {
	font-family: Script MT Bold;
	src: url('SCRIPTBL.ttf');
}
</style>
</head>
	<body>
 <button class="bw" id="linkswrap">Links</button>
<div align="left" class="links">
<img src="icons/house.png" /> <a href="http://www.isi-info.com" title="The ISI Homepage" class="external" target="_new">ISI-Info</a> &nbsp;<img src="icons/folder_magnify.png" /> <a href="http://tac-wiki/wiki/index.php/Help:How_to_Search#Sphinx_Search" class="external" title="How to Search the Wiki" target="_NEW">Wiki Search Help</a> &nbsp;<img src="icons/chart_organisation.png" /> <a href="http://thesource.isi-info.com/service/default.aspx" class="external" title="The Source" target="_new">The Source</a> &nbsp;
<img src="icons/isicon.gif" /> <a href="http://tac-wiki/wiki/index.php" title="The ISI Wikibase" class="external" target="_new">Wikibase</a> &nbsp;<img src="icons/email.png" /> <a href="https://bex1.isi-info.com/owa" class="external" title="ISI's Remote Email Login" target="_NEW">Remote Email</a> &nbsp;<img src="icons/information.png"  /> <a href="http://tac-wiki/wiki/index.php/Help:How_to_Use_the_TAC_Alert_System" class="external" title="How to use the NEW Alert System" target="_new">Alert System Help</a> 
</div>

<div id="Container">

<div id="column_left">
<div id="mail" align="left" style="position:static; padding:1px; top:0px;"><img src="icons/email_add.png" />  
<a href="emails.html?TB_iframe=true&height=600&width=400&modal=false" title="Email Recipients" class="thickbox"> Who's getting emails?</a> 
</div><br>
	<span align="left" id="tabs" style="position:static; left:0; float:left;">
	<a href="http://tac-alert01/datefind.php" class="int" target="_NEW" title="Generate Ticket Statistics"> Ticket Statistics</a></span>
		<br><br />
	<span align="left" id="tabs" style="position:static; left:0; float:left;"><a href="tickadd.php?TB_iframe=true&height=400&width=800&modal=false" id="int" title="Add a Ticket back into the queue." class="thickbox"> TAC's Ticket Adder</a></span>
<table id="submissionForm">
<tr>
<div align="right">

<FORM name="Tsubmit" ACTION="sqlinsert.php" METHOD="POST">
<font class="title">Priority:</font>&nbsp;
<span>
<input type="radio" NAME="priority" id="radio1" VALUE="2" checked /><label for="radio1">2</label>
<input type="radio" NAME="priority" id="radio2" VALUE="4" /><label for="radio2">4</label>
<input type="radio" NAME="priority" id="radio3" VALUE="9" /><label for="radio3">9</label>
</span>
<br>

<INPUT TYPE="text" style="border:1px dashed #808080; padding:1px;" class="text" NAME="ticket" id="TicketNumber" tabindex="1" MAXLENGTH=6 value="Ticket Number" placeholder="Ticket Number" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required> 
<br>
<INPUT TYPE="text" NAME="siteName" style="border:1px dashed #808080; padding:1px;" class="text" id="SiteName" MAXLENGTH=45 placeholder="Site Name" value="Site Name" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" tabindex="2" required>
<br><br />

<TEXTAREA type="text" style="border:1px dashed #808080; padding:2px;" id="comments" class="comments" NAME="comments" cols=25 rows=5 scrolling="no" VALUE="COMMENTS" tabindex="3" placeholder="Please enter any comments." onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" ></TEXTAREA>
<br>
<Button TYPE="submit" class="positive" NAME="Submit" VALUE="Submit"  border="0" ><img src="/icons/page_white_add.png" border="0" alt=""/> Submit</button>
&nbsp;<Button TYPE="reset" id="reset" class="negative2" NAME="Reset" VALUE="Reset" border="0" onClick="return f();"><img src="/icons/database_edit.png" border="0" alt=""/> Reset</button>

</FORM>

	</tr>
		</table>
<script type="text/javascript">
function f() {   setTimeout('window.location.reload()', 1000); }
</script>
	
</div>

<div id="column_right">

<form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' method='GET' TARGET="_new">
			&nbsp;	<img src="/img/isiicon.gif" alt="ISI's Wikibase" height="25px" width="25px" border="0" style="margin-left:-5px;" /> &nbsp;&nbsp;<input type='hidden' name='title' value='Special:SphinxSearch'>
				<input type="search" id="search" name='sphinxsearch' maxlength='100' TABINDEX="4" placeholder="Wikibase Search" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;">
				&nbsp; <button type='submit' name='fulltext' class="negative3" value='Search' ><img src="/icons/magnifier.png" border="0" alt=""/> Search</button>
						</form>

		</div>
		<br /><br>
		<br />
<div class="imgg">&nbsp;&nbsp;&nbsp; <?php include ("rotor_HDE.php"); ?> </div>


<div id="main">

<script>
	$('.delete').live('click', function() {
		setTimeout("f()", 1000);
	});

</script>
<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$database = 'dbase';
$table = 'tickets';
$ticket = 'Ticket';
$DATE = date('n/j/Y');

	$con = mysql_connect($db_host, $db_user, $db_pwd);
if(!mysql_connect($db_host, $db_user, $db_pwd))   
		die ("Can't connect to database");
			if(!mysql_select_db($database))   
				die ("Can't select database");
 
 $result = mysql_query("SELECT Ticket, Date, Stime, ETA, Priority, Site, Comments FROM tickets WHERE Deleted != 'X'");
		if(!$result) {    
			die ("Query to show fields from table failed");
		}
 
	$fields_num = mysql_num_fields($result);
	echo "<table border='0' id='delTable'><tr class='trr'>";
	
		// printing table headers
		
			for($i=0; $i<$fields_num; $i++){ 
				$field = mysql_fetch_field($result);
				echo "<td><b><font face='Georgia'> {$field->name} </font></b></td>";
			}
			echo "</tr>\n";
 
	// printing table rows, beneath field headers.
		$deletelink = "<a href='#' class='delete'><img border='0' src='/img/delete.png' /></a>";
			$sql = 'SELECT Ticket, Date, Stime, ETA, Priority, Comments FROM tickets WHERE Deleted != "X" '; 

				$sequel = mysql_query($sql) or die(mysql_error());
				



	//			WORKING PHP FOR SELECTING TICKET ID AND PLACING INTO <TR ID=> SLOT:
	// 			MySQL grabs the ticket number and forces it into an $id variable within the table row,
	//			to pass it on to the deletelink when the image is clicked.

		while($row = mysql_fetch_row($result)){ 
			$ids = mysql_fetch_row($sequel);
				$id = $ids[0];
				echo "<tr id=$id>";
			
		// $row is array... foreach( .. ) puts every element    
		// of $row to $cell variable    
	
	
			foreach ($row as $cell)        
			echo "<td>$cell</td>";
				echo "<td>$deletelink</td>";
			echo "</tr>\n";
				if (!$row){
				echo "<td>Great job team, all tickets have been called on.</td>";
				}
			}
 

	mysql_free_result($result);
$qq = rand (1,100);
$say = "cgi-bin/Quotes.txt";
$quotes = file($say, true) or die("Can't open Quotes file.");
$data = file_get_contents("cgi-bin/Quotes.txt"); //read the file
$convert = explode("\n", $data); //create array separate by new line
		
		for ($i=0;$i<count($convert);$i++){
			$q = $convert[$qq].' '; //append a single-line quote from the file into variable '$q'
		}
 
  	echo "<div class='fade' style='position:fixed; bottom:0px;right:15px;padding:10px;padding-bottom:3px;background:#FFFFCC; color:#000000;display:inline-block;'>";
	echo "<button style='position:absolute; top:0; right:0;' class='fade2' title='Click here to make your wildest dreams come true.' border='0'>x</button>";
		$tick = mysql_query("SELECT COUNT(*) FROM tickets WHERE Date = '$DATE'");
		$ticke = mysql_fetch_assoc($tick, MYSQL_BOTH);
		$ticked = $ticke[0];
					
	echo "<br>";
	echo "There have been $ticked tickets opened so far for today, "."$DATE ";
	echo "</div>";
echo "<div class='quote' style='position:fixed;bottom:0px;right:15px;padding:5px;padding-bottom:3px;background:#eeeeee;color:#000000;display:none;' title='Click this quote to make it vanish.'> $q </div>";
	
mysql_close($con);

  ?>

  </table>
    </center>
<!-- 
<IFRAME src="DB.php" name="iframe" id="iframe" height="550px" align="center" FRAMEBORDER=0 Border=0 ></IFRAME>
-->

</div>
<br><div id="bee" style="position:fixed; bottom:0px; left:0px;z-index:1;display:none;"><img src="/img/bee.gif" height="167px" width="300px" />
 </div>
  <br />
  <div id="shark" style="position:fixed; bottom:0px; left:0px;z-index:1;display:none;"><img src="/img/shark.gif" />
</div>
<br>
<br />
<button id="themes" class="negative" style="position:relative; top:0; left:10;float:left;clear:both;">Themes</button>
<div class="themes" style="position:relative; top:0; left:10;float:left;clear:both;"><button id="one">Go back to the original Alert System</button>
 </div>

 <br />
<script>
	$('button.fade2').live("click", function(){
		$('div.quote').fadeIn(6000);
	});
		$('div.quote').live('click', function(){
			$('div.quote').fadeOut(3000);
		});
		
		</script>
<div style="position:absolute; bottom:0px; left:50px; z-index:9;"><img src="/img/hds.gif" id="draggable" title="HOT DOG STAND!"/></div>
</body>
</html>









