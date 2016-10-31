<?php

return array(

    //путь => контроллер@action
    '([\w/]+)/(rus|eng)' => 'IndexController@setLanguage@$1@$2',
    'user/register' => 'UserController@register',
    'user/cabinet' => 'UserController@showCabinet',
    'user/logout' => 'UserController@logout',
    'user' => 'UserController@index',
    '' => 'IndexController@index',
);