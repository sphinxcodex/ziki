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
       $this->finder = $finder->files()->in('mardown_path'); //MARKDOWN PATH DEFINED HERE
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
}