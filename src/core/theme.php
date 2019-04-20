<?php 

use Symfony\Component\Finder\Finder;

class Theme {

    public $themes_path = 'resources/themes';
    public $finder;

    public function __construct()
    {
        $this->finder =  new Finder();
    } 

    public function get_themes_dir()
    {
         $dirs = $this->finder->directories()->in($this->themes_path)->depth('< 1');
         $dir_path_array = [];

        if(!$dirs->hasResults())
         {
             return false;
         }

         foreach ($dirs as $dir)
         {
           $dir_path_array[] = $dir->getRealPath();
         }

         print_r($dir_path_array);
    }
}