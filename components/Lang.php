<?php

/**
 *
 */
class Lang
{


    public static function _($group, $field)
    {
        $languagesPath = ROOT . '/config/languages/langRuEn.php';
        include($languagesPath);
        if($_SESSION['lang'] == 'eng'){$switchLang = 1;} else $switchLang = 0;
        if(key_exists($group, $languages)){
            return($languages[$group][$field][$switchLang]);
        }    
        
    }
}