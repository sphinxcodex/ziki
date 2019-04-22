<?php
use Ziki\Http\Router;

Router::get('/about/{any:id}', function($id) {
    return $id;
    return $this->template->render('about-us.html');
  });

Router::get('/', function($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $posts = $ziki->get();
    // Render our view
    return $this->template->render('index.html', ['posts' => $posts] );
});

Router::get('/blog-details', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Olu' ],
        [ 'name'          => 'Amuwo' ],
    ];
    return $this->template->render('blog-details.html', ['ziki' => $ziki] );
});

Router::get('/timeline', function($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $post = $ziki->get();
    return $this->template->render('timeline.html', ['posts' => $post] );
});

Router::post('/timeline', function($request) {
    $directory = "./storage/contents/";
    $data = $request->getBody();
    $body = $data['postVal'];
    $ziki = new Ziki\Core\Document($directory);
    $result = $ziki->create($body);
    return $this->template->render('timeline.html', ['ziki' => $result]);
});

Router::get('/contact-us', function($request) {
    $ziki = [
        [ 'name'          => 'Adroit' ],
        [ 'name'          => 'Twig' ],
    ];
    return $this->template->render('contact-us.html', ['ziki' => $ziki] );
});

Router::get('/published-posts', function($request) {
    return $this->template->render('published-posts.html');
});

Router::get('/themes', function($request) {
    return $this->template->render('themes.html');
});

Router::get('/profile', function($request) {
    return $this->template->render('profile.html');
});

Router::get('/subscriptions', function($request) {
    return $this->template->render('subscriptions.html');
});

Router::get('/subscribers', function($request) {
    return $this->template->render('subscribers.html');
});

Router::get('/editor', function($request) {
  return $this->template->render('editor.html');
});

Router::get('/404', function($request) {
    return $this->template->render('404.html');
});

Router::get('/drafts', function($request) {
    return $this->template->render('drafts.html');
});

Router::get('/about', function($request) {
    return $this->template->render('about-us.html');
});
