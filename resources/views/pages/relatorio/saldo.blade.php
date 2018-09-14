@extends('layouts.main')

@section('content')
<div class="container mb-3" style="margin-top:100px!important;">
        <div class="row">
            @include('layouts.menu')
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 bg-light border border-dark rounded mt-2 py-2">
                <div class="container text-center mt-3 mb-3">
                    <h5>Relatório de saldos</h5>
                </div>
                <div class="dropdown-divider"></div>
                        <div class="container ">
                            <form class="mx-auto text-dark " style="width: auto;">
                                <div class="container text-center">
                                    <h5>Saldos</h5>
                                </div>
                                <div class="table-responsive-sm table-responsive-md table-responsive-lg pr-4">
                                  <table class="table table-bordered" >
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col" >Data de Lançamento</th>
                                        <th scope="col" >Inicial previsto</th>
                                        <th scope="col" >Final previsto</th>
                                        <th scope="col" >Inicial realizado</th>
                                        <th scope="col" >Final realizado</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($situacaoMensals as $situacaoMensal)
                                        <tr>
                                          <td scope="row">{{ date('d/m/Y', strtotime($situacaoMensal->data)) }}</td>
                                          <td >R$ {{$situacaoMensal->saldo_inicial_previsto or '0.00'}}</td>
                                          <td >R$ {{$situacaoMensal->saldo_final_previsto or '0.00'}}</td>
                                          <td >R$ {{$situacaoMensal->saldo_inicial_real or '0.00'}}</td>
                                          <td >R$ {{$situacaoMensal->saldo_final_real or '0.00'}}</td>
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