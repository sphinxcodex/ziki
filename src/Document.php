<?php
// Load our autoloader
/**
 * add the symphony class
 * add the Frontmatter classes.
 */

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Finder\Finder;
use KzykHys\FrontMatter\FrontMatter;
use KzykHys\FrontMatter\Document;

class Document{
    //define an instance of the symfony clss
    private $finder = new Finder();
    //define an instance of the document class
    private $document = new Document();
    //define an instance of the frontMatter class
    private $parser =  new FrontMatter();

    public function __construct() {
       $this->finder = $finder->files()->in('mardown_path'); //MARKDOWN PATH DEFINED HERE
       $this->document = $document;
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