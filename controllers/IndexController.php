<?php


class IndexController
{
//отображение стартовой страницы
    function index()
    {
        require_once(ROOT . '/views/index.php');
        return true;
    }
}