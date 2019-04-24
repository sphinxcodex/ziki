<?php

use Ziki\Http\Route;

Route::get('/about/{id}', function($request,$id) {
    
     return $this->template->render('about-us.html');
});

Route::get('/', function($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $posts = $ziki->get();
    // Render our view
    return $this->template->render('index.html', ['posts' => $posts] );
});


Route::get('/blog-details/{id}', function($request, $id) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
   $result = $ziki->getEach($id);
   return $this->template->render('blog-details.html', ['result' => $result] );
});
Route::get('/timeline', function($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $post = $ziki->get();
    return $this->template->render('timeline.html', ['posts' => $post] );
});

Route::post('/timeline', function($request) {
    $directory = "./storage/contents/";
    $data = $request->getBody();
    $body = $data['postVal'];
    $ziki = new Ziki\Core\Document($directory);
    $result = $ziki->create($body);
    return $this->template->render('timeline.html', ['ziki' => $result]);
});

Route::get('/contact-us', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Twig' ],
    ];
    return $this->template->render('contact-us.html', ['ziki' => $ziki] );
});

Route::get('/published-posts', function($request) {
    return $this->template->render('published-posts.html');
});

Route::get('/themes', function($request) {
    return $this->template->render('themes.html');
});

Route::get('/profile', function($request) {
    return $this->template->render('profile.html');
});

Route::get('/subscriptions', function($request) {
    return $this->template->render('subscriptions.html');
});

Route::get('/subscribers', function($request) {
    return $this->template->render('subscribers.html');
});

Route::get('/editor', function($request) {
  return $this->template->render('editor.html');
});

Route::get('/404', function($request) {
    return $this->template->render('404.html');
});

Route::get('/drafts', function($request) {
    return $this->template->render('drafts.html');
});

Route::get('/about', function($request) {
    return $this->template->render('about-us.html');
});
