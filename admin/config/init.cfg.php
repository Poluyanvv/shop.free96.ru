<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 18:39
 */
define("MIN_LENGTH_NAME",2);
define("MAX_LENGTH_NAME",15);
define("MIN_LENGTH_MESSAGE",2);
define("MAX_LENGTH_MESSAGE",500);
define('EXTENSION', '.php');

require_once'../classes/application.php';
$application = new Application();
Application::setRootDir('..');
Application::setApplicationDir('admin');
Application::setHttpRoot('/admin/');
Application::setBaseTemplate('home_admin');
Application::setClassDirs();
//var_dump(Application::getClassDir());

/* Автозагрузчик классов */
spl_autoload_register(function($class_name) {
    $patches = Application::getClassDir();

    foreach ($patches as $patch) {
        if (file_exists($patch . strtolower($class_name) . EXTENSION)) {
            require_once($patch. strtolower($class_name) . EXTENSION);
            break;
        }
    }
});
$db = Database::getInstance();

/* @var $db Database */
Register::add('mysqli', $db->getConnection());


