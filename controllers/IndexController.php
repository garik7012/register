<?php


class IndexController
{
//отображение стартовой страницы. По заданию она нам не нужна, делаем редирект на регистрацию
    public function index()
    {
        header('Location: /user/register/');
    }
    
    public function setLanguage($path, $lang){
        $_SESSION['lang'] = $lang;
        if(isset($_POST['lang'])) return true;
        header('Location: ' . '/' . $path . '/');
    }
   
}