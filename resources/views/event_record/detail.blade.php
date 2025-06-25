
@extends('layouts.app')

@section('title', 'Detalhes do Evento')

@section('content')

<div class="text-center mt-3">
  
  <div class="row">
    <div class="d-flex align-items-center justify-content-center col-12 text-uppercase">
      <h1>{{$event->city}}</h1>
      <span class="ms-4 text-bold">{{$event->status}}</span>
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
        <div class="card-title"><h2>Documentos</h2></div>
        <div class="card-body">Anexar documentos</div>
      </div>
    </div>
  </div>

  <div class="row d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="card">
        <div class="card-title"><h2>Planejamento</h2></div>
        <div class="card-body">
          <div id="plannings-root" data-event-id="{{ $event->id}}"></div>
        </div>
      </div>
    </div>
  </div>
  
</div>

@endsection