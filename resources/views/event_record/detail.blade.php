@extends('layouts.app')

@section('title', 'Detalhes do Evento')

@section('content')

  <div class="text-center mt-3">

    <div class="row">
    <div class="d-flex align-items-center justify-content-center col-12 text-uppercase gap-3">
      <h1>{{$event->city}}</h1>
      <span class="text-bold">{{$event->status}}</span>
      <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#confirmDeleteModal-{{ $event->id }}">Remover</button>
    </div>

    <!-- Modal #confirmDeleteModal -->
    <div class="modal fade" id="confirmDeleteModal-{{ $event->id }}" tabindex="-1"
      aria-labelledby="confirmDeleteLabel-{{ $event->id }}" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="confirmDeleteLabel-{{ $event->id }}">Confirmar Exclusão</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
        Tem certeza que deseja excluir o evento <strong>{{ $event->name }}</strong>?
        </div>
        <div class="modal-footer">
        <form action="{{ route('event.destroy', $event->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
        </form>
        </div>
      </div>
      </div>
    </div>

    </div>
    <div class="row">
    <div class="col-12 text-uppercase">
      <h3>{{$event->name}}</h3>
    </div>
    </div>

    <div class="row d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="card">
      <div class="card-title">
        <h2>Documentos</h2>
      </div>
      <div class="card-body">Anexar documentos</div>
      </div>
    </div>
    </div>

    <div class="row d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="card">
      <div class="card-title">
        <h2>Planejamento</h2>
      </div>
      <div class="card-body">
        <div id="plannings-root" data-event-id="{{ $event->id}}"></div>
      </div>
      </div>
    </div>
    </div>

    <div class="row d-flex justify-content-center mt-5">
      <div class="col-6">
        <div class="card">
        <div class="card-title">
          <h2>Produtos</h2>
        </div>
        <div class="card-body">
          <div id="products-root" data-event-id="{{ $event->id}}"></div>
        </div>
        </div>
      </div>
    </div>

  </div>

@endsection