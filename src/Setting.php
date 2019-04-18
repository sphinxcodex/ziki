<?php
//namespace Ziki;

class Setting
 {
    var $name;
    var $theme;

public function setAppName($newAppName)
{
  $this->name = $newAppName;
}
public function setThemeName($newThemeName)
{
  $this->theme = $newThemeName;
}
public function getAppName()
{
  return $this->name;

}
public function getThemeName()
{
  return $this->theme;
}
public function add($db) {
  $app = $this->name;
  $theme = $this->theme;
  $setting[] = array('App_name'=> $app, 'Theme_Name'=>$theme);
  $json_file = "config/ziki.json";
  $set = fopen($json_file, 'w') or die("post DB not found");

  $new = fwrite($set, json_encode($setting));
  fclose($set);


  return true;


}
public function update($AppName, $newThemeName )
{
  $jsonContents = file_get_contents('config\ziki.json');

$data = json_decode($jsonContents, true);
foreach ($data as $key => $value) {
    if ($value['App_name'] == $AppName) {
        $data[$key]['Theme_Name'] = $newThemeName;
    }
};
$json = json_encode($data);
file_put_contents('config/ziki.json', $json);

}


}

?>
