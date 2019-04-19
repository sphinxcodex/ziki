<?php
namespace Ziki\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class Template
{
    private $twig;

    public function __construct($templatePath){
        $this->twig = new Environment(new FilesystemLoader($templatePath));
    }
   
    public function render($page, array $parameters = [])
    {
        return $this->twig->render($page, $parameters);
    }
}