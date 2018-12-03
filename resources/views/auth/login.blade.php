@extends('layouts.main')

@section('content')
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-scfo ">
    <div class="container">

      <a class="navbar-brand " href="#">SCFO</a>

      <ul class="navbar-nav float-right">
        
        <a href="{{ url('/register') }}">
          <button type="button" class="btn btn-scfo mt-1">Cadastre-se</button>
        </a>
      </ul>

    </div>
  </nav>
    <div class="card mb-3 mt-3 mx-auto bg-white border-success" style="max-width: 30rem; margin-top:85px!important;">
      <div class="card-header text-center text-scfo">Sistema de Controle Financeiro Orçamentário</div>
      <div class="card-body">
        <div class="container ">
          <form class="mx-auto text-scfo" style="width: auto;" "card-text" action="{{ url('/login') }}" method="post">
            {{ csrf_field() }}
          <div class="container text-center">
            <h5 >Login</h5>
          </div>
          
            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
            <label for="cpf" class="col-md-12 control-label">CPF</label>
            <input id="cpf" type="text" class="form-control" name="cpf" value="{{ old('cpf') }}" placeholder="Ex.: 000.000.000-00" maxlength="11">

          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-12 control-label">Senha</label>
              <input id="password" type="password" class="form-control" name="password">

              @if ($errors->has('password'))
                  <div class="alert alert-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                  </div>
              @endif
          </div>
          
          @if ($errors->has('cpf'))
                <div class="alert alert-danger">
                  <strong>{{ $errors->first('cpf') }}</strong>
                </div>
          @endif
          
          <p class="small">Esqueceu sua senha? <a class="text-dark" href="{{ url('/password/reset') }}">Clique Aqui!</a></p>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
            <label class="form-check-label" for="exampleCheck1">Manter conectado</label>
          </div >
          <button type="submit" class="btn btn-scfo2 btn-block float-right">Entrar</button>
          </form>
          
        </div>
      </div>
    </div>
@endsection