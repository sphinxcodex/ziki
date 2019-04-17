<?php
$router = new Ziki\Http\Router(new Ziki\Http\Request);

$router->get('/', function() {
    echo "Profile page";
});

$router->get('/profile', function($request) {
    return json_encode($request->getBody());
});