@extends('layouts.app')

@section('title', 'Home')

@section('content')

  <div class="container mt-4">
    
    <div class="row mb-3 d-flex justify-content-center align-items-center">
@foreach($events as $event)
    <div class="col-8 mb-4 event-card">
      <div class="card w-100">
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
    </div>
@endforeach
    </div>
    
  </div>

@endsection