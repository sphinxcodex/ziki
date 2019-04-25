<?php
namespace Ziki\Core;

/**
 *
 */
class Subscribe
{
  var $name;
  var $rss;
  var $img;
  var $desc;

  public function setSubName($value)
  {
    $this->name = $value;
  }
  public function setSubRss($value)
  {
    $this->rss = $value;
  }
  public function setSubDesc($value)
  {
    $this->desc = $value;
  }
  public function setSubImg($value)
  {
    $this->img = $value;
  }
  public function follow($db)
  {
    //Saving new post
    $db = "C:/Users/user/ziki-1/storage/rss/subscriber.json";
    $file = file_get_contents($db, true);
    $data = json_decode($file, true);
    unset($file);
    foreach ($data as $key => $value) {

      if ($value["name"] == $this->name) {
        // $message="Your have already Subscribed to this channel";

        return false;
      } else {
        return true;
      }
    };
    if (true) {

      $time = date("Y-m-d h:i:sa");

      $img = $this->img;
      $sub[] = array('name' => $this->name, 'rss' => $this->rss, 'desc' => $this->desc, 'img' => $this->img, 'time' => $time);
      $json_db = "C:/Users/user/ziki-1/storage/rss/subscriber.json";
      $prev_sub = json_decode($db);

      $new = array_merge($sub, $prev_sub);
      $fp = fopen($json_db, 'w') or die("post DB not found");
      //die(json_encode($new));
      $new_sub = fwrite($fp, json_encode($new));
      fclose($fp);

      return true;
    } else {
      return false;
    }
  }
  public function unfollow($del)
  {
    $db = "storage/contents/subscriber.json";
    $file = file_get_contents($db, true);
    $data = json_decode($file, true);
    unset($file);
    foreach ($data as $key => $value) {

      if ($value["name"] == $del) {
        unset($data[$key]);
      }
    };

    $result = json_encode($data);
    file_put_contents($db, $result);
    unset($result);
  }
}
