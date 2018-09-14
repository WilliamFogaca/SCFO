@extends('layouts.main')

<!-- Main Content -->
@section('content')
<nav class="navbar navbar-expand-md navbar-dark bg-scfo ">
    <div class="container">
      <a class="navbar-brand " href="/">SCFO</a>
      <ul class="navbar-nav float-right">
        <a href="{{ url('/register') }}">
          <button type="button" class="btn btn-scfo mt-1">Cadastre-se</button>
        </a>
      </ul>
    </div>
  </nav>
  
    <div class="card text-center bg-light mb-3 mt-3 mx-auto" style="max-width: 60rem;">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default ">
                    <div class="panel-heading"><h2>Recuperar senha</h2></div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <br>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label">Insira aqui seu E-Mail</label>
    
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-scfo">
                                        <i class="fa fa-btn fa-envelope"></i> Enviar link de recuperação no e-mail
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
