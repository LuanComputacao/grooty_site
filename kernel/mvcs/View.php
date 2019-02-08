<?php


namespace Kernel\mvcs;


use Exception;
use InvalidArgumentException;
use Kernel\Conf;
use Twig_Environment;
use Twig_Loader_Filesystem;

class View
{
    private static $loader;
    private static $twig;
    private static $cacheFolder;
    private static $viewsFolder;
    private static $instance;


    public function __construct()
    {
        self::setCacheFolder();
        self::setViewsFolder();
        self::loadTwig();
    }

    private static function setCacheFolder()
    {
        self::$cacheFolder = Conf::getConf('cache_folder') ?? '/tmp/twig/grooty';
    }

    private static function setViewsFolder()
    {
        self::$viewsFolder = APP_DIR . (Conf::getConf('views_folder') ?? 'views');
    }

    private static function loadTwig()
    {
        self::$loader = new Twig_Loader_Filesystem(self::$viewsFolder);
        self::$twig = new Twig_Environment(self::$loader, ['cache' => self::$cacheFolder]);
    }

    public static function render($view, array $args = [])
    {
        self::checkInstance();

        try {
            self::refreshDevEnv();

            echo self::$twig->render($view . '.twig', $args);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function mount(string $view, array $args = []): string
    {
        self::checkInstance();
        self::refreshDevEnv();
        return self::$twig->render($view . '.twig', $args);
    }

    public static function responseJson(array $jsonContent)
    {
        header('Content-Type: application/json');
        echo json_encode($jsonContent);
    }


    private static function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
//        rmdir($dirPath);
    }

    private static function checkInstance(): void
    {
        if (!isset(self::$instance)) {
            $stClass = __CLASS__;
            self::$instance = new $stClass();
        }
    }

    private static function refreshDevEnv(): void
    {
        if (Conf::getConf('env') == 'dev') {
            self::deleteDir(self::$cacheFolder);
            self::loadTwig();
        }
    }
}