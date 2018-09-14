@extends('layouts.main')

@section('content')
        <nav class="navbar navbar-expand-md navbar-dark bg-scfo fixed-top">
            <div class="container">
                <a class="navbar-brand " href="{{ url('/login') }}">SCFO</a>
                
                <ul class="navbar-nav float-right">
                    <a href="{{ url('/login') }}">
                        <button type="button" class="btn btn-scfo mt-1">Login</button>
                    </a>
                </ul>
            </div>
        </nav>
        <div class="card text-white bg-light mb-3 mt-3 mx-auto" style="max-width: 30rem; margin-top:85px!important;">
            <div class="card-header text-dark text-center">Cadastro de Usuário</div>
            <div class="card-body">
                <div class="container pt-3 ">
                    
                    <form class="mx-auto text-dark " style="width: auto;" action="{{ url('/register') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                            <label for="cpf" class="col-md-12 control-label">CPF*</label>
                            <input id="cpf" type="text" class="form-control" name="cpf" value="{{ old('cpf') }}" placeholder="Ex.: 000.000.000-00" autofocus="on">
                            <small class="text-danger">Não é necessário colocar '.' e '-' para o CPF</small>
                            @if ($errors->has('cpf'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('cpf') }}</strong>
                                </div>
                            @endif
                      </div>
    
                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="exampleInputNome">Nome completo*</label>
                            <input id="name" type="text" name="nome" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="Nome completo">
                            @if ($errors->has('nome'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('nome') }}</strong>
                                </div>
                            @endif
                        </div>
    
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">E-mail*</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="exemplo@mail.com">
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
    
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword1">Senha*</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Insira sua senha">
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
    
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword2">Confirmar senha*</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirme a senha">
                            @if ($errors->has('password_confirmation'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </div>
                            @endif
                        </div>
    
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1">Ao clicar em "Cadastrar", você aceita os
                                <a href="#termos">Termos</a> e a Política de
                                <a href="#privacidade">Privacidade</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-scfo float-right">Cadastrar</button>
                    </form>
                    
                </div>
            </div>
        </div>
@endsection