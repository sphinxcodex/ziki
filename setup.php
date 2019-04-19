<?php
include 'classes\setting.php';
$name = "App name";

$Oldvalue = "elijah";
$newValue = "ghost";
            $db_json = file_get_contents("config\ziki.json");
              $newSetting = new Setting();
              $newSetting->setName($name);
              $newSetting->setValue($value);
              $newSetting->update($name, $Oldvalue,$newValue );
 ?>
