
<?php
/**
 * Front to the Ziki app. This file doesn't do anything, but bootstraps
 * Ziki to load the theme.
 *
 * @package Ziki
 */
/** Loads the Ziki Environment and Theme */



// $app = require( dirname( __FILE__ ) . '/src/bootstrap.php' );
$app = require( dirname( __FILE__ ) . '/src/classes/api/Router.php' );
$app = require( dirname( __FILE__ ) . '/src/classes/api/Request.php' );


$router = new Router(new Request);

$router->get('/post', function() {

    return (new Post)->get_post();
});

$router->get('/profile', function() {
    
    echo "hello there";
  });
  
  $request = $_SERVER['REQUEST_URI'];

  if (strlen($request) > 1) {
    $request = rtrim($request, '/');
  }

  switch ($request) {
      
      case '/i' :
          require __DIR__ . '/resources/themes/ghost/templates/index.html';
          break;
      case '/page' :
          require __DIR__ . '/resources/themes/ghost/templates/timeline.html';
          break;
      case '/about' :
          require __DIR__ . '/resources/themes/ghost/template/settings.html';
          break;
     

    //   default:
    //       require __DIR__ . '/resources/themes/ghost/template/404.html';
    //       break;
  }
