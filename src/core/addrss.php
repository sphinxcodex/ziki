<?php
//namespace Ziki\Core;

define('ZIKI_BASE_PATH', __DIR__);
//include ( ZIKI_BASE_PATH ."/src/core/subscribe.php");
include "C:\Users\user\ziki-1\src\core\subscribe.php";


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $ziki = new Ziki\Core\Subscribe();
                  if ($ziki->extract($domain))
                  {
                    $response = "Added successfully";
                    header("location: /subscription");
                  } else {
                      $response = "Your have already Subscribed to this channel";
                  }
                  echo $response;
            }

 ?>
