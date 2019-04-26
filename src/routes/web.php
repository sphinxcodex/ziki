<?php

$router->get('/about/{id}', function($request,$id) {

     return $this->template->render('about-us.html');
});

$router->get('/', function($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $feed = $ziki->fetchAllRss();
    // Render our view
    //print_r($feed);
    return $this->template->render('index.html',['posts' => $feed] );
});


$router->get('/blog-details/{id}', function($request, $id) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
   $result = $ziki->getEach($id);
   return $this->template->render('blog-details.html', ['result' => $result] );
});
$router->get('/timeline', function($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $post = $ziki->fetchAllRss();
    return $this->template->render('timeline.html', ['posts' => $post] );
});

$router->post('/publish', function($request) {
    $directory = "./storage/contents/";
    $data = $request->getBody();
    $title = $data['title'];
    $body = $data['postVal'];
    $ziki = new Ziki\Core\Document($directory);
    $result = $ziki->create($title, $body);
    return $this->template->render('timeline.html', ['ziki' => $result]);
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

$router->post('/subscriptions', function($request) {
    return $this->template->render('subscriptions.html');
});

$router->get('/subscribers', function($request) {
    return $this->template->render('subscribers.html');
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
$router->get('/auth/{provider}/{token}', function($request, $token){
    $user = new Ziki\Core\Auth();
    $check = $user->validateAuth($token);
    if($check){
        var_dump($check);
        die();
    }
    return $this->redirectToRoute("/timeline");
});
