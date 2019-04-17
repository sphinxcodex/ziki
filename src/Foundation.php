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
    protected $viewsPath;
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
    public function __construct($basePath, $logger)
    {
        $this->logger = $logger;
        // $this->settings       = new Setting;
        // $this->cachePath      = $basePath . DIRECTORY_SEPARATOR . $this->settings['cache_path'];
        // $this->templatesPath  = $basePath . DIRECTORY_SEPARATOR . $this->settings['themes_path'] . DIRECTORY_SEPARATOR . $this->settings['theme'];
        // $this->assetsPath     = $basePath . DIRECTORY_SEPARATOR . $this->settings['content_path'] . DIRECTORY_SEPARATOR . 'pages';
        // if (!is_dir($this->cachePath)) {
        //     mkdir($this->cachePath, 0777, true);
        // }
    }
}
