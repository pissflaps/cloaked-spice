<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
    <title>TAC Image Upload</title>
  <!-- // Style sheets loaded in succession for structure elements and button layout configuration -->
  <link rel="stylesheet" href="Foundation/css/foundation.min.css" type="text/css">
  <link rel="stylesheet" href="Foundation/icons/foundation-icons.css" type="text/css">
  <style>
body, #padded{
  margin: 10px;
  padding: 1em;
}
#links{
margin: none;
padding: none;
}
</style>
</head>
<body>
<div id="padded">
<?php

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
function followUp() {
print "<div id='links' class='left'> <ul class='side-nav'> <li><a href='iGallery.php' target='_NEW'><i class='fi-upload-cloud'></i> Check out the upload gallery here! </a></li> <li><a href='attach.php' ><i class='fi-upload'></i> Upload a new image</a></li>";
print "<li><a href='index.php' target='_NEW'><i class='fi-arrow-left'></i> or return to TAC Alert</a></li> </ul></div> </p>";
exit;
}

if( empty($_POST['ticket']) ){

print "<h1> <i class='fi-alert' style='color:#ff0000;'></i> <strong>Sorry!</strong> </h1> <h3>Doesn't look like this worked how we expected. <br> <small>Please check how you got to this page and try again.</small></h3>";
print "<div id='links' class='left'> <ul class='side-nav'> <li><a href='iGallery.php' target='_NEW'><i class='fi-upload-cloud'></i> Check out the upload gallery here! </a></li> <li><a href='attach.php' ><i class='fi-upload'></i> Upload a new image</a></li>";
print "<li><a href='index.php' target='_NEW'><i class='fi-arrow-left'></i> or return to TAC Alert</a></li> </ul></div> </p>";
exit;
}
$ticket = $_POST['ticket'];
$img = $_POST['location'];

$dbtype		= "mysql";
$dbhost        = "localhost";
$dbname		= "dbase";
$dbuser		= "infortel";
$dbpass		= "T3lemanagement";

$location= "http://tac-alert01/";
$location.= $img;

$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
if (isset($_POST['ticket']) ) {
$sql = "INSERT INTO dbase.images (Ticket, Date, Name, Timestamp) VALUES( :ticket, DATE_FORMAT(CURDATE(),'%c/%e/%Y'), :location, NOW())";
$q = $dbh->prepare($sql);
$q->execute(array(
					':ticket'=>$ticket,
					':location'=>$location,
));

print "<h3><i class='fi-check'></i> &nbsp; Successfully appended to Ticket <strong>#$ticket.</strong> <br><small>Click the image to view it in a new tab.</small> </h3><p class='row left'> <a href='$img' title='View this image in a new tab.' target='_NEW'> <img src='$img' /> </a>";	
followUp();
}

else {

print "<br> <h1>Sorry. </h1> <h3>Doesn't look like this worked how we expected. <br><small>Please check how you got to this page and try again. </small></h3>";
followUp();
exit;
}	
?>
</div>
<script type="text/javascript">
$(document).foundation();
</script>
</body>