<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $fillable = [
        'codigo', 'titulo', 'tipo', 'descricao', 'cpf_user', 
    ];
}
