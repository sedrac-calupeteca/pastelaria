<?php

namespace App\Utils;

class EncomendaUtil{

    public static function tiposEncomendas(){
        return ['NORMAL' => 'Normal','URGUENTE' => 'Urguente','ATRASADA' => 'Atrasada'];
    }

    public static function keysTiposEncomendas(){
        return array_keys(EncomendaUtil::tiposEncomendas());
    }

}
