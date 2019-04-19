<?php

require_once __DIR__."/models/Post.php";

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

$router->post('/timeline', function($request) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $ziki = new Post();
    $ziki->createPost($title, $body);
    $ziki = [
        [ 'error'  => false ],
        [ 'message'  => 'Post published successfully' ],
    ];
    return $this->template->render('timeline.html', ['ziki' => $ziki]);
});

$router->get('/timeline', function() {
    $ziki = new Post();
    $ziki = $ziki->getPost();
    return $this->template->render('timeline.html', ['ziki' => $ziki] );
});

$router->get('/contact-us', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Twig' ],
    ];

    return $this->template->render('contact-us.html', ['ziki' => $ziki] );
});

$router->get('/published-posts', function($request) {
    return $this->template->render('published-posts.html');
});

$router->get('/theme', function($request) {
    return $this->template->render('theme.html');
});

$router->get('/profile', function($request) {
    return $this->template->render('profile_page.html');
});

$router->get('/following', function($request) {
    return $this->template->render('following.html');
});

$router->get('/followers', function($request) {
    return $this->template->render('followers.html');
});

$router->get('/editor', function($request) {
    return $this->template->render('editor.html');
});
