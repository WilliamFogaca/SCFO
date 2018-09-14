<div class="col-12 col-sm-12 col-md-4 col-lg-3 d-print-none">
    <div class="nav flex-column nav-pills mt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical"> 
        <a href="{{ url('/cadastro/conta') }}" class="btn btn-scfo text-left" id="cadastroConta" role="tab" aria-controls="v-pills-home" aria-selected="false">Cadastrar conta</a>
        <a href="{{ url('/cadastro/previsao') }}" class="btn btn-scfo mt-1 text-left" id="v-pills-profile-tab" role="tab" aria-controls="v-pills-profile" aria-selected="false">Cadastrar previsões</a>
        <a href="{{ url('/cadastro/realizacao') }}" class="btn btn-scfo mt-1 text-left" id="inserirValores" role="tab" aria-controls="v-pills-valores" aria-selected="false">Cadastrar realizações</a>
        <a class="dropdown">
          <a href="#" class="btn btn-scfo mt-1 text-left dropdown-toggle" id="dropdownMenuLink" aria-controls="v-pills-valores" role="tab" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Exibir relatórios
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{ url('/relatorio/comparativo') }}">Relatorio comparativo</a>
            <a class="dropdown-item" href="{{ url('/relatorio/previsao') }}">Relatorio de previsões</a>
            <a class="dropdown-item" href="{{ url('/relatorio/realizacao') }}">Relatorio de realizações</a>
            <a class="dropdown-item" href="{{ url('/relatorio/saldo') }}">Relatorio de saldos</a>
            <a class="dropdown-item" href="{{ url('/relatorio/conta') }}">Relatorio de contas</a>
          </div>
        </a>
    </div>
</div>