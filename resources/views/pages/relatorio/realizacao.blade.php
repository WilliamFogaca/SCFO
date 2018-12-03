@extends('layouts.main')

@section('content')
<div class="container mb-3" style="margin-top:100px!important;">
        <div class="row">
            @include('layouts.menu')
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 bg-light border border-dark rounded mt-2 py-2">
                <div class="container text-center mt-3 mb-3">
                    <h5>Relatório de realizações</h5>
                </div>
                <div class="dropdown-divider"></div>
                        <div class="container ">
                            <form class="mx-auto text-dark " style="width: auto;">
                                <div class="container text-center">
                                    <h5>Realizações</h5>
                                </div>
                                @if($naoExiste)
                                    <div class="alert alert-secondary text-center mt-2 py-3">
                                        <strong>Deve-se cadastrar a realização para uma conta</strong>
                                    </div>
                                @else
                                <div class="table-responsive-sm table-responsive-md table-responsive-lg pr-4">
                                  <table class="table table-bordered">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Data realizada</th>
                                        <th scope="col">Valor realizado</th>
                                        <th scope="col">Saldo final real</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @forelse ($contaRealizacoes as $contaRealizacao)
                                        <tr>
                                          <th scope="row">{{ $contaRealizacao->codigo }}</th>
                                          <td>{{ $contaRealizacao->tipo == 1 ? 'Receita' : 'Despesa' }}</td>
                                          <td>{{ $contaRealizacao->titulo }}</td>
                                          <td>{{ date('d/m/Y', strtotime($contaRealizacao->data_real)) }}</td>
                                          <td>R$ {{ $contaRealizacao->valor_real}}</td>
                                          @if($contaRealizacao->codigo != 1)
                                            @if($contaRealizacao->tipo == 1)
                                              <td>R$ {{ sprintf("%01.2f", $saldo = $saldo + $contaRealizacao->valor_real) }}</td>
                                            @elseif($contaRealizacao->tipo == 2)
                                              <td>R$ {{ sprintf("%01.2f", $saldo = $saldo - $contaRealizacao->valor_real) }}</td>
                                            @endif
                                          @else
                                            <td>R$ {{ $saldo }}</td>
                                          @endif
                                          </td>
                                          @empty
                                          <td class="text-center" colspan="6">Nenhuma realização cadastrada</td>
                                        </tr>
                                      @endforelse
                                    </tbody>
                                  </table>  
                                </div>                       
                            </form>
                         @endif
                      </div>
                @if(!$naoExiste)
                  <button class="d-print-none btn btn-scfo ml-3 float-right mt-3 btn-md col-" onclick="window.print()">Imprimir relatório</button>
                @endif
            </div>
        </div>
    </div>
@stop