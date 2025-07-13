@extends('layouts.app')

@section('title', 'Inventário')

@section('content')

  <div class="col mt-3">
    <h1>Mensagem: {{ session('success') }}</h1>
    <div class="d-flex align-items-center justify-content-center">
    @if (session('success'))
    <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    </div>
    <div class="card">
    <div class="card-body">
      <div id="inventory-root"></div>
    </div>
    </div>
  </div>

  <script>
    window.laravelRoutes = {
    createInventoryUrl: @json(route('inventory.create')),
    createInventoryEditUrl: @json(route('inventory.edit', ['inventory' => '__ID__']))
    };

  </script>


@endsection