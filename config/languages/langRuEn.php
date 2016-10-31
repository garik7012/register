<?php

$languages = array(
    'buttons' =>[
        'logout' => ['Выход', 'Logout'],
  ],
    'fields' =>[
      'name' =>['Имя:', 'Name:'],
      'lastName' =>['Фамилия:','lastName:'],
      'brthd' =>['Дата рождения:', 'Birthday:'],
        'city' => ['Откуда вы:', 'Where are you from:'],
        'phoneNumber' => ['Телефон:', 'Phone:'],
        'gender' => ['Пол:', 'Sex:'],
        'description' => ['Обо мне:', 'About myself:'],
        'avatar' => ['Фото:', 'Photo:'],

    ],
    'placeholders' =>[
        'name' =>['Введите имя', 'Enter your first name'],
        'lastName' =>['Введите фамилию', 'Enter your last name'],
        'city' => ['Город в котором вы проживаете', 'What city do you live'],
        'phoneNumber' => ['Введите номер телефона', 'Enter your phone number'],
        'description' => ['расскажите коротко о себе', 'please, tell about yourself'],
        'avatar' => ['Добавьте ваше фото.', 'Please, add your photo'],
        'avatar_help' => ['Только изображения, не более ', 'Images only, size less than '],
    ],
    'errors' => [
        'name' => ["Пожалуйста, введите ваше имя", 'Please, enter your name'],
        'name_min' => ["Имя должно состоять хотя бы из двух символов", 'Two symbols at least'],
        'name_max' => ["Имя не должно быть длинее 30 символов", 'Not long that 30 symbols'],
        'name_reg' => ['только буквы русского или латинского алфавита,</br> знак "-" (дефис), пробел', 'only letters, symbol "-", space'],
        'gender' => ['укажите ваш пол', 'please, check your sex'],
        'email_ex' => ["Пользователь с таким адресом уже есть", 'User with this e-mail already exist'],
        'email_reg' => ["Пожалуйста, введите корректный email адрес", 'Please, enter correct e-mail'],
        'pwd_max' => ['пароль должен быть короче 30 символов', 'password is very long, please enter less than 30 symbols'],
        'pwd_min' => ['пароль должен быть длинее 6 символов', 'password is too short, try more 6 symbols'],
        'pwd-conf' => ["пароли не совпадают", "The passwords don't match"],
        'brthd' => ['Пожалуйста, выберите дату рождения', 'Please, check your birthday'],
        'lastName_max' => ["Фамилия не должна быть длинее 30 символов", 'Not long that 30 symbols'],
        'phoneNumber_reg' => ['Пожалуйста, введите корректный номер', 'This phone number is not supported'],
        'description_max' => ["не более 5000 символов", 'Not long that 30 symbols'],
        'city_max' => ["Не более 50 символов", 'Not long that 30 symbols'],
        'avatar_type' => ['Запрещённый тип файла. Только изображения gif, jpg, png', 'Incorrect image file. gif, jpg, png only'],
        'avatar_max' => ['Слишком большой размер файла. Не более ', 'This file is too big. Not more '],
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
        'submit2' => ['Сохранить изменения', 'Save changes'],
        'cancel' => ['Не сохранять', 'Reset'],


    ],
    'text' =>[
        'title_start' => ['Приветствуем Вас, ', 'Hi '],
        'title_end' => [', дополните информацию о себе', '! Please, add information about yourself'],
    ],
    'titles' => [
        'title' => ['регистрация', 'registration'],
    ]

);