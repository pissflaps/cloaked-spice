<?php
use tacalert\UploadFile;

$max = 2048 * 1024;
$result = array();

if (isset($_POST['upload'])) {
	require_once 'src/tacalert/UploadFile.php';
	$destination = __DIR__ . '/tmp/';
    try {
    	$upload = new UploadFile($destination);
    	$upload->setMaxSize($max);
    	$upload->allowAllTypes();
		
    	$upload->upload();
	   	$result = $upload->getMessages();
    } catch (Exception $e) {
    	$result[] = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
  <title>Attachment Upload</title>
  <link href="css/production.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="Foundation/css/foundation.min.css" type="text/css">
  <link rel="stylesheet" href="Foundation/icons/foundation-icons.css" type="text/css">
<style>

#imgg{
    text-align: center;
    vertical-align:middle;
}

#imgg p{
    display:inline-block;
    overflow:auto!important;
    background-color:white;
    padding:5px;
}
#imgg u{
color: #0000FF;
}

zclip-wrapper{
position: relative; 
display:inline-block;
}
.zclip, embed{
position: absolute;
width: 300px !important;
min-height: 120px;
}
ul>li {
display: inline;
list-style: none;
list-style-type: none;
}
</style>  
</head>
<body>
  <h1>Upload Ticket Attachments</h1>
  <br>
<?php if ($result) { ?>
<ul class="result">
<?php  foreach ($result as $message) {
    echo "<li>$message</li>";
}?>
</ul>
<?php } ?>
<div class="has-form">
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
  <fieldset>
      <legend for="filename" ><h5 class='subheader'> Select an image in ANY format:</h5>
	  </legend> 
  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max;?>">
  <input type="file" name="filename" id="fName" class="small secondary" >
 <button type="submit" name="upload" value="Upload File" class="small button primary">Upload Image</button>
  </fieldset>
</form>
  </div>

<div id="imgLarge" class="large reveal-modal" data-reveal>
  <div id="imgg"><p></p> </div>
  <a class="close-reveal-modal">&#215;</a>
</div>

<footer class='panel clearfix' id='footer'> 
  <section> <ul id='linkList' class='text-center'>
  <li>    <a href='images.php' target='_NEW'>Find your ticket attachments.</a> </li> | 
  <li>    <a href='iGallery.php' target='_NEW'>Check out the upload gallery here! </a> </li> |
  <li>    <a href='http://tac-alert01/' target='_NEW'>Return to TAC Alert system.</a> </li>
  </ul>
  </section> 
</footer> 
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
  <!-- // jQuery and Foundation frameworks apply before DOM load -->
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
  <!-- // Load Foundation vendor-specific library additions -->
<script type="text/javascript" src="js/jQuery_Plugins.js"></script>
<!-- // Compressed version of all related vendor plug-ins used in jQuery -->  
	<script src="js/jquery.zclip.min.js"></script>
<!-- zClip used to copy image SRC into clipboard of user -->  
<script type="text/javascript">
$(document).foundation();
 
	
$(document).ready(function() {

  $('a.th').zclip({
        path:'ZeroClipboard.swf',
        copy:function(){
		return "http://tac-alert01/"+ $(this).closest('a').attr('filename');		
//          var img = $(this).attr('filename');		
//            return "http://tac-alert01/"+ img;
        },
		afterCopy:function() {
      var img ="http://tac-alert01/"+  $(this).attr('filename');
      $('#imgg p').html('<span class="row collapse"><u>'+ img +'</u> copied to clipboard!</span><br> <img src="'+ img + '" />').addClass('centered');
    console.log(img +'  copied.');
		}
    });
});
</script>
</body>
</html>