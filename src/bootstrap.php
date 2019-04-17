<?php
// Load our autoloader
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/classes/api/Router.php';
require_once __DIR__.'/classes/api/Request.php';
require_once __DIR__ . '/classes/Twig.php';

$logger = new Monolog\Logger('Ziki');
$logger->pushHandler(new Monolog\Handler\StreamHandler( __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'app.log'));
Monolog\ErrorHandler::register($logger);
