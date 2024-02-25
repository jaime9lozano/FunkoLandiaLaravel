@php use App\Models\Funko; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Detalles Funko')

{{-- Agregamos el contenido de la página --}}
@section('content')

    {{-- Agregamos el contenido de la página --}}

    <h1>Detalles del Funko</h1>
    <dl class="row">
        <dt class="col-sm-2">ID:</dt>
        <dd class="col-sm-10">{{ $funko->id }}</dd>
        <dt class="col-sm-2">Nombre:</dt>
        <dd class="col-sm-10">{{ $funko->marca }}</dd>
        <dt class="col-sm-2">Precio:</dt>
        <dd class="col-sm-10">{{ $funko->precio }}</dd>
        <dt class="col-sm-2">Imagen:</dt>
        <dd class="col-sm-10">
            @if($funko->imagen != Funko::$IMAGE_DEFAULT)
                <img alt="Imagen del funko" class="img-fluid" src="{{ asset('storage/' . $funko->imagen) }}">
            @else
                <img alt="Imagen por defecto" class="img-fluid" src="{{ Funko::$IMAGE_DEFAULT }}">
            @endif
        </dd>
        <dt class="col-sm-2">Stock:</dt>
        <dd class="col-sm-10">{{ $funko->stock }}</dd>
        <dt class="col-sm-2">Categoría:</dt>
        <dd class="col-sm-10">{{ $funko->categoria->nombre }}</dd>
    </dl>


    <a class="btn btn-primary" href="{{ route('funkos.index') }}">Volver</a>

@endsection
