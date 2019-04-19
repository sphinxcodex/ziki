
<?php
/**
 * Front to the Ziki app. This file doesn't do anything, but bootstraps
 * Ziki to load the theme.
 *
 * @package Ziki
 */

define('ZIKI_BASE_PATH', __DIR__);

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/
include 'config\config.php';
require ZIKI_BASE_PATH .'/vendor/autoload.php';

$logger = new Monolog\Logger('Ziki');
$logger->pushHandler(new Monolog\Handler\StreamHandler( ZIKI_BASE_PATH . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'app.log'));
Monolog\ErrorHandler::register($logger);

$ziki = new Ziki\Foundation(ZIKI_BASE_PATH);

$ziki->run();
