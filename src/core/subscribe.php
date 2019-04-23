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

  public function setSubName($value)
  {
    $this->name = $value;
  }
  public function setSubRss($value)
  {
    $this->rss = $value;
  }
  public function setSubimg($value)
  {
    $this->img = $value;
  }
public function follow($db, $name, $rss, $img)
{
              //Saving new post

              $time = date("Y-m-d h:i:sa");

                  $img = $this->img;
                  $sub[] = array('name'=> $this->name, 'rss'=>$this->rss, 'img'=> $this->img, 'time' => $time);
                  $json_db = "storage/contents/subscriber.json";
                  $prev_sub = json_decode($db);
                  $new =array_merge($sub, $prev_sub);
                  $fp = fopen($json_db, 'w') or die("post DB not found");
                  //die(json_encode($new));
                  $new_sub = fwrite($fp, json_encode($new));
                  fclose($fp);

                  return true;


}
public function unfollow($del)
{
            $db = "storage/contents/subscriber.json";
            $file = file_get_contents($db, true);
            $data=json_decode($file,true);
            unset($file);
           foreach ($data as $key => $value) {

               if ($value["name"] == $del) {
              unset($data[$key]);
              }
           };

            $result=json_encode($data);
            file_put_contents($db, $result);
            unset($result);
          }


}
