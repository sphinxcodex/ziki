<?php
<<<<<<< HEAD
<<<<<<< HEAD
/*
=======
>>>>>>> pr/6
=======
>>>>>>> pr/6
include "./src\core\document.php";

$directory = "./storage/contents/";
$ziki = new Ziki\Core\Document($directory);
$feed = $ziki->fetchRss();
<<<<<<< HEAD
<<<<<<< HEAD
print_r($feed);*/

  header('location '.$domain.'?n='.Auth::user()->name.'?e='.Auth::user()->email.'?i='.Auth::user()->image.'');
=======
print_r($feed);
>>>>>>> pr/6
=======
print_r($feed);
>>>>>>> pr/6
?>
