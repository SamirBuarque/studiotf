@extends('layouts.app')

@section('title', 'Trabalhador')

@section('content')

  <div class="row d-flex align-items-center justify-content-center my-4">

    <div class="col-8">
    <div class="d-flex align-items-center justify-content-center">
      @if (session('success'))
      <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    </div>
    <ul class="list-group">
      @foreach($workers as $worker)
      <li class="list-group-item d-flex justify-content-between align-items-center py-3">
      <div class="">
      <strong>{{$worker->eventRecord?->name ?? 'Sem evento vinculado'}}</strong> -
      {{$worker->name}} -
      {{$worker?->birth_date?->format("d/m/Y") ?? '00/00/0000'}} -
      {{$worker?->position ?? 'Sem função cadastrada'}}
      </div>
      <div class="d-flex align-items-center justify-content-center gap-3">
      <a href="{{ route('worker.edit', ['worker' => $worker]) }}" class="btn btn-secondary"><i
        class="fa-solid fa-pen-to-square"></i></a>
      
      <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
        data-bs-target="#confirmDeleteModal">
        <i class="fa-solid fa-trash"></i></button>
      
      </div>
      </li>
    @endforeach
    </ul>

    <!-- Modal #confirmDeleteModal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
      aria-labelledby="confirmDeleteLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content text-black">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="confirmDeleteLabel">Confirmar Exclusão</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
        Tem certeza que deseja excluir este trabalhador?
        </div>
        <div class="modal-footer">
        <form action="{{ route('worker.delete', ['worker' => $worker]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
        </form>
        </div>
      </div>
      </div>
    </div>

    <div class="mt-3 d-flex justify-content-end">
      <a href="{{ route('worker.create')}}" class="btn btn-primary">Adicionar</a>
    </div>
    </div>

  </div>


@endsection