@php use App\Models\Categoria; @endphp
@extends('main')

@section('title', 'Categorias CRUD')

@section('content')
    <h1>Listado de Categorias</h1>

    <form action="{{ route('categorias.index') }}" class="mb-3" method="get">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="Nombre">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('categorias.show', $categoria->id) }}">Detalles</a>
                        @auth()
                            @if(auth()->user()->role == 'admin')
                                <a class="btn btn-secondary btn-sm"
                                   href="{{ route('categorias.edit', $categoria->id) }}">Editar</a>
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que deseas borrar esta categoria?')">Borrar
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @auth()
        @if(auth()->user()->role == 'admin')
    <a class="btn btn-success" href="{{ route('categorias.create') }}">Nueva Categoria</a>
        @endif
    @endauth
@endsection
