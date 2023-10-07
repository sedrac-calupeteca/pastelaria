<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'produto_id',
        'compra_id',
        'qtd',
        'preco',
        'total',
        'created_by',
        'updated_by'
    ];

    protected $table = "compra_produto";

    public function produto(){
        return $this->belongsTo(Produto::class,'produto_id','id');
    }

}
