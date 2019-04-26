<?php

include "./src\core\subscribe.php";

$directory = "./storage/contents/";
$ziki = new Ziki\Core\Subscribe($directory);
$feed = $ziki->extract("http://www.scriptol.com/rss.xml");
//print_r($feed);

  //header('location '.$domain.'?n='.Auth::user()->name.'?e='.Auth::user()->email.'?i='.Auth::user()->image.'');
?>
