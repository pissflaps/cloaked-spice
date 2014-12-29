<?php
    $fileid = $_POST['fileid'];
    $rel =  __DIR__ . '\tmp\\';
	 $path = htmlspecialchars( $rel, ENT_QUOTES );
	
$file = $path . $fileid;
if (isset($_POST['fileid'])){
unlink($file);
print "<h1>". $fileid ." removed. </h1>";
print "<h2>Operation completed successfully!</h2>";
} else { 
print "<h1>Operation failed.</h1>";
exit;
}
?>