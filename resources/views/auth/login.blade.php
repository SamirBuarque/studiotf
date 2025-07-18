@extends("layouts.guest")

@section("title", "Login")

@section("content")

  <div class="container vh-100 d-flex align-items-center justify-content-center overflow-hidden">
    <div class="row w-100 justify-content-center">
      <div class="col-md-6 col-lg-4">
      <div class="card shadow">
        <div class="card-title text-center mt-3">
          <h2 class="">StudioTF</h2>
          <h2>Gerenciador de eventos</h2>
        </div>
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
  </div>




@endsection