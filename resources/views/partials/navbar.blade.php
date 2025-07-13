<nav class="navbar navbar-dark">
  <div class="d-flex align-items-center justify-content-between w-100 mx-3">
    <div class="d-flex align-items-center justify-content-start gap-3">
      <a class="navbar-brand text-white" href="{{route('index')}}">StudioTF</a>
      <a class="text-white text-decoration-none" href="{{ route('worker.index') }}">
        <div class="d-flex align-items-center gap-2">
          <i class="fa-solid fa-users"></i>
          <span>Funcionários</span>
        </div>
      </a>
      <a class="text-white text-decoration-none" href="{{ route('inventory.index') }}">
        <div class="d-flex align-items-center gap-2">
          <i class="fa-solid fa-clipboard-list"></i>
          <span>Inventário</span>
        </div>
      </a>
    </div>
    <div>
      <form action="{{ route('user.logout') }}" class="text-white" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <span>Sair</span>
        </button>
      </form>
    </div>
  </div>
</nav>