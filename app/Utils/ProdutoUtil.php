<?php

namespace App\Utils;


class ProdutoUtil{

    public static function categorias(){
        return ['NORMAL' => 'Normal', 'PROMOCIONAL' => 'Promoção','DESCONTO' => 'Desconto','AMOSTRA' => 'Amostra'];
    }

    public static function keysCategorias(){
        return array_keys(ProdutoUtil::categorias());
    }

}
