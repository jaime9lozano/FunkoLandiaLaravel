@php use App\Models\Funko; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Funkos CRUD')

{{-- Agregamos el contenido de la página --}}
@section('content')
    <h1>Listado de Funkos</h1>

    {{-- Agregamos el contenido de la página --}}

    <form action="{{ route('funkos.index') }}" class="mb-3" method="get">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="Nombre">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    {{-- Si hay registros --}}
    @if (count($funkos) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            {{-- Por cada producto --}}
            @foreach ($funkos as $funko)
                <tr>
                    <td>{{ $funko->id }}</td>
                    <td>{{ $funko->nombre }}</td>
                    <td>{{ $funko->precio }}</td>
                    <td>{{ $funko->stock }}</td>
                    <td>
                        @if($funko->imagen != Funko::$IMAGE_DEFAULT)
                            <img height="50" src="{{ asset('storage/app/public/funkos' . $funko->imagen) }}"
                                 width="50">
                        @else
                            <img alt="Imagen por defecto" height="50" src="{{ Funko::$IMAGE_DEFAULT }}"
                                 width="50">
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('funkos.show', $funko->id) }}">Detalles</a>
                        @auth()
                            @if(auth()->user()->role == 'admin')
                                <a class="btn btn-secondary btn-sm"
                                   href="{{ route('funkos.edit', $funko->id) }}">Editar</a>
                                <a class="btn btn-info  btn-sm"
                                   href="{{ route('funkos.editImage', $funko->id) }}">Imagen</a>
                                <form action="{{ route('funkos.destroy', $funko->id) }}" method="POST"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que deseas borrar este funko?')">Borrar
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <p class='lead'><em>No se ha encontrado datos de funkos.</em></p>
    @endif

    @auth()
        @if(auth()->user()->role == 'admin')
            <a class="btn btn-success" href="{{ route('funkos.create') }}">Nuevo Funko</a>
        @endif
    @endauth

@endsection
