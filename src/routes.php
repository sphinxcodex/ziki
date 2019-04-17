<?php
$router = new Ziki\Http\Router(new Ziki\Http\Request);

$router->get('/', function() {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Olu' ],
        [ 'name'          => 'Amuwo' ],
    ];
    // Render our view
    echo (new Twig)->render('index.html', ['ziki' => $ziki] );
});

$router->get('/profile', function($request) {
    return json_encode($request->getBody());
});