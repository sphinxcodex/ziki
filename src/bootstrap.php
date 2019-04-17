<?php
// Load our autoloader
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/classes/api/Router.php';
require_once __DIR__.'/classes/api/Request.php';

// Specify our Twig templates location
$loader = new Twig_Loader_Filesystem(__DIR__.'/../resources/themes/ghost/templates');

// Instantiate our Twig
$twig = new Twig_Environment($loader);

$logger = new Monolog\Logger('Ziki');
$logger->pushHandler(new Monolog\Handler\StreamHandler( __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'app.log'));
Monolog\ErrorHandler::register($logger);