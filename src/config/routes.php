<?php

use Ziki\Http\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;

session_start();

Router::get('/about/{id}', function($request,$id) {

     return $this->template->render('about-us.html');
});

Router::get('/', function($request) {
    $user = new Ziki\Core\Auth();
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $feed = $ziki->fetchAllRss();
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $host = $user->hash($url);
    // Render our view
    //print_r($feed);
    return $this->template->render('index.html',['posts' => $feed, 'host' => $host] );
});


Router::get('stay/{id}', function($request, $id) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
   $result = $ziki->getEach($id);
   return $this->template->render('blog-details.html', ['result' => $result] );
});
Router::get('/timeline', function($request) {
   
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    
    $directory = "./storage/contents/";
    $ziki = new Ziki\Core\Document($directory);
    $post = $ziki->fetchAllRss();
    return $this->template->render('timeline.html', ['posts' => $post] );
});

Router::post('/publish', function($request) {
    
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    
    $directory = "./storage/contents/";
    $data = $request->getBody();
    $title = $data['title'];
    $body = $data['postVal'];
    $tags = $data['tags'];
    $images = $data['images'];
   
  $ziki = new Ziki\Core\Document($directory);
    $result = $ziki->create($title, $body,$tags,$images);

    return $this->template->render('timeline.html', ['ziki' => $result]);
});

/* Working on draft by devmohy */
Router::post('/saveDraft', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    $directory = "./storage/contents/drafts";
    $data = $request->getBody();
    $title = $data['title'];
    $body = $data['postVal'];
    $tags = $data['tags'];
    $ziki = new Ziki\Core\Document($directory);
    $result = $ziki->create($title, $body,$tags);
    return $this->template->render('drafts.html', ['ziki' => $result]);
});
/* Working on draft by devmohy */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
Router::post('/timeline', function($request) {
  $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
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
  Router::get('/timeline', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
      $directory = "./storage/contents/";
      $ziki = new Ziki\Core\Document($directory);
      $feed = $ziki->fetchAllRss();
      // Render our view
      //print_r($feed);
      return $this->template->render('timeline.html',['posts' => $feed] );
  });
}

Router::get('/contact-us', function($request) {
    include ZIKI_BASE_PATH."/src/core/SendMail.php";
    $checkifOwnersMailIsprovided = new  SendContactMail();
    $checkifOwnersMailIsprovided->getOwnerEmail();
    $message = [];
    if(empty($checkifOwnersMailIsprovided->getOwnerEmail()))
    {
        $message['ownerEmailNotProvided'] = true;
    }
    
    if(isset($_SESSION['messages']))
    {
        $message = $_SESSION['messages'];
        unset($_SESSION['messages']);
    }
    return $this->template->render('contact-us.html',['message'=>$message]);
});

Router::post('/send',function($request){
    include ZIKI_BASE_PATH."/src/core/SendMail.php";
    $request=$request->getBody();
    $SendMail = new SendContactMail();
    $SendMail->mailBody= $this->template->render('mail-template.html',['guestName'=>$request['guestName'],'guestEmail'=>$request['guestEmail'],'guestMsg'=>$request['guestMsg']]);
    $SendMail->sendMail($request);
    $SendMail->clientMessage();
    return $SendMail->redirect('/contact-us');   
});


Router::get('/published-posts', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('published-posts.html');
});

Router::get('/themes', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('themes.html');
});

Router::get('/profile', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('profile.html');
});

Router::post('/subscriptions', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('subscriptions.html');
});

Router::get('/subscribers', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('subscribers.html');
});

Router::get('/editor', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
  return $this->template->render('editor.html');
});

Router::get('/404', function($request) {
    return $this->template->render('404.html');
});

Router::get('/drafts', function($request) {
    $user = new Ziki\Core\Auth();
    if (!$user->is_logged_in()) {
        return new RedirectResponse("/");
    }
    return $this->template->render('drafts.html');
});

Router::get('/about', function($request) {
    return $this->template->render('about-us.html');
});

Router::get('/download', function($request) {
    return $this->template->render('download.html');
});

Router::get('/auth/{provider}/{token}', function($request, $token){
    $user = new Ziki\Core\Auth();
    $check = $user->validateAuth($token);
    if($_SESSION['login_user']['role'] == 'guest'){
        return new RedirectResponse("/");
    }
    else{
        return new RedirectResponse("/timeline");
    }
});

Router::get('/logout', function($request) {
    $user = new Ziki\Core\Auth();
    $user->log_out();
    return new RedirectResponse("/");
});

Router::get('/api/images', function() {
    return (new Ziki\Core\UploadImage)->getAllImages();
});
  
Router::post('/api/upload-image', function() {
    return (new Ziki\Core\UploadImage)->upload();
});
  
