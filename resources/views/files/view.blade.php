@extends('layouts.app')

@section('title', 'Visualizar arquivo')
@section('content')

  <div class="row d-flex align-items-center justify-content-center">
    <div class="mt-3">
    @if(Str::startsWith($file->mime_type, 'image/'))
    <img src="{{ $url }}" alt="{{ $file->original_name }}" class="img-fluid">
    @elseif($file->mime_type === 'application/pdf')
    <embed src="{{ $url }}" type="application/pdf" width="100%" height="600px">
    @else
    <div class="alert alert-info">
      <p>Este tipo de arquivo não pode ser visualizado no navegador.</p>
      <a href="{{ route('files.download', $file->id) }}" class="btn btn-primary">
      Download do Arquivo
      </a>
    </div>
    @endif
    </div>
  </div>

@endsection