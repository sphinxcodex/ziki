<?php
// Load our autoloader
/**
 * add the symphony class
 * add the Frontmatter classes.
 */
use Symfony\Component\Finder;
use KzykHys\FrontMatter\FrontMatter;

class Document{
    //define an instance of the symfony clss
    //define an instance of the frontMatter class

    public function __construct(Finder $finder, FrontMatter $parser) {
       $this->finder = $finder->files()->in('./storage/contents/posts'); //MARKDOWN PATH DEFINED HERE
       $this->parser = $parser;
    }
    //for creating markdown files
    public function createPost(){

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
     * @return void
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