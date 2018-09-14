@extends('layouts.main')

@section('content')
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary ">
            <div class="container">
                <a class="navbar-brand " href="index.php">SCFO</a>
                <ul class="navbar-nav float-right">
                    <a href="{{ url('/login') }}">
                        <button type="button" class="btn btn-dark mt-1">Login</button>
                    </a>
                </ul>
            </div>
        </nav>
        <div class="card text-white bg-light mb-3 mt-3 mx-auto" style="max-width: 30rem;">
            <div class="card-header text-dark text-center">Cadastro de Usuário</div>
            <div class="card-body">
                <div class="container pt-3 ">
                    
                    <form class="mx-auto text-dark " style="width: auto;" action="{{ url('/register') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">CPF</label>
                            <input type="text" name="cpf" class="form-control" id="exampleInputCpf" aria-describedby="" placeholder="000.000.000-00" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" required>
                            @if ($errors->has('cpf'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cpf') }}</strong>
                                </span>
                            @endif
                        </div>
    
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="exampleInputNome">Nome completo</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="Nome completo" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
    
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entre com seu email" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
    
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword1">Senha</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Insira sua senha" pattern=".{8,20}" required title="A senha deve possuir de 8 a 20 caracteres" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
    
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword2">Confirmar senha</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirme a senha" pattern=".{8,20}" required title="A senha deve possuir de 8 a 20 caracteres" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
    
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1">Ao clicar em "Cadastrar", você aceita os
                                <a href="#termos">Termos</a> e a Política de
                                <a href="#privacidade">Privacidade</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-dark float-right">Cadastrar</button>
                    </form>
                    
                </div>
            </div>
        </div>
@endsection