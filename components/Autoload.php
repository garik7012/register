<?php
/*
 * автозагруска классов
 */
function __autoload($class_name)
{
    # список всех дирректорий классов
    $array_paths = array(
        '/models/',
        '/components/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}