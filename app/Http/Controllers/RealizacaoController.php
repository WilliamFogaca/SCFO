<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Realizacao;

use App\Conta;

use DB;

class RealizacaoController extends Controller
{
    public function index() {
        $existe = false;
        $contas = DB::table('contas')->where('cpf_user', \Auth::user()->cpf)->whereNotIn('codigo', [999])->orderBy('codigo', 'asc')->get();
        $ContaRealizacoes = DB::table('contas')
        ->join('realizacoes', function ($join) {
            $join->on('realizacoes.id_conta', '=', 'contas.id')
                 ->where('contas.cpf_user', '=', \Auth::user()->cpf);
        })
        ->orderBy('codigo', 'asc')->get();
        
        return view('pages.cadastro.realizacao', ['contas' => $contas, 'existe' => $existe, 'contaRealizacoes' => $ContaRealizacoes]);
    }
    
    public function relatorio() {
        $naoExiste = true;
        $saldo = 0;
        $ContaRealizacoes = DB::table('contas')
        ->join('realizacoes', function ($join) {
            $join->on('realizacoes.id_conta', '=', 'contas.id')
                 ->where('contas.cpf_user', '=', \Auth::user()->cpf);
        })
        ->orderBy('codigo', 'asc')->get();
        if($ContaRealizacoes != null){
            $naoExiste = false;
            $mesAtual = date('Y-m');
            $SaldoInicialReal = DB::table('situacao_mensals')
                ->where('cpf_user', \Auth::user()->cpf)
                ->WhereRaw("data::VARCHAR LIKE '%$mesAtual%'")
                ->pluck('saldo_inicial_real');
            $saldo = $SaldoInicialReal[0];
        }
        
        return view('pages.relatorio.realizacao', ['naoExiste' => $naoExiste, 'contaRealizacoes' => $ContaRealizacoes, 'saldo' => $saldo]);
    }
    
    public function save(Request $request) {
        $id = $request->id;
        $dados = explode(" ", $request->codigoConta);
        $codigo = $dados[0];
        $data = $request->dataReal;
        $valor = $request->valorReal;
        $idConta = DB::table('contas')->select('id')
        ->where([
            ['codigo', $codigo], 
            ['cpf_user', \Auth::user()->cpf],
            ])
        ->first()->id;
        
        $dadosForm = $request->all();
        $messages = [
            'required' => 'O campo a cima é obrigatório. Preencha-o.',
        ];
        $validacao = validator($dadosForm, [
            'dataReal' => 'required',
            'valorReal' => 'required',
        ], $messages);
        if($validacao->fails()){
            return redirect('/cadastro/realizacao')->withErrors($validacao)->withInput();
        }
        
        if ($id == null) {
            $RealizacaoExiste = DB::table('contas')
            ->join('realizacoes', function ($join) {
                $join->on('realizacoes.id_conta', '=', 'contas.id')
                     ->where('contas.cpf_user', '=', \Auth::user()->cpf);
            })->where('codigo', $codigo)->get();
            
            if($RealizacaoExiste == null){
                $realizacao = Realizacao::create([
                    'data_real' => $data,
                    'valor_real' => $valor,
                    'id_conta' => $idConta,
                ]);
                
                if($codigo == 1){
                    $situacaoMensal = DB::table('situacao_mensals')->where('cpf_user', \Auth::user()->cpf)
                    ->update(['saldo_inicial_real' => $valor]);
                }
            }else{
                $existe = true;
                $contas = DB::table('contas')->where('cpf_user', \Auth::user()->cpf)->whereNotIn('codigo', [999])->orderBy('codigo', 'asc')->get();
                return view('pages.cadastro.realizacao', ['contas' => $contas],['existe' => $existe]);
            }
            
        }else{
            $realizacao = Realizacao::findOrFail($id);
            $realizacao->data = $data;
            $realizacao->valor = $valor;
            $realizacao->idConta = $idConta;
        }

        $realizacao->save();
        return redirect()->route('cadastro.realizacao');
    }
    
    public function remove($id) {
        
        $realizacao = DB::table('contas')
            ->join('realizacoes', function ($join) {
                $join->on('realizacoes.id_conta', '=', 'contas.id')
                     ->where('contas.cpf_user', '=', \Auth::user()->cpf);
            })->where('realizacoes.id', $id)->pluck('codigo');
        $codigo = $realizacao[0];
        
        if($codigo == 1){
            $situacaoMensal = DB::table('situacao_mensals')->where('cpf_user', \Auth::user()->cpf)
            ->update(['saldo_inicial_real' => null]);
        }
        
        $realizacao = DB::table('realizacoes')->where('id', $id);
        if($realizacao->delete()){
                return redirect()->route('cadastro.realizacao');
        }
    }
    
    public function findOne(Request $request) {
        $id = $request->id;
        return Realizacao::findOrFail($id);
    }
    
    public function findAll() {
        return Realizacao::all();
    }
}
