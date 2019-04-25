<?php
include "C:\Users\user\ziki-1\src\core\subscribe.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rss = new DOMDocument();
    $url = isset($_POST['rss']) ? trim($_POST['rss']) : null;

    //$url = "http://www.scriptol.com/rss.xml";
        $rss->load($url);
        foreach ($rss->getElementsByTagName('channel') as $r) {
          $title = $r->getElementsByTagName('title')->item(0)->nodeValue;
          $link = $r->getElementsByTagName('link')->item(0)->nodeValue;
          $description = $r->getElementsByTagName('description')->item(0)->nodeValue;
          $image = isset($r->getElementsByTagName('image')->item(0)->nodeValue);

        }
                $db_json = file_get_contents("storage/rss/subscriber.json");
                $newSub = new Ziki\Core\Subscribe();
                $newSub->setSubName($title);
                $newSub->setSubRss($url);
                $newSub->setSubDesc($description);
                $newSub->setSubImg($image);

                if ($newSub->follow($db_json))
                {
                  $response = "Added successfully";

                } else {
                    $response = "Your have already Subscribed to this channel";
                }
                echo $response;
                header("location: ../subscription");
          } else {

            //  $newSub = new Ziki\Core\Subscribe();
              //$newSub->unfollow("elijah");
            }
