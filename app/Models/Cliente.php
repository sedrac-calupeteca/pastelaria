<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'frequencia_compra',
        'user_id',
        'created_by',
        'updated_by'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function compras(){
        return $this->hasMany(Compra::class);
    }

    public function encomendas(){
        return $this->hasMany(Encomenda::class);
    }


}
