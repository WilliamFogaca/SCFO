<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realizacao extends Model
{
    protected $table = 'realizacoes';
    
    protected $fillable = [
        'data_real', 'valor_real', 'id_conta', 
    ];
}
