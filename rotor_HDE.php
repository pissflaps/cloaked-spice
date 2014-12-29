<?php
$Img1 = "http://tac-alert01/img/HDE/HDE1.png";
$Alt1 = "Hot Dog Stand Theme";
$Url1 = "http://tac-alert01/index_HDE.php";

$Img2 = "http://tac-alert01/img/HDE/HDE2.png";
$Alt2 = "Hot Dog Stand Theme";
$Url2 = "http://tac-alert01/index_HDE.php";

$Img3 = "http://tac-alert01/img/HDE/HDE3.png";
$Alt3 = "Hot Dog Stand Theme";
$Url3 = "http://tac-alert01/index_HDE.php";

$Img4 = "http://tac-alert01/img/HDE/HDE4.png";
$Alt4 = "Hot Dog Stand Theme";
$Url4 = "http://tac-alert01/index_HDE.php";

$Img5 = "http://tac-alert01/img/HDE/HDE5.png";
$Alt5 = "Hot Dog Stand Theme";
$Url5 = "http://tac-alert01/index_HDE.php";

$Img6 = "http://tac-alert01/img/HDE/HDE6.png";
$Alt6 = "Hot Dog Stand Theme";
$Url6 = "http://tac-alert01/index_HDE.php";

$Img7 = "http://tac-alert01/img/HDE/HDE7.png";
$Alt7 = "Hot Dog Stand Theme";
$Url7 = "http://tac-alert01/index_HDE.php";


$num = rand (1,7);

$Image = ${'Img'.$num};
$Alt = ${'Alt' .$num};
$URL = ${'Url'.$num};

echo "<a href=\"".$URL."\" border='0'><img src=\"".$Image."\" title=\"".$Alt."\" border='0' /></a>"; 

?>
