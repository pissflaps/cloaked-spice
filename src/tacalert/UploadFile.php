<?php
namespace tacalert;

class UploadFile
{
	protected $destination;
	protected $messages = array();
	protected $maxSize = 5242880;
	protected $permittedTypes = array(
			'image/jpeg',
			'image/pjpeg',
			'image/gif',
			'image/png',
			'image/webp'
	);
	protected $newName;
	protected $newWidth;
	protected $targetFile;
	protected $originalFile;
	protected $typeCheckingOn = true;
	protected $notTrusted = array('bin', 'cgi', 'exe', 'js', 'pl', 'php', 'py', 'sh','msi','asp','sql','asp','ps1','trojan');
	protected $suffix = '.txt';
	protected $renameDuplicates;
	
	public function __construct($uploadFolder)
	{
		if (!is_dir($uploadFolder) || !is_writable($uploadFolder)) {
			throw new \Exception("$uploadFolder must be a valid, writable folder.");
		}
		if ($uploadFolder[strlen($uploadFolder)-1] != '/') {
			$uploadFolder .= '/';
		}
		$this->destination = $uploadFolder;
	}
	
	public function setMaxSize($bytes)
	{
		$serverMax = self::convertToBytes(ini_get('upload_max_filesize'));
		if ($bytes > $serverMax) {
			throw new \Exception('Maximum size cannot exceed server limit for individual files: ' .
	self::convertFromBytes($serverMax));
		}
		if (is_numeric($bytes) && $bytes > 0) {
			$this->maxSize = $bytes;
		}
	}
	
	public static function convertToBytes($val)
	{
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		if (in_array($last, array('g', 'm', 'k'))){
			switch ($last) {
				case 'g':
					$val *= 1024;
				case 'm':
					$val *= 1024;
				case 'k':
					$val *= 1024;
			}
		}
		return $val;
	}
	
	public static function convertFromBytes($bytes)
	{
		$bytes /= 1024;
		if ($bytes > 1024) {
			return number_format($bytes/1024, 1) . ' MB';
		} else {
			return number_format($bytes, 1) . ' KB';
		}
	}
	
	public function allowAllTypes($suffix = null)
	{
		$this->typeCheckingOn = false;
		if (!is_null($suffix)) {
			if (strpos($suffix, '.') === 0 || $suffix == '') {
				$this->suffix = $suffix;
			} else {
				$this->suffix = ".$suffix";
			}
		}
	}
	
	public function upload($renameDuplicates = true)
	{
		$this->renameDuplicates = $renameDuplicates;
		$uploaded = current($_FILES);
		if (is_array($uploaded['name'])) {
			foreach ($uploaded['name'] as $key => $value) {
				$currentFile['name'] = $uploaded['name'][$key];
				$currentFile['type'] = $uploaded['type'][$key];
				$currentFile['tmp_name'] = $uploaded['tmp_name'][$key];
				$currentFile['error'] = $uploaded['error'][$key];
				$currentFile['size'] = $uploaded['size'][$key];
				if ($this->checkFile($currentFile)) {
					$this->moveFile($currentFile);
				}
			}
		} else {
			if ($this->checkFile($uploaded)) {
				$this->moveFile($uploaded);
			}
		}
	}
	
	public function getMessages()
	{
		return $this->messages;
	}
	
	protected function checkFile($file)
	{
		if ($file['error'] != 0) {
			$this->getErrorMessage($file);
			return false;
		}
		if (!$this->checkSize($file)) {
			return false;
		}
		if ($this->typeCheckingOn) {
		    if (!$this->checkType($file)) {
			    return false;
			}
		}
		$this->checkName($file);
		return true;
	}
	
	protected function getErrorMessage($file)
	{
		switch($file['error']) {
			case 1:
			case 2:
				$this->messages[] = $file['name'] . ' is too big: (max: ' . 
				self::convertFromBytes($this->maxSize) . ').';
				break;
			case 3:
				$this->messages[] = $file['name'] . ' was only partially uploaded.';
				break;
			case 4:
				$this->messages[] = 'No file submitted.';
				break;
			default:
				$this->messages[] = 'Sorry, there was a problem uploading ' . $file['name'];
				break;
		}
	}
	
