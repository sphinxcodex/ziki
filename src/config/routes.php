<?php

use Ziki\Http\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

Route::get('/about/{id}', function($request,$id) {

     return $this->template->render('about-us.html');
});

Route::get('/', function($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $feed = $ziki->fetchAllRss();
    // Render our view
    //print_r($feed);
    return $this->template->render('index.html',['posts' => $feed] );
});


Route::get('stay/{id}', function($request, $id) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
   $result = $ziki->getEach($id);
   return $this->template->render('blog-details.html', ['result' => $result] );
});
Route::get('/timeline', function($request) {
    $user = new Ziki\Core\Auth();
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $post = $ziki->fetchAllRss();
    return $this->template->render('timeline.html', ['posts' => $post] );
});

/*
Route::post('/publish', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    $directory = "./storage/contents/";
    $data = $request->getBody();
    $title = $data['title'];
    $body = $data['postVal'];
    $tags = $data['tags'];
    $ziki = new Ziki\Core\Document($directory);
    $result = $ziki->create($title, $body,$tags);
    return $this->template->render('timeline.html', ['ziki' => $result]);
});
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
Route::post('/timeline', function($request) {
    $data = $request->getBody();
    $url = $_POST['domain'];

    $ziki = new Ziki\Core\Subscribe();
    $result = $ziki->extract($url);
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $feed = $ziki->fetchAllRss();

    return $this->template->render('index.html', ['posts' => $feed]);
});
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  Route::get('/timeline', function($request) {
      $directory = "./storage/contents/";
      $ziki = new Ziki\Core\Document($directory);
      $feed = $ziki->fetchAllRss();
      // Render our view
      //print_r($feed);
      return $this->template->render('timeline.html',['posts' => $feed] );
  });
}

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

Route::post('/subscriptions', function($request) {
    $ziki = new Ziki\Core\Subscribe();
    $count = $ziki->count();
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $sub = $ziki->subscription();

    return $this->template->render('subscriptions.html', ["count" => $count, "posts" => $sub] );
});

Route::get('/subscribers', function($request) {
    return $this->template->render('subscribers.html');
});

Route::get('/editor', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
  return $this->template->render('editor.html');
});

Route::get('/404', function($request) {
    return $this->template->render('404.html');
});

Route::get('/drafts', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('drafts.html');
});

Route::get('/about', function($request) {
    return $this->template->render('about-us.html');
});

Route::get('/download', function($request) {
    return $this->template->render('download.html');
});

Route::get('/auth/{provider}/{token}', function($request, $token){
    $user = new Ziki\Core\Auth();
    $check = $user->validateAuth($token);
    return new RedirectResponse("/timeline");
});

Route::get('/logout', function($request) {
    $user = new Ziki\Core\Auth();
    $user->log_out();
    return new RedirectResponse("/");
});
