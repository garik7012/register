<?php


class IndexController
{
//отображение стартовой страницы. По заданию она нам не нужна, делаем редирект на регистрацию
    public function index()
    {
        header('Location: /user/register/');
    }

    /**
     *  action для переключения языка.
     * @param $path - путь $path(/rus|eng) если js не работает
     * @param $lang - язык на который переключаем
     * @return
     */
    public function setLanguage($path, $lang){
        $_SESSION['lang'] = $lang;
        if(isset($_POST['lang'])) return true; // если пришло по ajax то дальше в js
        header('Location: ' . '/' . $path . '/'); //если без js
    }

    /**
     * получаем массив с текстом ошибок для использования в проверках js
     * для языка $_POST['lang']
     * @return bool
     */
    public function getErrors(){
        $lang = $_POST['lang'];
        $errorsText = [];
        $errors = Lang::getAllGroupFields('errors');
        foreach ($errors as $error => $value){
            $errorsText[$error] = $value[$lang];
        }
        echo json_encode($errorsText);
        return true;
    }
   
}