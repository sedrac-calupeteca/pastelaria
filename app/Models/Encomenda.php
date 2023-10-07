<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tipo_encomenda',
        'tempo_entrega',
        'local_entrega',
        'foi_comprado',
        'file',
        'cliente_id',
        'created_by',
        'updated_by'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class,"produto_encomenda");
    }

}
