@php use App\Models\Categoria; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Detalles Categoria')
@section('content')
    <h1>Detalles del Categoria</h1>
    <dl class="row">
        <dt class="col-sm-2">ID:</dt>
        <dd class="col-sm-10">{{ $categoria->id }}</dd>
        <dt class="col-sm-2">Nombre:</dt>
        <dd class="col-sm-10">{{ $categoria->nombre }}</dd>
    </dl>

    <a class="btn btn-primary" href="{{ route('categorias.index') }}">Volver</a>
@endsection
