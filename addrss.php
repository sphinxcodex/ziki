<?php
//namespace Ziki\Core;

define('ZIKI_BASE_PATH', __DIR__);
//include ( ZIKI_BASE_PATH ."/src/core/subscribe.php");
include "C:\Users\user\ziki-1\src\core\document.php";


$directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
                  if ($ziki->createRSS())
                  {
                    $response = "Added successfully";
                  //  header("location: /subscription");
                  } else {
                      $response = "Your have already Subscribed to this channel";
                  }
                  echo $response;


 ?>
