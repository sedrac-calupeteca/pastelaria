<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cliente_id',
        'file',
        'total',
        'created_by',
        'updated_by'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class);
    }

}
