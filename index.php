
<?php
/**
 * Front to the Ziki app. This file doesn't do anything, but bootstraps
 * Ziki to load the theme.
 *
 * @package Ziki
 */
/** Loads the Ziki Environment and Theme */

$app = require( dirname( __FILE__ ) . '/src/bootstrap.php' );

$router = new Router(new Request);


$router->get('/profile', function() {
    
    echo "hello there";
  });
  
  $request = $_SERVER['REQUEST_URI'];

  if (strlen($request) > 1) {
    $request = rtrim($request, '/');
  }

  switch ($request) {
      
      case '/' :
          $ziki = [
                    [ 'name'          => 'Adroit' ],
                    [ 'name'          => 'Olu' ],
                    [ 'name'          => 'Amuwo' ],
                ];

            // Render our view
            echo $twig->render('index.html', ['ziki' => $ziki] );
          break;
      case '/page' :
          $ziki = [
                    [ 'name'          => 'Adroit' ],
                    [ 'name'          => 'Twig' ],
                ];

            // Render our view
            echo $twig->render('timeline.html', ['ziki' => $ziki] );
          break;
      case '/about' :
          echo $twig->render('settings.html', ['ziki' => $ziki] );
          break;
     

    //   default:
    //       require __DIR__ . '/resources/themes/ghost/template/404.html';
    //       break;
  }
