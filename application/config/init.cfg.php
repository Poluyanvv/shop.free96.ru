<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 22.02.2016
 * Time: 22:39
 */

define('USER_DEFAULT_FILE', 'user_default');
define('USER_ROLE_FILE', 'user_role.php');
define('USER_LIST_FILE', 'user_list.php');
define('USER_ADD_FILE', 'user_add.php');
define("MIN_LENGTH_NAME",2);
define("MAX_LENGTH_NAME",15);
define("MIN_LENGTH_MESSAGE",2);
define("MAX_LENGTH_MESSAGE",500);
define('EXTENSION', '.php');

require_once'classes/application.php';
$application = new Application();
Application::setClassDirs();

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






