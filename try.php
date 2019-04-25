<?php
/*
include "./src\core\document.php";

$directory = "./storage/contents/";
$ziki = new Ziki\Core\Document($directory);
$feed = $ziki->fetchRss();
print_r($feed);*/

  header('location '.$domain.'?n='.Auth::user()->name.'?e='.Auth::user()->email.'?i='.Auth::user()->image.'');
?>
