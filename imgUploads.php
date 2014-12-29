<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
  <link rel="stylesheet" href="Foundation/css/foundation.min.css" type="text/css">
  <title>Recent Image Uploads</title>
  
<style>
body{
background: #f1f7f9;
color: #212121;
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
</style>
<?php
/* function:  generates thumbnail */
function make_thumb($src,$dest,$desired_width) {
	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height*($desired_width/$width));
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width,$desired_height);
	/* copy source image at a resized size */
	imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image,$dest);
}

function resize($newWidth, $targetFile) {
    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw Exception('Unknown image type.');
    }

    $img = $image_create_func($targetFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, $targetFile.$new_image_ext);
}

/* function:  returns files from dir */
function get_files($images_dir,$exts = array('jpg')) {
	$files = array();
	if($handle = opendir($images_dir)) {
		while(false !== ($file = readdir($handle))) {
			$extension = strtolower(get_file_extension($file));
			if($extension && in_array($extension,$exts)) {
				$files[] = $file;
			}
		}
		closedir($handle);
	}
	return $files;
}

/* function:  returns a file's extension */
function get_file_extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
}
?>

</head>
<body>
<h1> Recent Uploads: </h1>
<ul class="medium-block-grid-4 large-block-grid-6">
<?
/** settings **/
$images_dir = 'tmp/';
$thumbs_dir = 'tmp-thumbs/';
$thumbs_width = 200;
$images_per_row = 3;

/** generate photo gallery **/
$image_files = get_files($images_dir);
if(count($image_files)) {
	$index = 0;
	foreach($image_files as $index=>$file) {
		$index++;
		$thumbnail_image = $thumbs_dir.$file;
		if(!file_exists($thumbnail_image)) {
			$extension = get_file_extension($thumbnail_image);
			if($extension) {
				make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);
			}
		}
		echo '<li><a href="#" filename="',$images_dir.$file,'" data-reveal-id="imgLarge" class="th" data-reveal title="',$file,'"><img src="',$thumbnail_image,'" /></a></li>';
		if($index % $images_per_row == 0) { echo '<div class="centered clear"></div>'; }
	}
}
else {
	echo '<p>There are no images in this gallery.</p>';
}

?>
</ul>


<div id="imgLarge" class="large reveal-modal" data-reveal>
  <div id="imgg"><p></p> </div>
  <a class="close-reveal-modal">&#215;</a>
</div>
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
  <!-- // jQuery and Foundation frameworks apply before DOM load -->
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
  <!-- // Load Foundation vendor-specific library additions -->
<script type="text/javascript" src="js/jQuery_Plugins.js"></script>
<!-- // Compressed version of all related vendor plug-ins used in jQuery -->  
<script type="text/javascript">
$(document).foundation();

$(document).ready(function() {

    $(document).on("click", ".th", function(){
        var img = $(this).attr('filename');
		$("#imgg p").html('<img src="'+ img +'" />').addClass('centered');
		console.log(img +'  selected.');
    });
});
</script>
</body>
</html>