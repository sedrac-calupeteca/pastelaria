<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'categoria',
        'nome',
        'descricao',
        'image',
        'preco',
        'quantidade_stock',
        'created_by',
        'updated_by'
    ];

    public function compras(){
        return $this->hasMany(Compra::class);
    }

    public function encomendas(){
        return $this->belongsToMany(Encomenda::class);
    }

}
