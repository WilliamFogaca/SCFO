@extends('layouts.main')

@section('content')
<div class="container mb-3" style="margin-top:100px!important;">
        <div class="row">
            @include('layouts.menu')
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 bg-light border border-dark rounded mt-2 py-2">
                <div class="container text-center mt-3 mb-3">
                    <h5>Relatório de previsões</h5>
                </div>
                <div class="dropdown-divider"></div>
                        <div class="container ">
                            <form class="mx-auto text-dark " style="width: auto;">
                                <div class="container text-center">
                                    <h5>Previsões</h5>
                                </div>
                                @if($naoExiste)
                                    <div class="alert alert-secondary text-center mt-2 py-3">
                                        <strong>Deve-se cadastrar a previsão para uma conta</strong>
                                    </div>
                                @else
                                <div class="table-responsive-sm table-responsive-md table-responsive-lg pr-4">
                                  <table class="table table-bordered">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Data prevista</th>
                                        <th scope="col">Valor previsto</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @forelse ($contaPrevisoes as $contaPrevisao)
                                        <tr>
                                          <th scope="row">{{ $contaPrevisao->codigo }}</th>
                                          <td>{{ $contaPrevisao->tipo == 1 ? 'Receita' : 'Despesa' }}</td>
                                          <td>{{ $contaPrevisao->titulo }}</td>
                                          <td>{{ date('d/m/Y', strtotime($contaPrevisao->data_prevista)) }}</td>
                                          <td>{{ $contaPrevisao->valor_previsto}}</td>
                                          @empty
                                          <td class="text-center" colspan="5">Nenhuma previsão cadastrada</td>
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