<?php

namespace App\Utils;

use App\Utils\FuncionarioUtil as UtilsFuncionarioUtil;

class FuncionarioUtil{

    public static function categorias(){
        return ['NORMAL' => 'Normal','MEDIO' => 'Médio','VIP' => 'Vip'];
    }

    public static function keysCategorias(){
        return array_keys(UtilsFuncionarioUtil::categorias());
    }

}
