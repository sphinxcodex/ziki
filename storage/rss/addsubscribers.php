<?php
include "./src/core/subscribe.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //$title = isset($_POST['title']) ? trim($_POST['title']) : null;

    $name= "Elijah";
    $rss = "/storage/contents/rss.xml";
    $img = "/landing/assets/img/black-logo.png";

                $db_json = file_get_contents("C:\Users\user\ziki-1\storage\contents\subscriber.json");
                $newSub = new Ziki\Core\Subscribe();
                $newSub->setSubName($name);
                $newSub->setSubRss($rss);
                $newSub->setSubimg($img);
                if ($newSub->follow($db_json, $name, $rss, $img)) {
                    $response = array('error' => false, 'message' => 'post published successfully');
                } else {
                    $response = array('error' => true, 'message' => 'error occured while posting');
                }
            } else {

            //  $newSub = new Ziki\Core\Subscribe();
              //$newSub->unfollow("elijah");
            }

    //die(json_encode($response));
    //header("Location: {$site_url}/timeline.php");
