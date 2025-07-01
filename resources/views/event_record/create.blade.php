@extends('layouts.app')

@section('title', 'Criar Evento')

@section('content')

  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-8 mt-3">
    <div class="card">
      <div class="text-center card-title">
      <h1>Criar Evento</h1>
      </div>
      <div class="card-body">
      <form action="{{ route('event.store') }}" method="POST">
        @csrf
        <div class="mb-3">
        <label class="form-label text-uppercase">Nome do evento</label>
        <input class="form-control" type="text" name="name">
        </div>
        <div class="mb-3">
        <label class="form-label text-uppercase">Data do evento</label>
        <input class="form-control" type="date" name="date">
        </div>
        <div class="mb-3">
        <label class="form-label text-uppercase">Cidade</label>
        <input class="form-control" type="text" name="city">
        </div>
        <div class="mb-3">
        <label class="form-label text-uppercase">estado</label>
        <input class="form-control" type="text" name="state">
        </div>
        <div class="mb-3">
        <select class="form-select" name="status">
          <option selected>Status do evento</option>
          <option value="Planejamento">Planejamento</option>
          <option value="Produção Fábrica">Produção Fábrica</option>
          <option value="Produção Local">Produção Local</option>
          <option value="Entregue">Entregue</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">
        Enviar
        </button>
      </form>
      </div>
    </div>
    </div>
  </div>


@endsection