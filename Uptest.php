<?php
function resize($newWidth, $targetFile, $originalFile) {

    $info = getimagesize($originalFile);
    $mime = $info['mime'];
   list($width, $height) = getimagesize($originalFile);
    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
     switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':	
    $background = imagecolorallocate($tmp, 255,255,255);
      imagecolortransparent($tmp, $background);
	  imagealphablending( $tmp, true );
      imagesavealpha( $tmp, true ); 
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
    $background = imagecolorallocate($tmp,255,255,255);
      imagecolortransparent($tmp, $background);
	  imagealphablending( $tmp, false );
      imagesavealpha( $tmp, true ); 
 	                $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
 
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile.$new_image_ext");
}






function uploadFile() {
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead of $_FILES.
$uploaddir = '/xampp/htdocs/tmp/';
$uploadfile = $uploaddir. basename($_FILES['filename']['name']);
$name = basename($_FILES['filename']['name']);
$type = $_FILES['filename']['type'];



echo '<div id="output">';
if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile)) {
print'<h1> Success! </h1>';
$img=$name;
$id=$_FILES['filename']['tmp_name'];
$newImage =  "tmp/$img";

//  echo $img;
resize(120, $id, $newImage) ;
print "<div class='small-6 columns panel callout'><h5 class='text-center'>File '$name' is valid, and was successfully uploaded! <br><span class='subheader'> Click the image to open it in a new tab.</span></h5> </div>";
print "<div id='TicketForm' class='row has-form'><form method='POST' name='tForm' id='NumberForm' action='imgLink.php' ><div class='large-5 columns'><label for='ticket'><b>Which ticket is this for?</b> <INPUT TYPE='text'  class='text' NAME='ticket' id='TicketNumber' tabindex='1' MAXLENGTH=6   placeholder='Ticket Number' required><input type='hidden' name='location' value='tmp/$name' ></label> </div><button class='small button success'>Submit</button>  </form></div> </div> ";	
print "<ul class='large-offset-2 large-block-grid-3'><li><a href='$newImage' filename='$newImage' title='New Image' target='_NEW' class='th'><img src='$newImage' /></a></li></ul>";

} else {
    
print "<h1> <i class='fi-alert' style='color:#ff0000;'></i> <strong>Sorry!</strong> </h1> <h3>Doesn't look like this worked how we expected. <br> <small>Please check how you got to this page and try again.</small></h3>";
print "<div id='links' class='left'> <ul class='side-nav'> <li><a href='iGallery.php' target='_NEW'><i class='fi-upload-cloud'></i> Check out the upload gallery here! </a></li> <li><a href='uptest.php' ><i class='fi-upload'></i> Upload a new image</a></li>";
print "<li><a href='index.php' target='_NEW'><i class='fi-arrow-left'></i> or return to TAC Alert</a></li> </ul></div> </p>";
echo "</div>";
exit;
}

// echo '<pre>Debug info: '; print_r($_FILES); echo '</pre>';
 



// print "<p class='row left'> <img src='tmp/$name' /> ";

} 
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>TEST Upload</title>
  <link href="css/production.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="Foundation/css/foundation.min.css" type="text/css">
  <link rel="stylesheet" href="Foundation/icons/foundation-icons.css" type="text/css">  
</head>
<body>
  <h1>Test your upload</h1>
  <br>
<div class="has-form">
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
  <fieldset>
      <legend for="filename" ><h5 class='subheader'> Select an image in ANY format:</h5>
	  </legend> 
  <input type="file" name="filename" id="fName" class="small secondary" accept="image/jpeg, image/png, image/gif">
 <button type="submit" name="upload" value="Upload File" class="small button primary">Upload Image</button>
  </fieldset>
</form>
  </div>
  
 <span class='clearfix'> 
<?php
if( isset ($_POST['upload']) ){
uploadFile();
}

?>
</span>
<footer class='panel clearfix' id='footer'> 
  <section> 
    <a href='iGallery.php' target='_NEW'>Check out the upload gallery here! </a> 
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