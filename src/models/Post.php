<?php
// Load our autoloader
/**
 * add the symphony class
 * add the Frontmatter classes.
 */

use Symfony\Component\Finder;
use KzykHys\FrontMatter\FrontMatter;
use KzykHys\FrontMatter\Document;

class Post{
    //define an instance of the symfony clss
    //define an instance of the frontMatter class
    public function createPost($title, $body){
        global $site_url;
        $document = new Document();
        $document['title'] = $title;
        $document['post_dir'] = "{$site_url}/storage/contents/posts/";
        $document->setContent($body);
        $result= FrontMatter::dump($document);
        $parsedown  = new Parsedown();
        $header_html = $parsedown->text($title);
        // Extract the title
        $arr = explode('</h1>', $header_html);
        $header = str_replace('<h1>','',$arr[0]);
        $file = $title."-".date("Y-m-d h:i:sa");
        $yaml = fopen("./storage/contents/posts/{$header}.yaml", "w") or die ("failed while creating file");
        $result = fwrite($yaml, $result);
        fclose($yaml);
        return $result;
    }
    //get post
    public function getPost(){

    }
    //update post
    public function updatePost(){

    }
    //deletepost
    public function deletePost(){

    }

    /**
     * gets posts in all files in a folder
     * specified in the argument, returns a json string
     * success and false on failure
     *
     * @return bool
     */
    public function getAllPosts($directory){
        $finder = new Finder();
        // find all files in the specified directory
        $finder->files()->in($directory);
        $posts = [];

        //checks if there are any results
        if($finder->hasResults()){
            foreach($finder as $file){
                $content = $file->getContents();
                array_push($posts, $content);
            }
            $post_json = json_encode($posts);
            return $post_json;
        }
        else{
            return false;
            
        }
    }
}