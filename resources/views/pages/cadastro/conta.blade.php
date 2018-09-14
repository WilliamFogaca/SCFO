@extends('layouts.main')

@section('content')
<div class="container mb-3" style="margin-top:100px!important;">
        <div class="row">
            @include('layouts.menu')
            <div class="col-12 col-sm-12 col-md-8 col-lg-9 bg-light border border-dark rounded mt-2 py-2">
                <div class="container text-center mt-3 mb-3">
                    <h5>Relatório de contas</h5>
                </div>
                <div class="dropdown-divider"></div>
                        <div class="container ">
                            <form class="mx-auto text-dark " style="width: auto;">
                                <div class="container text-center">
                                    <h5>Contas</h5>
                                </div>
                                
                                <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                                  <table class="table table-bordered">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col" class="text-center">---</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($contas as $conta)
                                        <tr>
                                            <th scope="row">{{ $conta->codigo }}</th>
                                            <td>{{ $conta->tipo == 1 ? 'Receita' : 'Despesa' }}</td>
                                            <td>{{ $conta->titulo }}</td>
                                            <td>{{ $conta->descricao }}</td>
                                            @if($conta->codigo != 1 && $conta->codigo != 999)
                                                <td class="text-center"><a href="{{ url("/cadastro/conta/remove/{$conta->id}") }}"><i class="fas fa-trash-alt"></i></a></td>
                                            @else
                                                <td class="text-center">---</td>
                                            @endif
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>  
                                </div>                       
                            </form>
                        </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 bg-light border border-dark rounded mt-2 py-2 mx-auto">
                <div class="container ">
                    <form class="mx-auto text-dark " style="width: auto;" action="{{ url('/cadastro/conta/save') }}" method="post">
                        {{ csrf_field() }}
                        <div class="container text-center  mt-3">
                            <h5>Cadastre sua conta</h5>
                        </div>
                        
                        <div class="dropdown-divider"></div>
                        
                        @if($existe)
                            <div class="alert alert-danger">
                                <strong>Esse código já foi cadastrado para uma conta</strong>
                            </div>
                        @endif
                        
                        <div class="form-group {{ $errors->has('codigo') ? ' has-error' : '' }}">
                            <label for="codigoConta">Código da conta*</label>
                            <input type="text" class="form-control" id="codigoConta" name="codigo">
                            <small class="text-danger">O código 1 é reservado para o saldo inicial*</small>
                            <small class="text-danger">O código 999 é reservado para o saldo final*</small>
                            @if ($errors->has('codigo'))
                                <div class="alert alert-danger">
                                  <strong>{{ $errors->first('codigo') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
                            <label for="tituloConta">Título da conta*</label>
                            <input type="text" class="form-control" id="tituloconta" placeholder="Ex.: Conta de luz" name="titulo">
                            @if ($errors->has('titulo'))
                                <div class="alert alert-danger">
                                  <strong>{{ $errors->first('titulo') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tipoConta">Selecionar tipo de conta*</label>
                            <select class="form-control" name="tipo">
                                <option value="1">Receita</option>
                                <option value="2">Despesa</option>
                            </select>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="descricaodaConta">Descrição da conta (opcional)</label>
                                <textarea class="form-control" id="descricaoConta" rows="5" name="descricao" ></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-scfo2 float-right mt-3 btn-md col-">Cadastrar conta</button>
                        <a href="{{ url('/') }}">
                            <button type="button" class="btn btn-scfo2 mt-3 btn-md col-">Cancelar</button>
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop