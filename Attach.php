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
html, body{
	    min-height: 100%;
	    margin-bottom: 50px; 
}

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
 embed{
position: absolute;
width: 300px !important;
min-height: 120px;
}
ul>li {
display: inline;
list-style: none;
list-style-type: none;
}
#output{
margin: none;
padding: none;
}
</style>  
</head>
<body>
 <div class='icon-bar three-up'>
  <a href='Attachments.php' class="item" target='_blank'>
    <i class="fi-blind"></i> 
    <label>Browse ALL Attachments.</label> 
  </a>
  <a href='iGallery.php' class="item" target='_blank'>
    <i class="fi-thumbnails"></i>
    <label>Check out the Image Gallery!</label> 
  </a>
  <a href='http://tac-alert01/' class="item" target='_blank'>
    <i class="fi-social-windows"></i> 
	<label>Return to TAC Alert system.</label> 
  </a>
 </div>
<?php
use tacalert\UploadFile;

session_start();
require_once 'src/tacalert/UploadFile.php';
$max = 5120 * 1024;
$result = array();

if (!isset($_SESSION['maxfiles'])) {
	$_SESSION['maxfiles'] = ini_get('max_file_uploads');
	$_SESSION['postmax'] = UploadFile::convertToBytes(ini_get('post_max_size'));
	$_SESSION['displaymax'] = UploadFile::convertFromBytes($_SESSION['postmax']);
}

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
$error = error_get_last();
?>
  <h1>Upload Ticket Attachments</h1>
<?php if ($result || $error) { ?>
<ul class="result centered panel text-center">
<?php 
if ($error) {
    echo "<li>{$error['message']}</li>";
}
if ($result) {
	foreach ($result as $message) {
	    echo "<li>$message</li>";
	}
}?>
</ul>
<?php } ?>


<div class="has-form">
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
  <fieldset>
      <legend for="filename" ><h5 class='subheader'> Select an image in ANY format:</h5>
	  </legend> 
  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max;?>">
  <input type="file" name="filename" id="fName" class="small secondary" 
  data-maxfiles="<?php echo $_SESSION['maxfiles'];?>"
  data-postmax="<?php echo $_SESSION['postmax'];?>"
  data-displaymax="<?php echo $_SESSION['displaymax'];?>" >
 <button type="submit" name="upload" value="Upload File" class="small button primary">Upload!</button>
  </fieldset>
</form>
  </div>
<p>
<ul>
    <li><h6 class='subheader'>Server Limitations require uploads smaller than <?php echo UploadFile::convertFromBytes($max);?>.</h6></li>
</ul>
</p>
<div id="imgLarge" class="large reveal-modal" data-reveal>
  <p id="imgg"></p>
  <a class="close-reveal-modal">&#215;</a>
</div>


<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
  <!-- // jQuery and Foundation frameworks apply before DOM load -->
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
  <!-- // Load Foundation vendor-specific library additions -->
<script type="text/javascript" src="js/jQuery_Plugins.js"></script>
<!-- // Compressed version of all related vendor plug-ins used in jQuery -->  
<script src="js/jquery.zeroclipboard.js"></script>  
<!-- zClip used to copy image SRC into clipboard of user -->  
<script type="text/javascript">
$(document).foundation();
 
	
$(document).ready(function() {

$('body').on('copy', '.zclip', function(e){
        var CPY = "http://tac-alert01/"+ $(this).closest('a').attr('filename');
        var textToCopy =  CPY;
    // If there isn't any currently selected text, just ignore this event
    if (!textToCopy) {
      return;
    }

    // Clear out any existing data in the pending clipboard transaction
        e.clipboardData.clearData();
        e.clipboardData.setData("text/plain", textToCopy);
        e.preventDefault();
      var img = $(this).closest('a').attr('filename');
		return "http://tac-alert01/"+ $(this).closest('a').attr('filename');			  
});	  
        $('body').on('aftercopy', '.zclip', function() {
              var img = "http://tac-alert01/"+ $(this).closest('a').attr('filename');	
              $('#imgg').html('<span class="row collapse"><u>'+ img +'</u> copied to clipboard!</span><br> <img src="'+ img + '" />').addClass('centered');
            console.log(img +'  copied.');
		});

});

/*
// DEPRECATED COPY FUNCTION //
	
  $('a.th').zclip({
        path:'ZeroClipboard.swf',
        copy:function(){
//          var img = $(this).attr('filename');		
//            return "http://tac-alert01/"+ img;
		return "http://tac-alert01/"+ $(this).closest('a').attr('filename');		
        },
		afterCopy:function() {
      var img ="http://tac-alert01/"+  $(this).attr('filename');
      $('#imgg').html('<span class="row"><u>'+ img +'</u> copied to clipboard!</span><br> <img src="'+ img + '" />').addClass('centered');
    console.log(img +'  copied.');
		}
    });
*/

</script>
</body>
</html>
