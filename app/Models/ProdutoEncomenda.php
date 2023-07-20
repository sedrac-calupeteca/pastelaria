<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoEncomenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'quantidade_produto',
        'produto_id',
        'encomenda_id',
        'created_by',
        'updated_by'
    ];

    protected $table = "produto_encomenda";


}
