<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Previsao;

use App\Conta;

use App\SituacaoMensal;

class PrevisaoController extends Controller
{
    private $existe = false;
    
    public function index() {
        $existe = false;
        $contas = Conta::where('cpf_user', \Auth::user()->cpf)->orderBy('codigo', 'asc')->get();
        $ContaPrevisoes = Conta::join('previsoes', 'previsoes.id_conta', '=', 'contas.id')
            ->where('contas.cpf_user', '=', \Auth::user()->cpf)
            ->orderBy('codigo', 'asc')->get();
        
        return view('pages.cadastro.previsao', ['contas' => $contas, 'existe' => $existe, 'contaPrevisoes' => $ContaPrevisoes]);
    }
    
    public function relatorio() {
        $naoExiste = true;
        $ContaPrevisoes = Conta::join('previsoes', 'previsoes.id_conta', '=', 'contas.id')
            ->where('contas.cpf_user', '=', \Auth::user()->cpf)
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
        $data = explode("/", $request->dataPrevista);
        //Formatar data para o banco de dados
        $data = $data[2]."-".$data[1]."-".$data[0];
        
        $valor = $request->valorPrevisto;
        //Formatar preço para o banco de dados
        $valor = str_replace(".","",$valor);
        $valor = str_replace(",",".",$valor);
        
        $idConta = Conta::select('id')
            ->where('cpf_user', \Auth::user()->cpf)
            ->where('codigo', $codigo)
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
            $PrevisaoExiste = Conta::join('previsoes', 'previsoes.id_conta', '=', 'contas.id')
                ->where('contas.cpf_user', \Auth::user()->cpf)
                ->where('codigo', $codigo)->count();
            
            if($PrevisaoExiste == 0){
                $previsao = Previsao::create([
                    'data_prevista' => $data,
                    'valor_previsto' => $valor,
                    'id_conta' => $idConta,
                ]);
                
                $CODIGO_INICIAL = 1;
                $CODIGO_FINAL = 999;
                if($codigo == $CODIGO_INICIAL){
                    $situacaoMensal = SituacaoMensal::where('cpf_user', \Auth::user()->cpf)
                        ->update(['saldo_inicial_previsto' => $valor]);
                }else if($codigo == $CODIGO_FINAL){
                    $situacaoMensal = SituacaoMensal::where('cpf_user', \Auth::user()->cpf)
                        ->update(['saldo_final_previsto' => $valor]);
                }
                
            }else{
                $existe = true;
                $contas = Conta::where('cpf_user', \Auth::user()->cpf)->whereNotIn('codigo', [999])->orderBy('codigo', 'asc')->get();
                $ContaPrevisoes = Conta::join('previsoes', 'previsoes.id_conta', '=', 'contas.id')
                    ->where('contas.cpf_user', \Auth::user()->cpf)
                    ->orderBy('codigo', 'asc')->get();
                
                return view('pages.cadastro.previsao', ['contas' => $contas, 'existe' => $existe, 'contaPrevisoes' => $ContaPrevisoes]);
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
        $previsao = Conta::join('previsoes', 'previsoes.id_conta', '=', 'contas.id')
            ->where('contas.cpf_user', \Auth::user()->cpf)
            ->where('previsoes.id', $id)->pluck('codigo');
        $codigo = $previsao[0];
        
        if($codigo == 1){
            $situacaoMensal = SituacaoMensal::where('cpf_user', \Auth::user()->cpf)
                ->update(['saldo_inicial_previsto' => null]);
        }else if($codigo == 999){
            $situacaoMensal = SituacaoMensal::where('cpf_user', \Auth::user()->cpf)
                ->update(['saldo_final_previsto' => null]);
        }
        
        
        Previsao::destroy($id);
        return redirect()->route('cadastro.previsao');
    }
    
    public function findOne(Request $request) {
        $id = $request->id;
        return Previsao::findOrFail($id);
    }
    
    public function findAll() {
        return Previsao::all();
    }
}
