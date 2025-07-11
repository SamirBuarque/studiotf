@extends('layouts.app')

@section('title', 'Home')

@section('content')

  <div class="container mt-4">
    <div class="row d-flex justify-content-center align-items-center mb-3">
    <div class="col-6">
      @if (session('success'))
        <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('success') }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
    </div>

    <div class="row mb-3 d-flex justify-content-center align-items-center">
    @foreach($events as $event)

    <div class="col-8 mb-4">
      <a class="unstyled-link" href="{{route('detail', $event->id)}}">
      <div class="card w-100 card-hover">
      <div class="card-body">
      <div class="card-title d-flex align-items-center justify-content-center">
        <h2>{{$event->city}}</h2>
        <span class="ms-5">
        {{$event->status}}
        </span>
      </div>
      <div class="card-subtitle text-center">
        <h5>{{$event->name}} | Data do evento: {{$event->date->format('d/m/Y')}}</h5>

      </div>
      </div>
      </div>
      </a>
    </div>

    @endforeach
    </div>

    <div class="row">
    <div class="col-12">
      <a href="{{route('event.create')}}"
      class="btn btn-lg btn-primary position-fixed bottom-0 end-0 m-4 rounded-pill shadow">Adicionar evento</a>
    </div>
    </div>

  </div>

@endsection