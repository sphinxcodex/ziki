<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class Twig
{
    public $twig;
    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../../resources/themes/ghost/templates');
        $this->twig =  new \Twig\Environment($loader);
    }
   
    public function render($page, array $parameters = [])
    {
        return $this->twig->render($page, $parameters);
    }
    
}