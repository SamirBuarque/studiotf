@extends('layouts.app')

@section('title', 'Editar Inventário')

@section('breadcrumbs')
  {{ Breadcrumbs::render('inventory.edit', $inventory) }}
@endsection

@section('content')

<div class="row d-flex justify-content-center align-items-center">
  <div class="col-8 mt-3">
    <div class="card">
      <div class="card-title text-center"><h1>Editar Inventário</h1></div>

      <div class="card-body">
        <form action="{{ route('inventory.update', ['inventory' => $inventory]) }}" method="post">
          @csrf
          @method('PUT')

          <div class="mb-3 form-outline">
            <input type="text" name="name" id="name" class="form-control" value="{{$inventory->name}}" required>
            <label for="name" class="form-label">Nome</label>
          </div>
          <div class="mb-3 form-outline">
            <input type="text" name="category" id="category" class="form-control" value="{{$inventory->category}}" required>
            <label for="category" class="form-label">Categoria</label>
          </div>
          <div class="mb-3 form-outline">
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{$inventory->total_quantity}}" required>
            <label for="quantity" class="form-label">Quantidade</label>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>

</div>


@endsection