	protected function checkSize($file)
	{
		if ($file['size'] == 0) {
			$this->messages[] = $file['name'] . ' is empty.';
			return false;
		} elseif ($file['size'] > $this->maxSize) {
			$this->messages[] = $file['name'] . ' exceeds the maximum size for a file ('
					. self::convertFromBytes($this->maxSize) . ').';
			return false;
		} else {
			return true;
		}
	}
	
	protected function checkType($file) 
	{
		if (in_array($file['type'], $this->permittedTypes)) {
			return true;
		} else {
			$this->messages[] = $file['name'] . ' is not permitted type of file.';
			return false;
		}
	}
	
	protected function checkName($file)
	{
		$this->newName = null;
		$nospaces = str_replace(' ', '_', $file['name']);
		if ($nospaces != $file['name']) {
			$this->newName = $nospaces;
		}
		$nameparts = pathinfo($nospaces);
		$extension = isset($nameparts['extension']) ? $nameparts['extension'] : '';
		if (!$this->typeCheckingOn && !empty($this->suffix)) {
			if (in_array($extension, $this->notTrusted) || empty($extension)) {
				$this->newName = $nospaces . $this->suffix;
			}
		}
		if ($this->renameDuplicates) {
			$name = isset($this->newName) ? $this->newName : $file['name'];
			$existing = scandir($this->destination);
			if (in_array($name, $existing)) {
				$i = 1;
				do {
					$this->newName = $nameparts['filename'] . '_' . $i++;
					if (!empty($extension)) {
						$this->newName .= ".$extension";
					}
					if (in_array($extension, $this->notTrusted)) {
						$this->newName .= $this->suffix;
					}
				} while (in_array($this->newName, $existing));
			}
		}
	}
	
protected function resize($newWidth, $targetFile, $originalFile) 
{
    $info = getimagesize($originalFile);
    $mime = $info['mime'];
	$allowedImgTypes = array ("image/jpeg","image/jpg","image/png","image/gif");
	  if (in_array($mime, $allowedImgTypes) ){
	  
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
					exit;
    }

    $img = $image_create_func($originalFile);
 
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile.$new_image_ext");
	print "<div id='output'>";
 } else {
	print '<h1><i class="fi-alert" style="color:#ff0000;"></i>  Error</h1> <h3 class="subheader">MIME Type is not recognized. Please submit a valid image file.</h3>';
	print "<div id='links' class='left'> <ul class='side-nav'> <li><a href='iGallery.php' target='_blank'><i class='fi-upload-cloud'></i> Check out the upload gallery here! </a></li> <li><a href='attach.php' ><i class='fi-upload'></i> Upload a new image</a></li>";
	print "<li><a href='index.php' target='_NEW'><i class='fi-arrow-left'></i> or return to TAC Alert</a></li> </ul></div> </p>";
	print "</div>";	
		exit; 
	}
}

	protected function moveFile($file)
	{
		$filename = isset($this->newName) ? $this->newName : $file['name'];
		$success = move_uploaded_file($file['tmp_name'], $this->destination . $filename);
		  
		  
        $allowedImgTypes = array ("image/jpeg","image/jpg","image/png","image/gif");
		if ($success) {
			$result ='<h2>'. $file['name'] . ' was uploaded successfully!</h2>';
			$URL = '<a href="http://tac-alert01/tmp/'. $filename .'" target="_blank" class="text_center">Click here to download it in a new tab</a>';
			  if (!is_null($this->newName)) {
				  $result .= '-- and was renamed ' . $this->newName;
			  }
				if(in_array($file['type'], $allowedImgTypes)  ){
				  $img=$filename;
		          $id=$file['tmp_name'];
		          $newImage =  "tmp/$img";
                   $this->resize(120, $id, $newImage);
					$result .= "<li><figure><a href='#' filename='$newImage' title='New Image' target='_blank' data-reveal-id='imgLarge' class='th' role='button' aria-label='Thumbnail'><img src='$newImage' class='zclip'/></a> <figcaption class='text_center'>Click the image to copy it to your clipboard. </figcaption> </figure></li>";				
					$result .= "";				
				}
			$result .= '<h3 class="subheader">'. $URL .'</h3>';
			
			$this->messages[] = $result;
		} else {
			$this->messages[] = 'Could not upload ' . $file['name'];
		}
	}
}