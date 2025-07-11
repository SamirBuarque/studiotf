@extends('layouts.app')

@section('title', 'Detalhes do Evento')

@section('content')

  <div class="text-center mt-3">

    <div class="row">
    <div class="d-flex align-items-center justify-content-center col-12 text-uppercase gap-3">
      <h1>{{$event->city}}</h1>
      <div id="event-status-root" data-event-id="{{ $event->id}}"></div>
    </div>

    <!-- Modal #confirmDeleteModal -->
    <div class="modal fade" id="confirmDeleteModal-{{ $event->id }}" tabindex="-1"
      aria-labelledby="confirmDeleteLabel-{{ $event->id }}" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content text-black">
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
      <div class="card-body">
        <div>
        <ul class="list-group text-start">
          @foreach($files as $file)
        <li class="list-group-item d-flex align-items-center justify-content-between">
        <span>{{$file->original_name}}</span>
        <div>
        <a href="{{ route('file.view', ['eventRecord' => $event, 'fileId' => $file->id])}}"
        class="btn btn-sm btn-outline-success">Visualizar</a>
        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
        data-bs-target="#deleteFileModal-{{ $file->id }}">
        Excluir
        </button>
        </div>
        </li>

        <!-- Modal de Confirmação -->
        <div class="modal fade" id="deleteFileModal-{{ $file->id }}" tabindex="-1"
        aria-labelledby="deleteFileModalLabel-{{ $file->id }}" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteFileModalLabel-{{ $file->id }}">
          Confirmar Exclusão
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluir o arquivo <strong>{{ $file->original_name }}</strong>?
          <br><small>Esta ação não pode ser desfeita.</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form action="{{ route('file.destroy', ['eventRecord' => $event, 'file' => $file]) }}"
          method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
          </form>
        </div>
        </div>
        </div>
        </div>
      @endforeach
        </ul>
        </div>
        <form action="{{ route('file.upload', ['eventRecord' => $event]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="file" class="form-label">Selecione o arquivo:</label>
          <input type="file" name="file" id="file" class="form-control" required>
          <div class="form-text">Formatos aceitos: JPG, PNG, PDF, DOC, DOCX (até 5MB)</div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
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

    <div class="row d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="card">
      <div class="card-title">
        <h2>Produção Local</h2>
      </div>
      <div class="card-body">
        <div id="prodLocal-root" data-event-id="{{ $event->id}}"></div>
      </div>
      </div>
    </div>
    </div>

    <div class="row my-5 d-flex justify-content-center">
    <div class="col-6 d-flex justify-content-center gap-4">
      <button type="submit" class="btn btn-lg btn-danger" data-bs-toggle="modal"
      data-bs-target="#confirmDeleteModal-{{ $event->id }}">Excluir evento</button>
      <a href="{{ route('event.edit', ['eventRecord' => $event]) }}" class="btn btn-lg btn-warning">
        <div class="d-flex align-items-center gap-3">
          <i class="fa-solid fa-pen-to-square"></i><span>Editar Dados do Evento</span>
        </div>
      </a>
    </div>
    </div>

  </div>

@endsection