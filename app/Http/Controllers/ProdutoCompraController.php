<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdutoCompra;

class ProdutoCompraController extends Controller
{
    public function json_produto($id){
        return ProdutoCompra::with('produto')->where('compra_id',$id)->get();
    }
}
