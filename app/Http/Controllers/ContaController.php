<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Conta;

use App\SituacaoMensal;

use Validator;

use DB;


class ContaController extends Controller
{
    public function index() {
        $existe = false;
        $contas = DB::table('contas')->where('cpf_user', \Auth::user()->cpf)->orderBy('codigo', 'asc')->get();
        return view('pages.cadastro.conta', ['existe' => $existe], ['contas' => $contas]);
        
    }
    
    public function relatorio() {
        $contas = DB::table('contas')->where('cpf_user', \Auth::user()->cpf)->orderBy('codigo', 'asc')->get();
        return view('pages.relatorio.conta', ['contas' => $contas]);
    }
    
    public function criarSaldo(){
        $nomeUsuario = \Auth::user()->nome;
        $nomeSeparado = explode(" ", $nomeUsuario);
        $nome = $nomeSeparado[0]." ".$nomeSeparado[1];
        
        $contas = DB::table('contas')->where('cpf_user', \Auth::user()->cpf)->whereIn('codigo', [1,999])->get();
        if($contas == null){
            $saldoInicial = Conta::create([
                'codigo' => 1,
                'titulo' => 'Saldo inicial',
                'tipo' => 1,
                'cpf_user' => \Auth::user()->cpf,
            ]);
            
            $saldoInicial = Conta::create([
                'codigo' => 999,
                'titulo' => 'Saldo final',
                'tipo' => 1,
                'cpf_user' => \Auth::user()->cpf,
            ]);
            
            $situacaoMensal = SituacaoMensal::create([
                'data' => date('Y-m-d'),
                'cpf_user' => \Auth::user()->cpf,
            ]);
            
            return view('pages.index', ['nome' => $nome]);
        }
        return view('pages.index', ['nome' => $nome]);
    }
    
    public function save(Request $request) {
        
        $id = $request->id;
        $codigo = $request->codigo;
        $titulo = $request->titulo;
        $tipo = $request->tipo;
        $descricao = $request->descricao;
        $cpfUser = \Auth::user()->cpf;
        
        $dadosForm = $request->all();
        $messages = [
            'required' => 'O campo a cima é obrigatório. Preencha-o.',
            'codigo.not_in' => 'Esse código é reservado!'
        ];
        $validacao = validator($dadosForm, [
            'codigo' => 'required|max:3|not_in: 1, 999',
            'titulo' => 'required|max:255',
        ], $messages);
        if($validacao->fails()){
            return redirect('/cadastro/conta')->withErrors($validacao)->withInput();
        }
        
        if ($id == null) {
            $codigoConta = DB::table('contas')->where([
                ['cpf_user', \Auth::user()->cpf],
                ['codigo', $codigo],
            ])->get();
            if($codigoConta==null){
                $conta = Conta::create([
                    'codigo' => $codigo,
                    'titulo' => $titulo,
                    'tipo' => $tipo,
                    'descricao' => $descricao,
                    'cpf_user' => $cpfUser,
                ]);
            }else{
                $existe = true;
                $contas = DB::table('contas')->where('cpf_user', \Auth::user()->cpf)->orderBy('codigo', 'asc')->get();
                return view('pages.cadastro.conta', ['existe' => $existe, 'contas' => $contas]);
            }
            
        }else{
            $conta = Conta::findOrFail($id);
            $conta->codigo = $codigo;
            $conta->titulo = $titulo;
            $conta->tipo = $tipo;
            $conta->descricao = $descricao;
            $conta->cpfUser = $cpfUser;
        }

        $conta->save();
        return redirect()->route('cadastro.conta');
    }
    
    public function remove($id) {
        
        $delete = DB::table('contas')->where('id', $id)->delete();
        
        if($delete){
                return redirect()->route('cadastro.conta');
        }
    }
    
    public function findOne(Request $request) {
        $id = $request->id;
        return Conta::findOrFail($id);
    }
    
    public function findAll() {
        return Conta::all();
    }
}
