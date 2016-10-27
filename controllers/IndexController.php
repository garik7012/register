<?php


class IndexController
{
//отображение стартовой страницы. По заданию она нам не нужна, делаем редирект на регистрацию
    function index()
    {
        header('Location: /user/register');
    }
}