@extends('layouts.main')

@section('content')
<div class="container mb-3" style="margin-top:100px!important;">
        <div class="row">
            @include('layouts.menu')
            <div class="col-12 col-sm-12 col-md-8 col-lg-9 bg-light border border-dark rounded mt-2 py-2">
                <div class="container text-center mt-3 mb-3">
                    <h5>Previsões</h5>
                </div>
                <div class="dropdown-divider"></div>
                        <div class="container ">
                            <form class="mx-auto text-dark " style="width: auto;">
                                <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                                  <table class="table table-bordered">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Data prevista</th>
                                        <th scope="col">Valor previsto</th>
                                        <th scope="col" class="text-center">---</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @forelse ($contaPrevisoes as $contaPrevisao)
                                        <tr>
                                          <th scope="row">{{ $contaPrevisao->codigo }}</th>
                                          <td>{{ $contaPrevisao->tipo == 1 ? 'Receita' : 'Despesa' }}</td>
                                          <td>{{ $contaPrevisao->titulo }}</td>
                                          <td>{{ date('d/m/Y', strtotime($contaPrevisao->data_prevista))}}</td>
                                          <td>{{ $contaPrevisao->valor_previsto}}</td>
                                          <td class="text-center"><a href="{{ url("/cadastro/previsao/remove/{$contaPrevisao->id}") }}"><i class="fas fa-trash-alt"></i></a></td>
                                          @empty
                                          <td class="text-center" colspan="6">Nenhuma previsão cadastrada</td>
                                        </tr>
                                      @endforelse
                                      
                                    </tbody>
                                  </table>
                                </div>            
                            </form>
                        </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 bg-light border border-dark rounded mt-2 py-2 mx-auto">
                        <div class="container">
                            <form class="mx-auto text-dark " action="{{ url('/cadastro/previsao/save') }}" method="post">
                                {{ csrf_field() }}
                                
                                <div class="container text-center  mt-3">
                                    <h5>Valores Previstos</h5>
                                </div>
                                
                                <div class="dropdown-divider"></div>
                                
                                @if($existe)
                                    <div class="alert alert-danger">
                                        <strong>Já foi cadastrado uma previsão para esse código</strong>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <label for="tipoConta">Selecione a Conta</label>
                                    <select class="form-control" name="codigoConta">
                                        @forelse ($contas as $conta)
                                        <option>{{$conta->codigo}} - {{$conta->titulo}}</option>
                                        @empty
                                        <option>Nenhuma Conta cadastrada</option>
                                        @endforelse
                                    </select>
                                </div>
                                
                                <div class="form-group {{ $errors->has('dataPrevista') ? ' has-error' : '' }}">
                                    <label for="exampleInputCpf">Data prevista</label>
                                    <input type="text" class="form-control" id="datavencimento" name="dataPrevista" placeholder="DD/MM/AAAA">
                                    @if ($errors->has('dataPrevista'))
                                        <div class="alert alert-danger">
                                          <strong>{{ $errors->first('dataPrevista') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                
                               <div class="form-group {{ $errors->has('valorPrevisto') ? ' has-error' : '' }}">
                                    <label for="exampleInputCpf">Valor do lançamento</label>
                                    <input type="text" class="form-control" id="valorconta" placeholder="R$ 0.00" name="valorPrevisto">
                                    @if ($errors->has('valorPrevisto'))
                                        <div class="alert alert-danger">
                                          <strong>{{ $errors->first('valorPrevisto') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                    
                                <button type="submit" class="btn btn-scfo2 float-right mt-3 btn-md col-">Salvar</button>
                                <a href="{{ url('/') }}">
                                    <button type="button" class="btn btn-scfo2 mt-3 btn-md col-">Cancelar</button>
                                </a>

                        </form>
                    </div>
            </div>
        </div>
    </div>
@stop