<?php

/**
 * Created by PhpStorm.
 * User: Таня
 * Date: 20.10.2016
 * Time: 19:18
 */
class User
{
    /**
     * регистрация пользователя
     * @param $name
     * @param $email
     * @param $password
     * @param $gender
     * @param $b_date
     * @return bool
     */
    public static function register($name, $email, $password,  $gender, $b_date)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO users (name, email, password, gender, b_date) '
            . 'VALUES (:name, :email, :password, :gender, :b_date)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':gender', $gender, PDO::PARAM_STR);
        $result->bindParam(':b_date', $b_date, PDO::PARAM_STR);
        if($result->execute()){
            $_SESSION['user'] = $db->lastInsertId();
            return true;
        }
    }

    /**
     * редактирование/дополнение данных пользователя
     * @param $id - идентификатор
     * @param $name - имя
     * @param $lastName - фамилия
     * @param $phoneNumber - номер телефона
     * @param $gender - пол
     * @param $b_date - дата рождения
     * @param $description - как пользователь описывает себя
     * @param $avatar - веб ссылка на аватар пользователя
     * @param $city - город
     * @return bool
     */
    public static function edit($id, $name, $lastName, $phoneNumber, $gender, $b_date, $description, $avatar, $city)
    {
        $db = Db::getConnection();

        $sql = "UPDATE users 
            SET name = :name, lastName = :lastName, phoneNumber = :phoneNumber, gender = :gender, b_date = :b_date, description = :description, avatar = :avatar, city = :city 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $result->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $result->bindParam(':gender', $gender, PDO::PARAM_STR);
        $result->bindParam(':b_date', $b_date, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $result->bindParam(':city', $city, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email
     * @param string $password
     * @return mixed : ingeger user id or false
     */
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }
        return false;
    }

    /**
     * Запоминаем пользователя
     * @param string $email
     * @param string $password
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Returns user by id
     * @param integer $id
     */
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM users WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            return $result->fetch();
        }
    }

}