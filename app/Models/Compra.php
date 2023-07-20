<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'quantidade_compra',
        'valor_compra',
        'cliente_id',
        'produto_id',
        'troco',
        'file',
        'created_by',
        'updated_by'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

}
