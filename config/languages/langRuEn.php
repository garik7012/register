<?php

$languages = array(
    'buttons' =>[
        'logout' => ['Выход', 'Logout'],
        'login' => ['Войти', 'Log In'],
        'submit1' => ['Зарегистрироваться', 'Sign Up'],
        'submit2' => ['Сохранить изменения', 'Save changes'],
        'submit3' => ['Войти', 'Log In'],
        'cancel' => ['Не сохранять', 'Reset'],
        'register' => ['Регистрация', 'Sign Up'],

    ],
    'fields' =>[
        'name' =>['Имя:', 'First name:'],
        'email' => ['Ваш e-mail:', 'Your e-mail:'],
        'pwd' => ['Пароль:', 'Password:'],
        'pwd-conf' => ['Повторите пароль:', 'Confirm password:'],
        'lastName' =>['Фамилия:','Last name:'],
        'brthd' =>['Дата рождения:', 'Birthday:'],
        'city' => ['Откуда вы:', 'Where you are from:'],
        'phoneNumber' => ['Телефон:', 'Phone:'],
        'gender' => ['Пол:', 'Sex:'],
        'description' => ['Обо мне:', 'About myself:'],
        'avatar' => ['Фото:', 'Photo:'],

    ],
    'placeholders' =>[
        'name' =>['Введите имя', 'Enter your first name'],
        'email' =>['Ваш e-mail', 'Your e-mail'],
        'pwd' =>['Придумайте пароль', 'Enter password'],
        'pwd-conf' =>['Введите пароль еще раз', 'Confirm your password'],
        'password' =>['Ваш пароль', 'Your password'],
        'lastName' =>['Введите фамилию', 'Enter your last name'],
        'city' => ['Город, в котором вы проживаете', 'Your city'],
        'phoneNumber' => ['Введите номер телефона', 'Enter your phone number'],
        'description' => ['Расскажите коротко о себе', 'Please, tell about yourself'],
        'avatar' => ['Добавьте ваше фото.', 'Please, add your photo'],
        'avatar_help' => ['Только изображения, не более ', 'Images only, size less than '],
    ],
    'errors' => [
        'name' => ["Пожалуйста, введите ваше имя", 'Please, enter your name'],
        'name_min' => ["Имя должно состоять хотя бы из двух символов", 'Two symbols at least'],
        'name_max' => ["Имя не должно быть длинее 30 символов", 'Not longer than 30 symbols'],
        'name_reg' => ['только буквы русского или латинского алфавита,</br> знак "-" (дефис), пробел', 'only letters, symbol "-", space'],
        'gender' => ['укажите ваш пол', 'please, choose your sex'],
        'email' => ["Пожалуйста, введите ваш e-mail", 'Please, enter your e-mail'],
        'email_ex' => ["Пользователь с таким адресом уже есть", 'User with this e-mail already exists'],
        'email_reg' => ["Пожалуйста, введите корректный email адрес", 'Please, enter correct e-mail'],
        'pwd' => ['Введите ваш пароль', 'please enter your password'],
        'pwd_max' => ['пароль должен быть короче 30 символов', 'Use no more than 30 symbols'],
        'pwd_min' => ['пароль должен быть длинее 6 символов', 'Use at least 6 characters'],
        'pwd-conf' => ["пароли не совпадают", "The passwords don't match"],
        'brthd' => ['Пожалуйста, выберите дату рождения', 'Please, select your birthday'],
        'lastName_max' => ["Фамилия не должна быть длинее 30 символов", 'Not longer than 30 symbols'],
        'phoneNumber_reg' => ['Пожалуйста, введите корректный номер', 'Please enter a valid phone number'],
        'description_max' => ["не более 5000 символов", 'Not longer than 5000 symbols'],
        'city_max' => ["Не более 50 символов", 'Not longer than 50 symbols'],
        'avatar_type' => ['Запрещённый тип файла. Только изображения gif, jpg, png', 'Invalid image type. gif, jpg, png only'],
        'avatar_max' => ['Слишком большой размер файла. Не более ', 'This file is too big. Not more than '],
        'avatar_err' => ['Ошибка при загрузке файла', 'We have a problem with file upload'],
        'register_err' => ['Ошибка регистрации', 'Registration error'],
    ],
    'inputs' =>[
        'b_day' => ['День', 'Day'],
        'b_month' => ['Месяц', 'Month'],
        'b_year' => ['Год', 'Year'],
        'months' => [['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'],
                     ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']],
        'gender_m' => ['Мужчина', 'Male'],
        'gender_f' => ['Женщина', 'Female'],
        'deleteAvatar' => ['удалить фото', 'delete photo'],
        

    ],
    'text' =>[
        'title_start' => ['Приветствуем Вас, ', 'Hi '],
        'title_end' => [', дополните информацию о себе', '! Please, add information about yourself'],
    ],
    'titles' => [
        'title' => ['регистрация', 'registration'],
        'panel-title' => ['Регистрация нового пользователя', 'Sign up'],
        'panel-title-login' => ['Вход зарегистрированного пользователя', 'Log In'],
    ]

);