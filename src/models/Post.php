<?php
// Load our autoloader
/**
 * add the symphony class
 * add the Frontmatter classes.
 */

use Symfony\Component\Finder\Finder;
use KzykHys\FrontMatter\FrontMatter;
use KzykHys\FrontMatter\Document;
use Mni\FrontYAML\Parser;

class Post{
    //define an instance of the symfony clss
    //define an instance of the frontMatter class
    public function createPost($title, $body){
        global $site_url;
        $document = new Document();
        $document['title'] = $title;
        $document->setContent($body);
        $parsedown  = new Parsedown();
        $header_html = $parsedown->text($title);
        // Extract the title
        $arr = explode('</h1>', $header_html);
        $head = str_replace('<h1>','',$arr[0]);
        $header = str_replace(' ', '-', $head);
        $time = date("F j, Y, g:i a");
        $timestamp = strtotime($time);
        //$file = $header."-".$timestamp;
        $file = $timestamp;
        $yaml = fopen("./storage/contents/posts/{$file}.yaml", "w") or die ("failed while creating file");
        $document['post_dir'] = "{$site_url}/storage/contents/posts/{$file}.yaml";
        $document['slug'] = "post-detail-{$timestamp}";
        $document['timestamp'] = $time;
        $result= FrontMatter::dump($document);
        $result = fwrite($yaml, $result);
        fclose($yaml);
        return $result;
    }
    //get post
    public function getPost(){
        global $site_url;
        $directory = "./storage/contents/posts";
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($directory);
        $posts = [];
        if($finder->hasResults()){
            foreach($finder as $file){
                $raw = $file->getContents();
                /*$parsedown  = new Parsedown();
                $content = $parsedown->text($raw);
                array_push($posts, $content);*/
                $parser = new Parser();
                $document = $parser->parse($raw);
                $yaml = $document->getYAML();
                $html = $document->getContent();
                $parsedown  = new Parsedown();
                $title = $parsedown->text($yaml['title']);
                $content['title'] = $title;
                $content['body'] = $html;
                $content['url'] = $yaml['post_dir'];
                $content['timestamp'] = $yaml['timestamp'];
                $content['slug'] = $yaml['slug'];
                array_push($posts, $content);
            }
            return $posts;
        }
        else{
            return false;
            
        }
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