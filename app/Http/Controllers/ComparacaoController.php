<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class ComparacaoController extends Controller
{
    public function relatorio(){
        $naoExiste = true;
        $previsaoRealizacoes = DB::table('contas')
            ->join('previsoes', 'previsoes.id_conta', '=', 'contas.id')
            ->join('realizacoes', 'realizacoes.id_conta', '=', 'contas.id')
            ->where('contas.cpf_user', \Auth::user()->cpf)->get();
            
        if($previsaoRealizacoes != null){
            $naoExiste = false;
        }
            
        return view('pages.relatorio.comparativo', ['naoExiste' => $naoExiste, 'previsaoRealizacoes' => $previsaoRealizacoes]);
    }
}
