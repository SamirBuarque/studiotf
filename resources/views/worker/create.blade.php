@extends('layouts.app')

@section('title', 'Adicionar trabalhador')

@section('breadcrumbs')
  {{ Breadcrumbs::render('worker.create') }}
@endsection

@section('content')

<div class="row d-flex justify-content-center align-items-center">
  <div class="col-8 mt-3">
    <div class="d-flex align-items-center justify-content-center">
      @if (session('success'))
        <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('success') }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
    <div class="card">
      <div class="card-title text-center"><h1>Adicionar trabalhador</h1></div>

      <div class="card-body">
        <form action="{{ route('worker.store') }}" method="post">
          @csrf
          <div class="mb-3 form-outline">
            <input type="text" name="name" id="name" class="form-control" required>
            <label for="name" class="form-label">Nome</label>
          </div>
          <div class="mb-3 form-outline">
            <input type="date" name="birth_date" id="birth_date" class="form-control">
            <label for="birth_date" class="form-label">Data de nascimento</label>
          </div>
          <div class="mb-3 form-outline">
            <input type="text" name="position" id="position" class="form-control">
            <label for="position" class="form-label">Função</label>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>

</div>


@endsection
