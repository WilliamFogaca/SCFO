@extends('layouts.main')

@section('content')
<div class="container mb-3" style="margin-top:100px!important;">
    <div class="row">
        @include('layouts.menu')
        <div class="col-12 col-sm-12 col-md-8 col-lg-9 bg-light border border-dark rounded mt-2 py-2 mx-auto">
                <div class="container ">
                        <div class="container text-center mt-3">
                            <h2>Perfil de {{$user->nome}}</h2>
                        </div>
                        
                        <div class="dropdown-divider"></div>
                        
                        <div class="form-group text-center">
                            <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                        </div>
                        
                        <form enctype="multipart/form-data" action="/profile/update_avatar" method="POST">
                            <label>Atualizar imagem de perfil:</label><br>
                            <input type="file" name="avatar">
                            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="pull-right btn btn-md btn-scfo2">
                            @if(!$permitido)
                                <div class="alert alert-danger text-center" style="margin-top:80px">
                                    <strong>Extensão não permitida. Apenas arquivos .png, .jpeg, .jpg são aceitos.</strong>
                                </div>
                            @endif
                            
                        </form>
                        
                        
                        <div class="form-group" style="font-size:20px;">
                            <label class="font-weight-bold">CPF:</label>
                            <label>{{Auth::User()->cpf}}</label>
                        </div>
                        
                        <div class="form-group" style="font-size:20px;">
                            <label class="font-weight-bold">E-mail:</label>
                            <label>{{Auth::User()->email}}</label>
                        </div>

                    </form>
                </div>
            </div>    
    </div>
</div>
@stop