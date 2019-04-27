<?php
use Symfony\Component\HttpFoundation\RedirectResponse;

$router->get('/', function ($request) {
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $feed = $ziki->fetchAllRss();
    // Render our view
    //print_r($feed);
    return $this->template->render('index.html', ['posts' => $feed]);
});


$router->get('stay/{id}', function ($request, $id) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $result = $ziki->getEach($id);
    return $this->template->render('blog-details.html', ['result' => $result]);
});
$router->get('/timeline', function ($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $post = $ziki->fetchAllRss();
    return $this->template->render('timeline.html', ['posts' => $post]);
});

/*
$router->post('/publish', function($request) {
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
    $router->post('/timeline', function ($request) {
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
    $router->get('/timeline', function ($request) {
        $directory = "./storage/contents/";
        $ziki = new Ziki\Core\Document($directory);
        $feed = $ziki->fetchAllRss();
        // Render our view
        //print_r($feed);
        return $this->template->render('timeline.html', ['posts' => $feed]);
    });
}

$router->get('/contact-us', function ($request) {
    $ziki = [
        ['name'          => 'Adroit'],
        ['name'          => 'Twig'],
    ];
    return $this->template->render('contact-us.html', ['ziki' => $ziki]);
});


$router->get('/published-posts', function ($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('published-posts.html');
});

$router->get('/themes', function ($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('themes.html');
});

$router->get('/profile', function ($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('profile.html');
});

$router->post('/subscriptions', function ($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    $ziki = new Ziki\Core\Subscribe();
    $count = $ziki->count();
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $sub = $ziki->subscription();

    return $this->template->render('subscriptions.html', ["count" => $count, "posts" => $sub]);
});

$router->get('/subscribers', function ($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('subscribers.html');
});

$router->get('/editor', function ($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('editor.html');
});

$router->get('/404', function ($request) {
    return $this->template->render('404.html');
});

$router->get('/drafts', function ($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('drafts.html');
});

$router->get('/about', function ($request) {
    return $this->template->render('about-us.html');
});

$router->get('/download', function ($request) {
    return $this->template->render('download.html');
});

$router->get('/auth/{provider}/{token}', function ($request, $token) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    $check = $user->validateAuth($token);
    return new RedirectResponse("/timeline");
});

$router->get('/logout', function ($request) {
    $user = new Ziki\Core\Auth();
    $user->log_out();
    return new RedirectResponse("/");
});
