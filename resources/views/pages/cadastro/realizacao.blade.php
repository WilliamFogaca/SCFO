@extends('layouts.main')

@section('content')
<div class="container mb-3"  style="margin-top:100px!important;">
        <div class="row">
            @include('layouts.menu')
            <div class="col-12 col-sm-12 col-md-8 col-lg-9 bg-light border border-dark rounded mt-2 py-2">
                <div class="container text-center">
                    <h5>Realizações</h5>
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
                                        <th scope="col">Data realizada</th>
                                        <th scope="col">Valor realizado</th>
                                        <th scope="col" class="text-center">---</th>
                                      </tr>
                                    </thead>
                                    
                                    <tbody>
                                      @forelse ($contaRealizacoes as $contaRealizacao)
                                        <tr>
                                          <th scope="row">{{ $contaRealizacao->codigo }}</th>
                                          <td>{{ $contaRealizacao->tipo == 1 ? 'Receita' : 'Despesa' }}</td>
                                          <td>{{ $contaRealizacao->titulo }}</td>
                                          <td>{{ date('d/m/Y', strtotime($contaRealizacao->data_real))}}</td>
                                          <td>{{ $contaRealizacao->valor_real}}</td>
                                          <td class="text-center"><a href="{{ url("/cadastro/realizacao/remove/{$contaRealizacao->id}") }}"><i class="fas fa-trash-alt"></i></a></td>
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
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 bg-light border border-dark rounded mt-2 py-2 mx-auto">
                <div class="container ">
                    <form class="mx-auto text-dark " style="width: auto;" action="{{ url('/cadastro/realizacao/save') }}" method="post">
                        {{ csrf_field() }}
                        
                        <div class="container text-center  mt-3">
                            <h5>Cadastrar Realização</h5>
                        </div>
                        
                        <div class="dropdown-divider"></div>
                        
                        @if($existe)
                            <div class="alert alert-danger">
                                <strong>Já foi cadastrado uma realização para essa conta</strong>
                            </div>
                        @endif
                        
                        <div class="form-group">
                                    <label for="tipoConta">Selecione a Conta</label>
                                    <select class="form-control" name="codigoConta" required>
                                        @forelse ($contas as $conta)
                                        <option>{{$conta->codigo}} - {{$conta->titulo}}</option>
                                        @empty
                                        <option>Nenhuma Conta cadastrada</option>
                                        @endforelse
                                    </select>
                                </div>
                        
                        <div class="form-group {{ $errors->has('dataReal') ? ' has-error' : '' }}">
                            <label for="exampleInputCpf">Pago/Recebido no dia</label>
                            <input type="text" class="form-control" id="datavencimento" placeholder="DD/MM/AAAA" name="dataReal">
                            @if ($errors->has('dataReal'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('dataReal') }}</strong>
                                </div>
                            @endif
                        </div>
                        
                       <div class="form-group {{ $errors->has('valorReal') ? ' has-error' : '' }}">
                            <label for="exampleInputCpf">Valor do lançamento</label>
                            <input type="text" class="form-control" id="valorconta" placeholder="R$ 0,00" name="valorReal">
                            @if ($errors->has('valorReal'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('valorReal') }}</strong>
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