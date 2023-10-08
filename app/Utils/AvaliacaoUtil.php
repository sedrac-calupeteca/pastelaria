<?php

namespace App\Utils;

class AvaliacaoUtil{

    public static function tiposAvaliacao(){
        return ['RECLAMACAO' => 'Reclamação','SUGESTAO' => 'Sugestão','SATISFACAO' => 'Satisfação'];
    }

    public static function keysTiposAvaliacao(){
        return array_keys(AvaliacaoUtil::tiposAvaliacao());
    }

}
