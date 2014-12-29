<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<link href="../jQuery/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<script>
$(document).ready( function() {
	
	$('button#submit').click( function() {
				$.ajax(
				{
					   type: "POST",
					   url: "pswrd.php?input=$input",
					   cache: false,
					   dataType: 'html',
				});

	});
			$(function () {
				$('button').button();
			});
});
</script>
<style>
body {
background: #808080;
color: #f5fffa;
padding:5px;
}

#wrapper {
display:inline-block;
color: #f5fffa;
background: #888888;
border-radius: 15px;
padding: 50px;
border: 25px solid #888f88;
}

#top{
padding:20px;
background: #778899;
border: 5px solid #708090;
border-radius: 10px;
}

#bottom{
padding: 10px;
background: #708090;
border: 5px solid #778899;
border-radius: 10px;
}

#username {
display:block;
clear:right;
float:left;
padding:100px;
}

#failure {
color: #ffcccc;
text-decoration:underline;
font-weight: heavy;
padding:2px;
}

#md5{
background:#88a8cd;
border:1px solid #000000;
color:#FFFFFF;
padding:20px;
}

#user{
background:#378839;
color:#DADADA;
padding:10px;
border-radius:5px;
border:1px solid #dddddd;
}

</style>
	</head>
	<body>
				<center>
				<div id="wrapper" name="content">
	<div id="top">
<font face="Terminal Dosis">	
	<br>
		<h1>Encrypt your password with PHP!</h1>
	<br/>
	<form name='myinput' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<input name="input" type="text" required/>
	<button id="submit">submit!</button>
	</div>
	
	<font face="Droid Sans">
	<br><br/>
	<div id="bottom">
	
	<?php
	if( isset( $_POST['input'])) {
		 $input = filter_input(INPUT_POST, 'input', FILTER_SANITIZE_STRING);
		  $md5pass = md5($input);
		  echo " <h2>After applying md5() </h2><br><br/>";
		  echo "Your original password was <b style='color:#ffff8B;padding:1px;'>". $input ."</b> and has now become: <br><br/> <br>";
		  echo "<center><span id='md5'><b>";
		  echo $md5pass;
		  echo "</b></span></center>";
		  }
		  else {
		  echo "<font color='#FFFCCC'>Please enter a password to convert.</font>";
		  }
?>
</div>
<br><br/>
<div id='username'>
<br><br/>
<?php 
if( isset( $md5pass )) {
	$conn = mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db('db2', $conn) or die(mysql_error());
		$result = "SELECT id, username FROM members where password='$md5pass' ";
	$res = mysql_query($result, $conn) ; 
		while($row = mysql_fetch_assoc($res)) { 
			echo "<p id='user'>";
			echo "The closest user match is <b>". ucwords($row['username']). "</b>.</p>";
		} 
}
else {
echo "<span id='failure'><b>Encryption failed:</b></span> No password has been submitted."; 
}
?>
</div>

</font>
			</div>
			</center>
</body>
</html>