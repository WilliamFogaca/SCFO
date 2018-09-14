<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SituacaoMensal;
use DB;

class SituacaoMensalController extends Controller
{
    public function relatorio() {
        
        $SaldoInicialReal = DB::table('situacao_mensals')
        ->where('cpf_user', \Auth::user()->cpf)
        ->pluck('saldo_inicial_real');
        foreach($SaldoInicialReal as $saldo){
            $saldo = $saldo;
        }
        
        $receitas = DB::table('contas')
        ->join('realizacoes', function ($join) {
            $join->on('realizacoes.id_conta', '=', 'contas.id')
                 ->where('contas.cpf_user', '=', \Auth::user()->cpf);
        })->where('contas.tipo', 1)->whereNotIn('contas.codigo', [1,999])->pluck('valor_real');
        
        foreach($receitas as $receita){
            $saldo = $saldo + $receita;
        }
        
        $despesas = DB::table('contas')
        ->join('realizacoes', function ($join) {
            $join->on('realizacoes.id_conta', '=', 'contas.id')
                 ->where('contas.cpf_user', '=', \Auth::user()->cpf);
        })->where('contas.tipo', 2)->whereNotIn('contas.codigo', [1,999])->pluck('valor_real');
        
        foreach($despesas as $despesa){
            $saldo = $saldo - $despesa;
        }
        
        $situacaoMensal = DB::table('situacao_mensals')->where('cpf_user', \Auth::user()->cpf)
                ->update(['saldo_final_real' => $saldo]);
        
        
        $SituacaoMensals = DB::table('situacao_mensals')
        ->where('cpf_user', \Auth::user()->cpf)
        ->get();
        
        $SituacaoMensals = DB::table('situacao_mensals')
        ->where('cpf_user', \Auth::user()->cpf)
        ->get();
        
        return view('pages.relatorio.saldo', ['situacaoMensals' => $SituacaoMensals]);
    }
}
