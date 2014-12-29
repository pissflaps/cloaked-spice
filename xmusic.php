<html>
<head>
	<title>
		Tac's Xmas Xtra
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<link href="/css/jquery.ui.button.css" rel="alternate stylesheet" type="text/css"/>
	<link href="/jQuery/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery.popupWindow.js"></script> 
	<link rel="stylesheet" href="/css/dbase.css" type="text/css" />
  <script src="/js/jquery-ui.custom.min.js"></script>
  <script type="text/javascript" src="/js/jquery.cookie.js"></script>
  
<script type="text/javascript">
$(window).load( function(){

function f() {   setTimeout('window.location.reload()', 1000); }

	setTimeout("f()", 550000);
	});
	
</script>
  <style>
html {
        background: #000000 url(img/fireplace.gif) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
}
</style>
<?php


$MP1 = "http://tac-alert01/xMusic/one.mp3";
$MP2 = "http://tac-alert01/xMusic/two.mp3";
$MP3 = "http://tac-alert01/xMusic/three.mp3";
$MP4 = "http://tac-alert01/xMusic/four.mp3";
$MP5 = "http://tac-alert01/xMusic/five.mp3";
$MP6 = "http://tac-alert01/xMusic/six.mp3";
$MP7 = "http://tac-alert01/xMusic/seven.mp3";
$MP8 = "http://tac-alert01/xMusic/eight.mp3";
$MP9 = "http://tac-alert01/xMusic/nine.mp3";
$MP10 = "http://tac-alert01/xMusic/ten.mp3";
$MP11 = "http://tac-alert01/xMusic/eleven.mp3";
$MP12 = "http://tac-alert01/xMusic/twelve.mp3";
$MP13 = "http://tac-alert01/xMusic/thirteen.mp3";


$num13 = rand (1,13);

$MPX = ${'MP'.$num13};

?>
</head>
<body bgcolor='#000000'>

<EMBED src='<?php echo "$MPX";?>' autostart=true hidden=true></embed>

</body>
</html>