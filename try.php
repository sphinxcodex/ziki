<?php
include "./src\core\document.php";

$directory = "./storage/contents/";
$ziki = new Ziki\Core\Document($directory);
$feed = $ziki->fetchRss();
print_r($feed);
?>
