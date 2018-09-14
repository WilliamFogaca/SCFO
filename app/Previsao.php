<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Previsao extends Model
{
    protected $table = 'previsoes';
    
    protected $fillable = [
        'data_prevista', 'valor_previsto', 'id_conta', 
    ];
}
