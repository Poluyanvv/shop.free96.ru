<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 24.02.2016
 * Time: 18:37
 */
class Application
{
    private static $rootDir = '.';
    private static $applicationDir = 'application';
    private static $controllersDir = 'controllers';
    private static $baseClassDirs = 'classes';
    private static $modelDir = 'models';
    private static $templatesDir = 'views';
    private static $classDirs = array();
    private static $uploadDir = 'media';
    private static $httpRoot = '/';
    private static $baseTemplate = 'home';

    public static function setRootDir($path)
    {
        self::$rootDir = $path;
    }
    public static function getRootDir()
    {
        return self::$rootDir;
    }

    public static function setBaseClassDir($path)
    {
        self::$baseClassDirs = $path;
    }

    public static function getBaseClassDir()
    {
        return self::$baseClassDirs;
    }

    public static function setApplicationDir($path)
    {
        self::$applicationDir = $path;
    }

    public static function getApplicationDir()
    {
        return self::$applicationDir;
    }

    public static function setControllersDir($path)
    {
        self::$controllersDir = $path;
    }

    public static function getControllersDir()
    {
        return self::$controllersDir;
    }
    public static function setModelsDir($path)
    {
        self::$modelDir = $path;
    }

    public static function getModelsDir()
    {
        return self::$modelDir;
    }

    public static function setHttpRoot($path)
    {
        self::$httpRoot = $path;
    }

    public static function getHttpRoot()
    {
        return self::$httpRoot;
    }

    public static function setUploadDir($path)
    {
        self::$uploadDir = $path;
    }

    public static function setBaseTemplate($path)
    {
        self::$baseTemplate = $path;
    }

    public static function getBaseTemplate()
    {
        return self::$baseTemplate;
    }

    public static function getUploadDir($full = false)
    {
        if (!$full)
            return DIRECTORY_SEPARATOR . self::$uploadDir;
        return self::getRootDir(). DIRECTORY_SEPARATOR .self::$uploadDir;
    }
    public static function setTemplatesDir($path)
    {
        self::$templatesDir = $path;
    }

    public static function getTemplatesDir()
    {
         return self::getRootDir(). DIRECTORY_SEPARATOR .self::getApplicationDir(). DIRECTORY_SEPARATOR .self::$templatesDir;
    }

    public static function addClassDir($path)
    {
        self::$classDirs[] = $path;
    }

    public static function setClassDirs()
    {
        self::addClassDir(self::getRootDir(). DIRECTORY_SEPARATOR .self::getApplicationDir(). DIRECTORY_SEPARATOR .self::getControllersDir(). DIRECTORY_SEPARATOR);
        self::addClassDir(self::getRootDir(). DIRECTORY_SEPARATOR .self::getApplicationDir(). DIRECTORY_SEPARATOR .self::getModelsDir(). DIRECTORY_SEPARATOR);
        self::addClassDir(self::getRootDir(). DIRECTORY_SEPARATOR .self::getBaseClassDir(). DIRECTORY_SEPARATOR);
    }
    public static function getClassDir()
    {
        return self::$classDirs;
    }
}