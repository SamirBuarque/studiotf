@extends('layouts.app')

@section('title', 'Adicionar Inventário')

@section('breadcrumbs')
  {{ Breadcrumbs::render('inventory.create') }}
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
      <div class="card-title text-center"><h1>Adicionar Inventário</h1></div>

      <div class="card-body">
        <form action="{{ route('inventory.store') }}" method="post">
          @csrf
          <div class="mb-3 form-outline">
            <input type="text" name="name" id="name" class="form-control" required>
            <label for="name" class="form-label">Nome</label>
          </div>
          <div class="mb-3 form-outline">
            <input type="text" name="category" id="category" class="form-control">
            <label for="category" class="form-label">Categoria</label>
          </div>
          <div class="mb-3 form-outline">
            <input type="number" name="quantity" id="quantity" class="form-control">
            <label for="quantity" class="form-label">Quantidade</label>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>

</div>


@endsection
