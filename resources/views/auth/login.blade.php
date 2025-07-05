@extends("layouts.guest")

@section("title", "Login")

@section("content")

  <div class="row d-flex align-items-center justify-content-center">
    <div class="col-6">
    <div class="card">
      <h2 class="card-title text-center mt-3">Login</h2>
      <div class="card-body">
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="mb-3 form-outline">
        <input type="email" name="email" id="email" class="form-control" required>
        <label for="email" class="form-label">Email</label>
        </div>
        <div class="mb-3 form-outline">
        <input type="password" name="password" id="password" class="form-control" required>
        <label for="password" class="form-label">Senha</label>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
      </div>
    </div>
      @if (session('error'))
        <div class="text-center alert alert-warning alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
  </div>




@endsection