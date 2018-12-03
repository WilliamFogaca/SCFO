<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Realizacao;

use App\SituacaoMensal;

use App\Conta;

class RealizacaoController extends Controller
{
    public function index() {
        $existe = false;
        $contas = Conta::where('cpf_user', \Auth::user()->cpf)->whereNotIn('codigo', [999])->orderBy('codigo', 'asc')->get();
        $ContaRealizacoes = Conta::join('realizacoes', 'realizacoes.id_conta', '=', 'contas.id')
            ->where('contas.cpf_user', '=', \Auth::user()->cpf)
            ->orderBy('codigo', 'asc')->get();
        
        return view('pages.cadastro.realizacao', ['contas' => $contas, 'existe' => $existe, 'contaRealizacoes' => $ContaRealizacoes]);
    }
    
    public function relatorio() {
        $naoExiste = true;
        $saldo = 0;
        $ContaRealizacoes = Conta::join('realizacoes', 'realizacoes.id_conta', '=', 'contas.id')
            ->where('contas.cpf_user', \Auth::user()->cpf)
            ->orderBy('codigo', 'asc')->get();
        if($ContaRealizacoes != null){
            $naoExiste = false;
            $mesAtual = date('Y-m');
            $SaldoInicialReal = SituacaoMensal::where('cpf_user', \Auth::user()->cpf)
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
        $data = explode("/", $request->dataReal);
        //Formatar data para o banco de dados
        $data = $data[2]."-".$data[1]."-".$data[0];
        
        $valor = $request->valorReal;
        //Formatar preço para o banco de dados
        $valor = str_replace(".","",$valor);
        $valor = str_replace(",",".",$valor);
        
        $idConta = Conta::select('id')
            ->where('codigo', $codigo)
            ->where('cpf_user', \Auth::user()->cpf)
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
            $RealizacaoExiste = Conta::join('realizacoes', 'realizacoes.id_conta', '=', 'contas.id')
                ->where('contas.cpf_user', \Auth::user()->cpf)
                ->where('codigo', $codigo)->count();
            
            if($RealizacaoExiste == 0){
                $realizacao = Realizacao::create([
                    'data_real' => $data,
                    'valor_real' => $valor,
                    'id_conta' => $idConta,
                ]);
                
                if($codigo == 1){
                    $situacaoMensal = SituacaoMensal::where('cpf_user', \Auth::user()->cpf)
                        ->update(['saldo_inicial_real' => $valor]);
                }
            }else{
                $existe = true;
                $contas = Conta::where('cpf_user', \Auth::user()->cpf)->whereNotIn('codigo', [999])->orderBy('codigo', 'asc')->get();
                $ContaRealizacoes = Conta::join('realizacoes', 'realizacoes.id_conta', '=', 'contas.id')
                    ->where('contas.cpf_user', \Auth::user()->cpf)
                    ->orderBy('codigo', 'asc')->get();
                
                return view('pages.cadastro.realizacao', ['contas' => $contas, 'existe' => $existe, 'contaRealizacoes' => $ContaRealizacoes]);
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
        
        $realizacao = Conta::join('realizacoes', 'realizacoes.id_conta', '=', 'contas.id')
            ->where('contas.cpf_user', \Auth::user()->cpf)
            ->where('realizacoes.id', $id)->pluck('codigo');
        $codigo = $realizacao[0];
        
        if($codigo == 1){
            $situacaoMensal = SituacaoMensal::where('cpf_user', \Auth::user()->cpf)
                ->update(['saldo_inicial_real' => null]);
        }
        
        Realizacao::destroy($id);
        return redirect()->route('cadastro.realizacao');
        
    }
    
    public function findOne(Request $request) {
        $id = $request->id;
        return Realizacao::findOrFail($id);
    }
    
    public function findAll() {
        return Realizacao::all();
    }
}
