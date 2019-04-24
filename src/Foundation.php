<?php
namespace Ziki;
use Ziki\Core as Core;

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
     * @param string $basePath
     * @param Logger $logger
     */
    public function __construct($basePath,$logger)
    {
        $this->basePath = $basePath;
        $this->logger = $logger;
        $this->loadConfig();
        $this->loadTemplate();
    }
    
    private function loadConfig()
    {
        $this->configPath = $this->basePath . DIRECTORY_SEPARATOR . 'src/config/ziki.json';
        Core\Config::json($this->configPath);
    }

    private function loadTemplate()
    {
        $this->templatePath = $this->basePath . DIRECTORY_SEPARATOR . 'resources/themes' . DIRECTORY_SEPARATOR . THEME . DIRECTORY_SEPARATOR . 'templates';
        $this->template = new Core\Template($this->templatePath);
    }

    public function start() {
        require_once $this->basePath . DIRECTORY_SEPARATOR . 'src/config/routes.php';
        echo $this->template->render('404.html');
    }
}
