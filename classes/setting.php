<?php

/**
 *
 */
class Setting
{
  var $name;
  Var $value;

  public function setName($new_Name) {
      $this->name = $new_Name;
  }
  public function setValue($new_Value) {
      $this->value = $new_Value;
  }
  public function getName() {
      return $this->name;
  }
  public function getValue() {
      return $this->value;
  }


  public function add()
  {

                  $prev_set = array();
                      //  $set = array();
                        $set[] = array( $this->name => $this->value);
                        $db = file_get_contents("config/ziki.json");
                        $prev_set = json_decode($db);
                        $new =array_merge($set, $prev_set);

                        $fp = fopen('config/ziki.json', 'w');
                        $new =fwrite($fp, json_encode($new));
                        fclose($fp);
      }

public function update($name, $oldValue, $newValue)
{

$jsonContents = file_get_contents('config/ziki.json');

$data = json_decode($jsonContents, true);
foreach ($data as $key => $value) {

    if ($data[$key][$name] == $oldValue) {
       $data[$key][$name] = $newValue;
    }
};
$json = json_encode($data);
file_put_contents('config/ziki.json', $json);

}
}

 ?>
