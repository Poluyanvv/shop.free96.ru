<?php
header("Content-Type: text/html; charset=UTF-8");

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

/* Инициализация и запуск PageController */
/* @var $front PatchController*/
try {
	require_once ('application/config/db.cfg.php');
	require_once ('application/config/init.cfg.php');

    $front = new PatchController();
	$front->route();

} catch (Exception $e) {
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");

    $front = new PatchController('error404');
    $front->route();
}
