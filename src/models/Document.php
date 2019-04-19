<?php
// Load our autoloader
/**
 * add the symphony class
 * add the Frontmatter classes.
 */
use Symfony\Component\Finder\Finder;
use KzykHys\FrontMatter\FrontMatter;

class Document{
    /**
     * @var string
     */
    protected $basePath;
    /**
     * @var SplFileInfo
     */
    protected $file;
    /**
     * @var string
     */
    protected $slug;
    /**
     * @var string
     */
    protected $collection;
    /**
     * @param string $basePath
     * @param SplFileInfo $file
     * @param string $collection
     */
    public function __construct($basePath, $file)
    {
        $this->basePath   = $basePath;
        $this->file       = $file;
        $this->collection = $collection;
        $this->slug       = $this->generateSlug();
    }
    /**
     * @return string
     */
    protected function generateSlug()
    {
        $path = $this->file->getPath();
        if ($this->collection) {
            $path = $this->file->getPathname();
        }
        $slug = str_replace($this->basePath, '', $path);
        $slug = preg_replace('/(\/.*?\.)/', '/', $slug);
        $slug = preg_replace('/\.md$/', '', $slug);
        if ($this->collection) {
            $slug = '/' . $this->collection . $slug;
        }
        if (!$slug) {
            $slug = '/';
        }
        return $slug;
    }
    /**
     * @return string
     */
    public function file()
    {
        return $this->file;
    }
}