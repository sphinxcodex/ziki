<?php

$router->get('/', function($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $feed = $ziki->fetchAllRss();
    // Render our view
    //print_r($feed);
    return $this->template->render('index.html',['posts' => $feed] );
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
  $directory = "./storage/contents/";
  $ziki = new Ziki\Core\Document($directory);
  $feed = $ziki->fetchRss();
    //var_dump($feed);
    return $this->template->render('timeline.html', ['posts' => $feed]);
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

$router->get('/themes', function($request) {
    return $this->template->render('themes.html');
});

$router->get('/profile', function($request) {
    return $this->template->render('profile.html');
});

$router->get('/subscriptions', function($request) {

    return $this->template->render('subscriptions.html');
});

$router->get('/subscribers', function($request) {
  $directory = "./storage/contents/";
  $ziki = new Ziki\Core\Document($directory);
  $list = $ziki->subscriber();
  print_r($list);
    return $this->template->render('subscribers.html', ['sub' => $list] );
});

$router->get('/editor', function($request) {
  return $this->template->render('editor.html');
});

$router->get('/404', function($request) {
    return $this->template->render('404.html');
  });

  $router->get('/drafts', function($request) {
    return $this->template->render('drafts.html');
  });
  $router->get('/about', function($request) {
    return $this->template->render('about-us.html');
  });
