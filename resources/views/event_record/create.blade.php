@extends('layouts.app')

@section('title', 'Criar Evento')

@section('content')

  <div class="row d-flex justify-content-center align-items-center mb-3">
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
        <input class="form-control" type="text" name="name" required>
        </div>
        <div class="mb-3">
        <label class="form-label text-uppercase">Data do evento</label>
        <input class="form-control" type="date" name="date" required>
        </div>

        <div class="mb-3">
          <label for="state" class="form-label text-uppercase">Estado</label>
          <select name="state" id="state" class="form-select" required>
            <option value="">Selecione um estado</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="city" class="form-label text-uppercase">Cidade</label>
          <select name="city" id="city" class="form-select" disabled required>
            <option value="">Selecione uma cidade</option>
          </select>
        </div>

        <div class="mb-3">
        <label class="form-label text-uppercase">Status do evento</label>
        <select class="form-select" name="status" required>
          <option value="" selected>Selecione um status</option>
          <option value="Planejamento">Planejamento</option>
          <option value="Produção Fábrica">Produção Fábrica</option>
          <option value="Produção Local">Produção Local</option>
          <option value="Entrega">Entrega</option>
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

  <script srt></script>

@endsection