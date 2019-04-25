<?php
namespace Ziki\Core;

use Mni\FrontYAML\Parser;
use KzykHys\FrontMatter\FrontMatter;
use Symfony\Component\Finder\Finder;
use Parsedown;
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
        $file = $this->file;
        $time = date("Y-m-d h:i:sa");
        $unix = strtotime($time);
        $dir = $file.$unix.".yaml";
        //return $dir; die();
        $doc = FileSystem::write($dir, $yaml."\n".$html);
        if ($doc) {
            $result = array("error" => false, "message" => "Post published successfully");
        }
        else{
            $result = array("error" => true, "message" => "Fail while publishing, please try again");
        }
        return $doc;
    }
    //get post
    public function get(){
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($this->file);
        $posts = [];
        if($finder->hasResults()){
            foreach($finder as $file){
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                //$document = FileSystem::read($this->file);
                $parsedown  = new Parsedown();
                $title = $parsedown->text($yaml['title']);
                $slug = $parsedown->text($yaml['slug']);
                $slug = preg_replace("/<[^>]+>/", '',$slug);
                $bd = $parsedown->text($body);
                $time = $parsedown->text($yaml['timestamp']);
                $url = $parsedown->text($yaml['post_dir']);
                $content['title'] = $title;
                $content['body'] = $bd;
                $content['url'] = $url;
                $content['slug'] = $slug;
                $content['timestamp'] = $time;
                array_push($posts, $content);
            }
            return $posts;
        }
        else{
            return false;
        }
    }
    //get each post detail
    public function getEach($id){
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($this->file);
        $posts = [];
        if($finder->hasResults()){
            foreach($finder as $file){
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                //$document = FileSystem::read($this->file);
                $parsedown  = new Parsedown();
                $slug = $parsedown->text($yaml['slug']);
                $slug = preg_replace("/<[^>]+>/", '',$slug);
                if($slug == $id){
                $title = $parsedown->text($yaml['title']);
                $bd = $parsedown->text($body);
                $time = $parsedown->text($yaml['timestamp']);
                $url = $parsedown->text($yaml['post_dir']);
                $content['title'] = $title;
                $content['body'] = $bd;
                $content['url'] = $url;
                $content['timestamp'] = $time;
                array_push($posts, $content);
                }
            }
            return $posts;
        }
    }
    //update post
    public function update(){

    }
    //deletepost
    public function delete(){

    }

}