<?php

$router = new Ziki\Http\Router(new Ziki\Http\Request);

$router->get('/', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Olu' ],
        [ 'name'          => 'Amuwo' ],
    ];
    // Render our view
    return $this->template->render('index.html', ['ziki' => $ziki] );
});

$router->get('/blog-details', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Olu' ],
        [ 'name'          => 'Amuwo' ],
    ];
    return $this->template->render('blog-details.html', ['ziki' => $ziki] );
});

$router->get('/blog-details', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Olu' ],
        [ 'name'          => 'Amuwo' ],
    ];
    return $this->template->render('blog-details.html', ['ziki' => $ziki] );
});

$router->get('/timeline', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Twig' ],
    ];

    return $this->template->render('timeline.html', ['ziki' => $ziki] );
});

$router->get('/contact-us', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Twig' ],
    ];

    return $this->template->render('contact-us.html', ['ziki' => $ziki] );
});

$router->get('/settings', function($request) {
    return $this->template->render('settings.html');
});