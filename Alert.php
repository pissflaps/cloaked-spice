<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en">
<head>
<title>TAC's Tabbed Alert System</title>
<?php include( "session.php"); ?>

<base href="http://tac-alert01/Alert.php">
	<script src="jquery/jquery-1.8.0.js"></script>
		<script src="jquery/jquery-ui-1.8.19.js"></script>
	<link rel="stylesheet" href="css/jquery.ui.all.css">
	<link rel="shortcut icon" href="http://tac-alert01/img/bookmark.ico" type="image/x-icon" />
		<script type="text/javascript" src="js/thickbox.js"></script>
		<script type="text/javascript" src="js/jquery.form.js"></script> 
  		<script type="text/javascript" src="js/jquery.cookie.js"></script>
  		<script type="text/javascript" src="jquery/jq-RBC.js"></script>
	<link rel="stylesheet" href="css/Base.css" Media="Screen">
<script>
function apply() {
				$('table#delTable tr:odd').addClass('tblOclr');
				$('table#delTable tr:even').addClass('tblEclr');
				$('table#delTable tr:first').addClass('tblFclr');
				$('table#delTable td').addClass('tblbrdr');
}
function Reload() { 	
	$('#database').fadeOut(500, function() {$('#database').html('<img src="loadinganimation.gif" title="Loading..." />').load('db.php #delTable').fadeIn(1500) }); 
};

$(document).ready(function (){

	$('#submissionForm').load('index.php #tabs-1');
			$('#database').html('<img src="loadinganimation.gif" title="Loading..." />');
			$('#database').delay(900).load('db.php #delTable');
			$('#Quotes').load('quoteget.php');
				$('#links').load('index.php #tab2');	
				setInterval( 'Reload()', 10000);
	setInterval( 'apply()', 100);
	
	

	
	$(document).keyup(function(e) {
		if (e.keyCode == 27) { 
			f();
		}  
	});
	
});
	  $(function () {
        $("button").button();
    });
	$(function () {
        $("#buttonDiv").buttonset();
    });			
function f() {   setTimeout('window.location.reload()', 10); }

</script>
		
	</head>
	<body>
	
<div id="title">
<div id="logbar">
<?php include ('loginout.php'); ?>
</div>
	</div>
	<div id="container">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. <h1>Pellentesque lectus eros, faucibus id tempor eget, tristique ac nibh. Aliquam erat volutpat. </h1>
Mauris sed nulla malesuada lectus adipiscing tincidunt. <br>
<br/>
<div id="submissionForm">

</div>
<br>

Etiam a massa lectus. Phasellus urna purus, feugiat vel vestibulum tincidunt, elementum pretium neque. 
Aliquam ultrices, ante nec eleifend laoreet, sapien tortor scelerisque mi, commodo vulputate turpis quam quis elit. Maecenas vitae sem nec mi rhoncus condimentum. 
<a href="#" title="fake link" >Nunc eleifend, enim nec tristique pulvinar</a>, ipsum metus elementum risus, <b>et rhoncus nunc mauris vel magna. </b>
Suspendisse lectus ipsum, posuere at ultrices et, mollis sollicitudin mauris. Proin dapibus, tortor id pulvinar consequat, nisi purus accumsan libero, ut rutrum elit nunc id odio. Mauris lacus purus, molestie sed fringilla eget, dictum sit amet justo. Pellentesque tellus libero, tincidunt id eleifend a, scelerisque eu diam. Cras tellus quam, tincidunt condimentum commodo vitae, dictum sit amet nibh. Aliquam erat volutpat. Morbi vehicula tempor nisl, ac rutrum sapien porttitor in. Pellentesque auctor lorem et lorem lacinia non accumsan nunc tincidunt.
Nam at arcu lorem. Maecenas massa orci, mattis vitae auctor nec, ornare et dolor. Sed ac mauris leo. Etiam eu diam enim. <br>
Vestibulum sagittis consectetur malesuada. Phasellus pharetra risus nisl, non auctor risus. Integer quis leo eu justo suscipit pharetra eget id felis. 
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras eu ornare tellus. Proin a lectus at purus elementum malesuada. 
Praesent ullamcorper vehicula quam at sagittis.
<p>
Nunc massa nunc, rhoncus tincidunt lacinia ac, gravida vel metus. <a href="#" title="External link" class="external">Vivamus non mi sapien, sed luctus dui</a>. Suspendisse adipiscing hendrerit velit, quis feugiat magna venenatis a. 
Mauris sit amet risus eu sapien dictum hendrerit. Morbi luctus facilisis eros a imperdiet. Quisque metus tortor, vehicula in cursus vitae, tempus id dui. Morbi vitae tellus tortor.
</p>
<span style="float:right; padding: 25px;" >
Aenean eu dui ipsum, eget vulputate mi. Donec sit amet leo tellus, non porttitor mi. 
In convallis dictum condimentum. Curabitur consectetur rhoncus turpis a interdum. Quisque sed magna urna, eget volutpat justo. <br>
<b>Fusce tincidunt massa nec lacus ullamcorper sodales tristique elit consectetur.</b> </span>
<em>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</em>
<br>In vel magna leo, sed porttitor lorem. Fusce non sem quis tellus dapibus accumsan id in neque.
<hr>
<br/>
<span id="dbwrap">
<div id="database">
<p id="loading"></p>
</div>
</span>

<br>

 <div id="foot">



<div id="Quotes">
</div>


	</div> <!-- End Div #Foot -->
<div id="links">
</div>


</div> <!-- End Div #Container -->
<P><br>
Donec augue odio, scelerisque non porttitor ut, auctor at diam. 
Integer porttitor luctus sapien, non dapibus leo semper eu. 
<br>
<I> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </I>
Integer eget neque leo, nec aliquet mauris.
</P>
</body>
</html>
	