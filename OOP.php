<html>
<head>
<title> Test out Object-Oriented Programming</title>
</head>
<body background='#dddddd'>
<form name='ugh' method='GET' enctype="multipart/form-data" >
<input type='file' name='image'> <br>
<button type='submit'>Submit!</button>

</form>
<?php
global $image;

class Image {
	private $image;
	private $width;
	private $height;
	private $mimetype;
	
	function __construct($filename) {
			
			$fp = fopen($filename, 'rb') or die("Image $filename not found!");
			$buf = '';
				while (!feof($fp))
				$buf .= fgets($fp);

				//create image and assign it a variable
				$this->image = imagecreatefromstring($buf);
				
				//extract image information
				$info = getimagesize($filename);
				$this->width = $info[0];
				$this->height = $info[1];
				$this->mimetype = $info['mime'];
			fclose($fp);	
	}
	
	public function display() {
		header("Content-type: {$this->mimetype}");
			switch($this->mimetype) {
				case 'image/jpeg' : imagejpeg($this->image); break;
				case 'image/png' : imagepng($this->image); break;
				case 'image/gif' : imagegif($this->image); break;
		}
		//exit
	}	
}
	class Thumbnail extends Image {
		function __construct($image, $width, $height) {
			//call the super-class constructor
			parent:: __construct($image);
			
			//modify the image to create the thumbnail
			$thumb = imagecreatetruecolor($width, $height);
			imagecopyresampled($thumb, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
			$this->image = $thumb;
		}
	}

$image = new Image($_GET['image']);

?>
<br>
<hr>
<br>
<?php
if(isset($_GET['image'])) {

echo "<br> <hr> <br>". $image->display() ."<br> <hr> <br>";
echo "<br>";
echo print_r($info);
}
else {
Echo "could not display yer image.";
return;
}

?>
<br>
</body>
</html>