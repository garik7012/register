<?php


class UserController
{
    public function register()
    {
        //Создаем массив, в который будем складывать ошибки
        $errors = [];
        if (isset($_POST['register'])) {
          //Проверяем имя; здесь и далее $errors - передаем ссылку на наш массив с ошибками
          // второе значение - это пременная в которую запишется значение для БД
            $this->checkName($errors, $name);
          //Проверяем email адрес на корректность
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Пожалуйста, введите корректный email адрес";
            }else{
                $email = $_POST['email'];
              //проверка на наличие пользователя с таким email
                if (User::checkEmailExists($email)){
                    $errors['email'] = "Пользователь с таким адресом уже есть";
                }
            }
          //проверка пароля
            $this->checkPassword($errors, $password);
          //проверяем выбран ли пол
            $this->checkGender($errors, $gender);
          //проверка корректности ввода даты рождения
            $this->checkDate($errors, $b_date);
          //если ошибок не было - регистрируем
            if ($errors == false) {
               User::register($name, $email, $password, $gender, $b_date) ? header('Location: /user/cabinet'): exit('Ошибка регистрации');
            }
            require_once(ROOT . '/views/index.php');
            return true;
        }
        require_once(ROOT . '/views/index.php');
        return true;
    }

    public function showCabinet(){       
      // Получаем идентификатор пользователя из сессии
         $userId = User::checkLogged();
      // Получаем информацию о пользователе из БД
         $user = User::getUserById($userId);

      //Создаем массив, в который будем складывать ошибки
        $errors = [];
        if (isset($_POST['updateInfo'])) {
            //Проверяем имя
            $this->checkName($errors, $name);
            //проверяем выбран ли пол
            $this->checkGender($errors, $gender);
            //проверка корректности ввода даты рождения
            $this->checkDate($errors, $b_date);
            $lastName = '';
            if(isset($_POST['lastName'])){
                $this->checkLastName($errors, $lastName);
            }
            $city = '';
            if(isset($_POST['city'])){
                $this->checkCity($errors, $city);
            }
            $description = '';
            if(isset($_POST['description'])){
                $this->checkDescription($errors, $description);
            }
            $phoneNumber = '';
            if(isset($_POST['phoneNumber'])){
                $this->checkPhoneNumber($errors, $phoneNumber);
            }
            $avatar = '';
            if(is_file($_FILES['avatar']['tmp_name'])){
                $this->checkAndSaveAvatar($errors, $avatar);
            }
            if ($errors == false) {
                User::edit($userId, $name, $lastName, $phoneNumber, $gender, $b_date, $description, $avatar) ? header('Location: /user/cabinet'): exit('Ошибка регистрации');
            }

            require_once(ROOT . '/views/user/cabinet.php');
            return true;
        }
            require_once(ROOT . '/views/user/cabinet.php');
            return true;
        }



    private function checkGender(&$errors, &$gender){
        isset($_POST['gender']) ? $gender = $_POST['gender'] : $errors['gender'] = 'укажите ваш пол';
        (isset($gender) and $gender == 'Male') ? $gender = 1 : $gender = 0;
    }

    private function checkName(&$errors, &$name){
        if (empty($_POST['name'])) {
            $errors['name'] = "Пожалуйста, введите ваше имя";
        } else if(strlen($_POST['name']) < 2) {
            $errors['name'] = "Имя должно состоять хотя бы из двух символов";
        } else if(strlen($_POST['name']) > 31) {
            $errors['name'] = "Имя не должно быть длинее 30 символов";
        }else if (preg_match("/[^\w\x7F-\xFF\s-]|_|\d/",$_POST['name'])) {
            $errors['name'] = 'только буквы русского или латинского алфавита,</br> знак "-" (дефис), пробел';
        } else $name = strip_tags($_POST['name']);
    }

    private function checkPassword(&$errors, &$password){
        $password = trim($_POST['password']);
        $conf_password = trim($_POST['conf_password']);
        if (strlen($password) < 6) {
            $errors['password'] = 'пароль должен быть длинее 6 символов';
        } else if (strlen($password) > 30) {
            $errors['password'] = 'пароль должен быть короче 30 символов';
        }    //проверка подтверждения пароля
        ($password === $conf_password) ? $password = md5(md5($password)) : $errors['password-confirm'] = "пароли не совпадают";
    }

    private function checkDate(&$errors, &$b_date){
        $b_day = $_POST['b_day']; $b_month = $_POST['b_month']; $b_year = $_POST['b_year'];
        //создаем дату, день и месяц без нулей впереди и полный год и сравниваем с тем, что у нас
        if (date("jnY", mktime(0, 0, 0, $b_month, $b_day, $b_year)) !== $b_day . $b_month . $b_year) {
            $errors['brthd'] = 'Пожалуйста, выберите дату рождения';
        } else { //создаем дату для записи в бд
            $b_date = date("Y-m-d", mktime(0, 0, 0, $b_month, $b_day, $b_year));
        }
    }

    private function checkLastName(&$errors, &$lastName){
        if(strlen($_POST['lastName']) > 31) {
            $errors['lastName'] = "Фамилия не должна быть длинее 30 символов";
        }else if (preg_match("/[^\w\x7F-\xFF\s-]|_|\d/",$_POST['lastName'])) {
            $errors['lastName'] = 'только буквы русского или латинского алфавита,</br> знак "-" (дефис), пробел';
        } else $lastName = $_POST['lastName'];
    }

    private function checkPhoneNumber(&$errors, &$phoneNumber){
       if(preg_match('/^([+]?[0-9\s-\(\)]{5,25})*$/', $_POST['phoneNumber'])){
           $phoneNumber = $_POST['phoneNumber'];
       } else $errors['phoneNumber'] = 'Пожалуйста, введите корректный номер';
    }

    private function checkDescription(&$errors, &$description){
        if(strlen($_POST['description']) > 5000) {
            $errors['description'] = "не более 5000 символов";
        }else  $description = strip_tags($_POST['description']);
    }

    private function checkCity(&$errors, &$city){
        if(strlen($_POST['city']) > 51) {
            $errors['city'] = "Не более 50 символов";
        }else if (preg_match("/[^\w\x7F-\xFF\s-]|_|\d/",$_POST['city'])) {
            $errors['city'] = 'только буквы русского или латинского алфавита,</br> знак "-" (дефис), пробел';
        } else $city = $_POST['city'];
    }

    private function checkAndSaveAvatar(&$errors, &$avatar){
        // Пути загрузки файлов
     $path = '/template/users/avatars/';

        // Массив допустимых значений типа файла
     $types = array('image/gif', 'image/png', 'image/jpeg');
        // Максимальный размер файла
     $size = 2097000;
 // Обработка запроса
        // Проверяем тип файла
      if (!in_array($_FILES['avatar']['type'], $types)) {
        $errors['avatar'] = 'Запрещённый тип файла. Только изображения gif, jpg, png';
        return;
      }
        //Проверяем размер файла
      if ($_FILES['avatar']['size'] > $size){
        $errors['avatar'] = 'Слишком большой размер файла. Не более ' .round($size/1024/1024, 1) . ' MB';
        return;
      }
        if($_FILES['avatar']['error'] == 0){ // проверка на загрузку файла
            $fileName = $_FILES["avatar"]["name"];
            //получаем расширение файла
            $file_ext =  substr(strrchr($fileName, '.'), 1);
            //создаем уникальное имя файла. предполагаем, что загрузка файлов будет происходить не чаще раза в секунду
            $fileName = time() . "." . $file_ext;
            $target = ROOT . $path . $fileName; // путь для загрузки файла
            //если ошибок не было то пермещаем файл и сразу проверяем удачно ли
            if($errors == false and move_uploaded_file($_FILES['avatar']['tmp_name'], $target)){
                $avatar = $path . $fileName;               
                @unlink($_FILES['avatar']['tmp_name']); // удаляем временный файл
            }
        }else{
            $errors['avatar'] = 'Ошибка при загрузке файла';
        }

    }

}