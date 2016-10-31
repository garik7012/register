<?php


class UserController
{
    public function index(){
        header('Location: /user/cabinet/');
        return true;
    }

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
                $errors['email'] = Lang::_('errors', 'email_reg');
            }else{
                $email = $_POST['email'];
              //проверка на наличие пользователя с таким email
                if (User::checkEmailExists($email)){
                    $errors['email'] = Lang::_('errors', 'email_ex');
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
               User::register($name, $email, $password, $gender, $b_date) ? header('Location: /user/cabinet/'): exit(Lang::_('errors', 'register_err'));
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
         global $user;
        $user = User::getUserById($userId);
        global $config;

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
            isset($user['avatar']) ? $avatar = $user['avatar'] : $avatar = '';
            $maxSize = $config['max_size'];
            if(is_file($_FILES['avatar']['tmp_name'])){
                $this->checkAndSaveAvatar($errors, $avatar, $maxSize);
            } 
            if(isset($_POST['deleteAvatar'])) {
                unlink(ROOT . $user['avatar']);
                $avatar = '';
            }

            //если ошибок нет - обновляем данные пользователя
            if ($errors == false) {
                $userId = $user['id'];
                User::edit($userId, $name, $lastName, $phoneNumber, $gender, $b_date, $description, $avatar, $city) ? header('Location: /user/cabinet/'): exit('Ошибка регистрации');
            }

            require_once(ROOT . '/views/user/cabinet.php');
            return true;
        }
            require_once(ROOT . '/views/user/cabinet.php');
            return true;
        }



    private function checkGender(&$errors, &$gender){
        isset($_POST['gender']) ? $gender = $_POST['gender'] : $errors['gender'] = Lang::_('errors', 'gender');
        (isset($gender) and $gender == 'Male') ? $gender = 1 : $gender = 0;
    }

    private function checkName(&$errors, &$name){
        if (empty($_POST['name'])) {
            $errors['name'] = Lang::_('errors', 'name');
        } else if(strlen($_POST['name']) < 2) {
            $errors['name'] = Lang::_('errors', 'name_min');
        } else if(strlen($_POST['name']) > 31) {
            $errors['name'] = Lang::_('errors', 'name_max');
        }else if (preg_match("/[^\w\x7F-\xFF\s-]|_|\d/",$_POST['name'])) {
            $errors['name'] = Lang::_('errors', 'name_reg');
        } else $name = strip_tags($_POST['name']);
    }

    private function checkPassword(&$errors, &$password){
        
        $password = trim($_POST['password']);
        $conf_password = trim($_POST['conf_password']);
        if (strlen($password) < 6) {
            $errors['password'] = Lang::_('errors', 'pwd_min');
        } else if (strlen($password) > 30) {
            $errors['password'] = Lang::_('errors', 'pwd_max');
        }    //проверка подтверждения пароля
        ($password === $conf_password) ? $password = md5(md5($password)) : $errors['password-confirm'] = Lang::_('errors', 'pwd-conf');
    }

    private function checkDate(&$errors, &$b_date){
        $b_day = $_POST['b_day']; $b_month = $_POST['b_month']; $b_year = $_POST['b_year'];
        //создаем дату, день и месяц без нулей впереди и полный год и сравниваем с тем, что у нас
        if (date("jnY", mktime(0, 0, 0, $b_month, $b_day, $b_year)) !== $b_day . $b_month . $b_year) {
            $errors['brthd'] = Lang::_('errors', 'brthd');
        } else { //создаем дату для записи в бд
            $b_date = date("Y-m-d", mktime(0, 0, 0, $b_month, $b_day, $b_year));
        }
    }

    private function checkLastName(&$errors, &$lastName){
        if(strlen($_POST['lastName']) > 31) {
            $errors['lastName'] = Lang::_('errors', 'lastName_max');
        }else if (preg_match("/[^\w\x7F-\xFF\s-]|_|\d/",$_POST['lastName'])) {
            $errors['lastName'] = Lang::_('errors', 'name_reg');
        } else $lastName = $_POST['lastName'];
    }

    private function checkPhoneNumber(&$errors, &$phoneNumber){
       if(preg_match('/^([+]?[0-9\s-\(\)]{5,25})*$/', $_POST['phoneNumber'])){
           $phoneNumber = $_POST['phoneNumber'];
       } else $errors['phoneNumber'] = Lang::_('errors', 'phoneNumber_reg');
    }

    private function checkDescription(&$errors, &$description){
        if(strlen($_POST['description']) > 5000) {
            $errors['description'] = Lang::_('errors', 'description_max');
        }else  $description = strip_tags($_POST['description']);
    }

    private function checkCity(&$errors, &$city){
        if(strlen($_POST['city']) > 51) {
            $errors['city'] = Lang::_('errors', 'city_max');
        }else if (preg_match("/[^\w\x7F-\xFF\s-]|_|\d/",$_POST['city'])) {
            $errors['city'] = Lang::_('errors', 'name_reg');
        } else $city = $_POST['city'];
    }

    private function checkAndSaveAvatar(&$errors, &$avatar, $maxSize){
        // Пути загрузки файлов
     $path = '/template/users/avatars/';
        // Массив допустимых значений типа файла
     $types = array('image/gif', 'image/png', 'image/jpeg');
        // Максимальный размер файла
     $size = $maxSize;
 // Обработка запроса
        // Проверяем тип файла
      if (!in_array($_FILES['avatar']['type'], $types)) {
        $errors['avatar'] = Lang::_('errors', 'avatar_type');
        return;
      }
        //Проверяем размер файла
      if ($_FILES['avatar']['size'] > $size){
        $errors['avatar'] = Lang::_('errors', 'avatar_max') .round($size/1024/1024, 1) . ' MB';
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
                unlink(ROOT . $avatar);
                $avatar = $path . $fileName;               
                @unlink($_FILES['avatar']['tmp_name']); // удаляем временный файл
                
            }
        }else{
            $errors['avatar'] = Lang::_('errors', 'avatar_err');
        }

    }
}