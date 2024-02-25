<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(Request $request){
        $categorias = Categoria::all();
        return view('categorias.index')->with('categorias', $categorias);
    }
    public function show($id){
        $categoria = Categoria::find($id);
        return view('categorias.show')->with('categoria', $categoria);
    }
    public function create()
    {
        return view('categorias.create');
    }
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'min:4|max:120|required',
        ]);
        try {
            // Creamos el producto
            $categoria = new Categoria($request->all());
            // salvamos el producto
            $categoria->save();
            // Devolvemos el producto creado
            return redirect()->route('categorias.index');
        } catch (Exception $e) {
            return redirect()->route('categorias.index'); // volvemos a la anterior
        }
    }

    public function edit($id)
    {
        // Buscamos el producto por su id
        $categoria = Categoria::find($id);
        // Devolvemos el producto
        return view('categorias.edit')
            ->with('categoria', $categoria);
    }

    public function update(Request $request, $id){

        $request->validate([
            'nombre' => 'min:4|max:120|required',
        ]);
        try {
            // Buscamos el producto por su id
            $categoria = Categoria::find($id);
            // Actualizamos el producto
            $categoria->update($request->all());
            // salvamos el producto
            $categoria->save();
            // Devolvemos el producto actualizado
            return redirect()->route('categorias.index'); // Volvemos a la vista de productos
        } catch (Exception $e) {
            return redirect()->back(); // volvemos a la anterior
        }
    }
    public function destroy($id){
        try {
            // Buscamos el producto por su id
            $categoria = Categoria::find($id);
            // salvamos el producto
            $categoria->delete();
            return redirect()->route('categorias.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}
