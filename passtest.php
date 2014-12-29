<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
<title>MD5 test</title>
<link rel="stylesheet" type="text/css" href="css/production.css">
</head>
<body>
<h1>Test the MD5 hash of your password</h1>
<br>
<form name ="MD5test" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<div class="has-form">
<div class="medium-3">
<div class="row collapse">
      <div class="medium-6 columns">
      <INPUT TYPE="password" NAME="test" id="SiteName" MAXLENGTH=45 placeholder="password" tabindex="1" >
    </div>
</form>
   <Button TYPE="submit" NAME="submit"  id="SubButton" class="button small primary"> Submit</button> 
   </div>

</div>

</div>

<?php 
error_reporting(E_ALL ^ E_NOTICE); 
$MD5 = $_POST['test'];

if(isset($MD5) ){
echo "<div><h3>Your password evaluates to: ". md5($MD5) ."</h3></div>";
}
else {
echo "<div> <h3 class='subheader'>please enter a password. </h3></div>";
}
?>

  <!-- // Per the FOUNDATION docs, load all external libraries near the end of BODY in the DOM -->
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
</body>
</html>