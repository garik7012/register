<?php

// Отображение ошибок
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
include (ROOT . '/config/config.php');
require_once(ROOT.'/components/Autoload.php');


// Вызов Router
$router = new Router();
$router->run();