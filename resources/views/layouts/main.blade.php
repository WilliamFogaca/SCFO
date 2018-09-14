<!DOCTYPE html>
<html lang="pt-br" style="position: relative; min-height: 100%;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Controle Financeiro Orçamentário</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    
    
    
</head>
<body style="margin-bottom: 150px; background-image: url('/img/money50.png'); height: 100%; background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">
    
    @if (!Auth::guest())
    <nav class="navbar navbar-expand-md navbar-dark bg-scfo fixed-top">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand ">SCFO</a>
            
            <li class="dropdown">
                     <a href="#" class="btn btn-scfo dropdown-toggle" data-toggle="dropdown"><img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="mr-2" style="width:32px; height:32px; top:3px; left:10px; border-radius:50%">Olá, {{ $nome }}<b class="caret"></b></a>
                     <ul class="dropdown-menu dropdown-menu-right border border-dark rounded" style="padding: 15px;min-width: 250px; ">
                        <li>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group text-center">
                                       <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; top:3px; left:10px; border-radius:50%">
                                    </div>
                                    <div class="form-group text-center">
                                       <label>CPF: {{ Auth::user()->cpf }}</label>
                                    </div>
                                    <div class="form-group text-center">
                                       <label>E-mail: {{ Auth::user()->email }}</label>
                                    </div>
                                    <div class="form-group text-center">
                                       <a href="{{ url('/profile') }}" class="btn btn-info">Meu perfil</a>
                                    </div>
                                    <div class="form-group">
                                       <a href="{{ url('/logout') }}" class="btn btn-danger btn-block">Sair</a>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </li>
                     </ul>
            </li>
                  
            
            
            <!-- <form class="form-inline">
                <ul class="list-unstyled text-white text-center ml-2 mr-2 pt-2">
                    <li>
                        <p class="mb-0 ">{{ Auth::user()->nome }}</p>
                    </li>
                    <li>{{ Auth::user()->cpf }}</li>
                </ul>
                <a href="{{ url('/logout') }}" class="btn btn-scfo">Sair</a>
            </form> -->
        </div>
    </nav>               
    @endif
    
    @yield('content')
    
</body>
    <div style="position: absolute;
                bottom: 0;
                width: 100%;">
        <footer class="container-fluid navbar navbar-expand-md navbar-dark text-white bg-scfo ">
        <div class="container">
            <p>CONTATO<br>
            <span>sac.scfo@gmail.com</span></p>
            

        </div>
               
         
    </footer>
    <div id="copyright" class="container-fluid bg-scfo text-scfo text-center p-2"><small>SCFO - 2018 Todos os direitos reservados.</small></div>
    
    </div>
    
    <script src="/js/jquery-3.3.1.slim.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script src="/js/scripts.js"></script>
</html>