switch ($_REQUEST["action"]){

case 'add':
//place the code that adds rows here.
//maybe the values for each row are submitted with a form
//for this tutorial I am using a loop to add five rows

for($i=0;$i<5;$i++){

//HTML table markup surrounded with comments
$rowid = time();
$table_row = '<!--'.$rowid.'-->< a href="execute.php?action=delete&id=<!--'.$rowid.'-->">delete row< /a >Column two content<!--'.$rowid.'-->';

//Write the row to "table_include.html" using append "a" parametar
if (!$file_handle = fopen("table_include.html","a")) {
$error = "Cannot open file";
}
if (fwrite($file_handle, $table_row) === FALSE) {
$error = "Cannot write to file";
}
fclose($file_handle);
sleep(1); // we need to have a small pause for generating unique id with PHP time() function. Damn PHP is so fast. :)
}

break;

case 'delete':
$parameter = '<!--'.$_REQUEST['id'].'-->';

$filename = "table_include.html";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

//replace pattern that looks for our $parametar and everything in-between
$replace = "%($parameter)(.*?)($parameter)%is";

//use preg_replace to delete the row found using $parameter pattern
$myNewText = preg_replace($replace, "", $contents);

//write updated table code to "table_include.html"
$filename = "table_include.html";
if (!$file_handle = fopen($filename,"w")) {
$error = "Cannot open file";
}
if (!fwrite($file_handle, $myNewText)) {
$error = "Cannot write to file";
}
fclose($file_handle); // close file

//redirect to the table display file
header("Location: my_table.php");

break;

}
