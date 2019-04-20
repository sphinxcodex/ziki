<?php
namespace Ziki\Core;

use Ziki\Core\FileSystem as FileSystem;
use Mni\FrontYAML\Parser;
use KzykHys\FrontMatter\FrontMatter;
/**
 *	The Document class holds all properties and methods of a single page document.
 *
 */

class Document{
    //define an instance of the symfony clss
    //define an instance of the frontMatter class

    protected $file;

    public function __construct($file) {
        $this->file       = $file;
    }

    public function file()
    {
        return $this->file;
    }

    //for creating markdown files
    public function create($content){
        // Write md file
        $document = FrontMatter::parse($content);
        $md = new Parser();
        $markdown = $md->parse($document);
        $yaml = $markdown->getYAML();
        $html = $markdown->getContent();
        $doc = FileSystem::write($this->file, $yaml."\n".$html);
        return $doc;
    }
    //get post
    public function get(){
        $document = FileSystem::read($this->file);
        $parsedown  = new Parsedown();
        $html = $parsedown->text($document);
        return $html;
    }
    //update post
    public function update(){

    }
    //deletepost
    public function delete(){

    }

}