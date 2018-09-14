<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SituacaoMensal extends Model
{
    protected $fillable = [
        'data', 'saldo_inicial_previsto', 'saldo_final_previsto', 'saldo_inicial_real', 'saldo_final_real', 'cpf_user'
    ];
}
