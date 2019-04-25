<?php
//namespace Ziki\Core;
define('ZIKI', true);
define('ZIKI_BASE_PATH', __DIR__);

$ziki = require_once ZIKI_BASE_PATH . '/src/bootstrap.php';

include "./src\core\document.php";
  $directory = "./storage/contents/";
 $new = new Ziki\Core\Document($directory);
 $feed=$new->createRSS();
//print_r($feed);
