<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Previsao;
use App\Conta;
use App\SituacaoMensal;
use DB;

class PrevisaoController extends Controller
{
    public function index() {
        $existe = false;
        $contas = DB::table('contas')->where('cpf_user', \Auth::user()->cpf)->orderBy('codigo', 'asc')->get();
        $ContaPrevisoes = DB::table('contas')
        ->join('previsoes', function ($join) {
            $join->on('previsoes.id_conta', '=', 'contas.id')
                 ->where('contas.cpf_user', '=', \Auth::user()->cpf);
        })
        ->orderBy('codigo', 'asc')->get();
        
        return view('pages.cadastro.previsao', ['contas' => $contas, 'existe' => $existe, 'contaPrevisoes' => $ContaPrevisoes]);
    }
    
    public function relatorio() {
        $naoExiste = true;
        $ContaPrevisoes = DB::table('contas')
        ->join('previsoes', function ($join) {
            $join->on('previsoes.id_conta', '=', 'contas.id')
                 ->where('contas.cpf_user', '=', \Auth::user()->cpf);
        })
        ->orderBy('codigo', 'asc')->get();
        
        if($ContaPrevisoes!=null){
            $naoExiste = false;
        }
        
        return view('pages.relatorio.previsao', ['naoExiste' => $naoExiste, 'contaPrevisoes' => $ContaPrevisoes]);
    }
    
    public function save(Request $request) {
        $id = $request->id;
        $dados = explode(" ", $request->codigoConta);
        $codigo = $dados[0];
        $data = $request->dataPrevista;
        $valor = $request->valorPrevisto;
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
            'dataPrevista' => 'required',
            'valorPrevisto' => 'required',
        ], $messages);
        if($validacao->fails()){
            return redirect('/cadastro/previsao')->withErrors($validacao)->withInput();
        }
        
        if ($id == null) {
            $PrevisaoExiste = DB::table('contas')
            ->join('previsoes', function ($join) {
                $join->on('previsoes.id_conta', '=', 'contas.id')
                     ->where('contas.cpf_user', '=', \Auth::user()->cpf);
            })->where('codigo', $codigo)->get();
            
            if($PrevisaoExiste == null){
                $previsao = Previsao::create([
                    'data_prevista' => $data,
                    'valor_previsto' => $valor,
                    'id_conta' => $idConta,
                ]);
                
                $CODIGO_INICIAL = 1;
                $CODIGO_FINAL = 999;
                if($codigo == $CODIGO_INICIAL){
                    $situacaoMensal = DB::table('situacao_mensals')->where('cpf_user', \Auth::user()->cpf)
                    ->update(['saldo_inicial_previsto' => $valor]);
                }else if($codigo == $CODIGO_FINAL){
                    $situacaoMensal = DB::table('situacao_mensals')->where('cpf_user', \Auth::user()->cpf)
                    ->update(['saldo_final_previsto' => $valor]);
                }
                
            }else{
                $existe = true;
                $contas = DB::table('contas')->where('cpf_user', \Auth::user()->cpf)->whereNotIn('codigo', [999])->orderBy('codigo', 'asc')->get();
                return view('pages.cadastro.previsao', ['contas' => $contas],['existe' => $existe]);
            }
            
        }else{
            $previsao = Previsao::findOrFail($id);
            $previsao->data = $data;
            $previsao->valor = $valor;
            $previsao->idConta = $idCOnta;
        }

        $previsao->save();
        return redirect()->route('cadastro.previsao');
    }
    
    public function remove($id) {
        $previsao = DB::table('contas')
            ->join('previsoes', function ($join) {
                $join->on('previsoes.id_conta', '=', 'contas.id')
                     ->where('contas.cpf_user', '=', \Auth::user()->cpf);
            })->where('previsoes.id', $id)->pluck('codigo');
        $codigo = $previsao[0];
        
        if($codigo == 1){
            $situacaoMensal = DB::table('situacao_mensals')->where('cpf_user', \Auth::user()->cpf)
            ->update(['saldo_inicial_previsto' => null]);
        }else if($codigo == 999){
            $situacaoMensal = DB::table('situacao_mensals')->where('cpf_user', \Auth::user()->cpf)
            ->update(['saldo_final_previsto' => null]);
        }
        
        
        $previsao = DB::table('previsoes')->where('id', $id);
        if($previsao->delete()){
                return redirect()->route('cadastro.previsao');
        }
    }
    
    public function findOne(Request $request) {
        $id = $request->id;
        return Previsao::findOrFail($id);
    }
    
    public function findAll() {
        return Previsao::all();
    }
}
