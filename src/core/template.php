<?php
namespace Ziki\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Template
{
    private $twig;


    public function __construct($templatePath)
    {
        $this->twig = new Environment(new FilesystemLoader($templatePath), $this->setTwigCaching());
    }

    public static function getSettings() {
        $file = "./src/config/settings.json";
        if (file_exists($file)) {
            $content = json_decode(file_get_contents($file), true);
			return $content;
		}
    }

    public function render($page, array $parameters = [])
    {
        $settings = self::getSettings();
        $this->twig->addGlobal('settings', $settings);
        return $this->twig->render($page, $parameters);
    }

    private function setTwigCaching()
    {
        $data = [];

        if (ZIKI_PROD) {
            $data = [
                'auto_reload' => true,
                'cache' => ZIKI_BASE_PATH . '/storage/cache/views',
            ];
        } else {
                $data = [
                    'auto_reload' => true,
                    'cache' => false,
                ];
            }
        return $data;
    }
}
