@extends('layouts.main')

@section('content')
<div class="container mb-3" style="margin-top:100px!important;">
        <div class="row">
            @include('layouts.menu')
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 bg-light border border-dark rounded mt-2 py-2">
                <div class="container text-center mt-3 mb-3">
                    <h5>Relatório de contas</h5>
                </div>
                <div class="dropdown-divider"></div>
                        <div class="container ">
                            <form class="mx-auto text-dark " style="width: auto;">
                                <div class="container text-center">
                                    <h5>Contas</h5>
                                </div>
                                
                                <div class="table-responsive-sm table-responsive-md table-responsive-lg pr-4">
                                  <table class="table table-bordered">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Descrição</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($contas as $conta)
                                        <tr>
                                          <th scope="row">{{ $conta->codigo }}</th>
                                          <td>{{ $conta->tipo == 1 ? 'Receita' : 'Despesa' }}</td>
                                          <td>{{ $conta->titulo }}</td>
                                          <td>{{ $conta->descricao }}</td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>  
                                </div>                       
                            </form>
                        </div>
                <button class="d-print-none btn btn-scfo ml-3 float-right mt-3 btn-md col-" onclick="window.print()">Imprimir relatório</button>
            </div>
        </div>
    </div>
@stop