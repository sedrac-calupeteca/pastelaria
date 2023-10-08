<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'encomenda_id',
        'descricao',
        'assunto',
        'tipo',
        'created_by',
        'updated_by'
    ];

    public function encomenda(){
        return $this->belongsTo(Encomenda::class);
    }

}
