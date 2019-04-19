<?php
namespace Ziki\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class Template
{
    private $twig;

    public function __construct($templatePath) 
    {
        $this->twig = new Environment( new FilesystemLoader($templatePath),[
            'auto_reload' => true,
            'cache' => ZIKI_BASE_PATH.'storage/cache/views',
        ]);
    }
   
    public function render($page, array $parameters = [])
    {
        return $this->twig->render($page, $parameters);
    }
}