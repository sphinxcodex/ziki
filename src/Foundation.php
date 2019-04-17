<?php
namespace Ziki;

use Symfony\Component\Finder\Finder;

class Foundation
{
    /**
     * @var Logger
     */
    protected $logger;
    /**
     * @var string
     */
    protected $cachePath;
    /**
     * @var string
     */
    protected $templatePath;
    /**
     * @var string
     */
    protected $pagesPath;
    /**
     * @var string
     */
    protected $collectionsPath;
    /**
     * @var array
     */
    protected $settings;
    /**
     * @var array
     */
    protected $pages;
    /**
     * @var array
     */
    protected $collections;
    /**
     * @param string $basePath
     * @param Logger $logger
     */
    public function __construct($basePath)
    {
        // $this->settings       = new Setting;
        $this->routePath      = $basePath . DIRECTORY_SEPARATOR . 'src/routes.php';
        // $this->templatesPath  = $basePath . DIRECTORY_SEPARATOR . 'resources/themes' . DIRECTORY_SEPARATOR . $this->settings['theme'] . DIRECTORY_SEPARATOR . 'templates';
        $this->templatePath  = $basePath . DIRECTORY_SEPARATOR . 'resources/themes' . DIRECTORY_SEPARATOR . 'ghost' . DIRECTORY_SEPARATOR . 'templates';
        $this->template       = new Template($this->templatePath);
        // $this->cachePath      = $basePath . DIRECTORY_SEPARATOR . $this->settings['cache_path'];
        // $this->assetsPath     = $basePath . DIRECTORY_SEPARATOR . $this->settings['content_path'] . DIRECTORY_SEPARATOR . 'pages';
        // if (!is_dir($this->cachePath)) {
        //     mkdir($this->cachePath, 0777, true);
        // }
    }

    public function run(){
        include $this->routePath;
    }
}
