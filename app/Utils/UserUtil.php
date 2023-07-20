<?php

namespace App\Utils;

class UserUtil{

    public static function genders(){
        return ['MASCULINO' => 'Masculino','FEMENINO' => 'Femenino'];
    }

    public static function keysGenders(){
        return array_keys(UserUtil::genders());
    }

}
