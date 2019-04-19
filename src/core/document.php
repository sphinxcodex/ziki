<?php
namespace Ziki\Core;

/**
 *	The Document class holds all properties and methods of a single page document.
 *
 */

class Document{
    //define an instance of the symfony clss
    //define an instance of the frontMatter class

    public function __construct( $file, FrontMatter $parser) {
       $this->parser = $parser;
    }
    //for creating markdown files
    public function create(){

    }
    //get post
    public function get(){

    }
    //update post
    public function update(){

    }
    //deletepost
    public function delete(){

    }

}