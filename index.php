
<?php
/**
 * Front to the Ziki app. This file doesn't do anything, but bootstraps
 * Ziki to load the theme.
 *
 * @package Ziki
 */
/** Loads the Ziki Environment and Theme */


$app = require( dirname( __FILE__ ) . '/src/bootstrap.php' );
$app = require( dirname( __FILE__ ) . '/src/classes/Route.php' );


$router = new Router(new Request);

$router->get('/post', function() {

    return (new Post)->get_post();
});
