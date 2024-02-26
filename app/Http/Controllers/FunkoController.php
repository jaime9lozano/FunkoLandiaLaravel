<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Funko;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FunkoController extends Controller
{
    public function index(Request $request){
        $funkos = Funko::all();
        return view('funkos.index')->with('funkos', $funkos);
    }

    public function show($id)
    {
        $funko = Funko::find($id);
        return view('funkos.show')->with('funko', $funko);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('funkos.create')->with('categorias', $categorias);
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'min:4|max:120|required',
            'precio' => 'required|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'stock' => 'required|integer',
            'categoria' => 'required|exists:categorias,id', // Asegúrate de que la columna 'id' sea la correcta en value del formulario (autovalida que exista en la tabla categorias)
        ]);
        try {
            // Creamos el producto
            $funko = new Funko($request->all());
            // Asignamos la categoría
            $funko->categoria_id = $request->categoria;
            // salvamos el producto
            $funko->save();
            // Devolvemos el producto creado
            return redirect()->route('funkos.index'); // Volvemos a la vista de productos
        } catch (Exception $e) {
            return redirect()->back(); // volvemos a la anterior
        }
    }

    public function edit($id)
    {
        // Buscamos el producto por su id
        $funko = Funko::find($id);
        // Buscamos las categorias
        $categorias = Categoria::all();
        // Devolvemos el producto
        return view('funkos.edit')
            ->with('funko', $funko)
            ->with('categorias', $categorias);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'min:4|max:120|required',
            'precio' => 'required|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'stock' => 'required|integer',
            'categoria' => 'required|exists:categorias,id',
        ]);
        try {
            // Buscamos el producto por su id
            $funko = Funko::find($id);
            // Actualizamos el producto
            $funko->update($request->all());
            // Asignamos la categoría
            $funko->categoria_id = $request->categoria;
            // salvamos el producto
            $funko->save();
            return redirect()->route('funkos.index');
        } catch (Exception $e) {
            return redirect()->back(); // volvemos a la anterior
        }
    }

    public function editImage($id)
    {
        // Buscamos el producto por su id
        $funko = Funko::find($id);
        // Devolvemos el producto
        return view('funkos.image')->with('funko', $funko);
    }

    public function updateImage(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            // Buscamos el producto por su id
            $funko = Funko::find($id);
            // Aquí hay que hacer lo de la imagen
            if ($funko->imagen != Funko::$IMAGE_DEFAULT && Storage::exists($funko->imagen)) {
                // Eliminamos la imagen
                Storage::delete($funko->imagen);
            }
            // Guardamos la imagen
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $fileToSave = $funko->nombre . '.' . $extension;
            $funko->imagen = $imagen->storeAs('funkos', $fileToSave, 'public');
            // salvamos el producto
            $funko->save();
            return redirect()->route('funkos.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            // Buscamos el producto por su id
            $funko = Funko::find($id);
            // Aquí hay que hacer lo de la imagen
            if ($funko->imagen != Funko::$IMAGE_DEFAULT && Storage::exists($funko->imagen)) {
                // Eliminamos la imagen
                Storage::delete($funko->imagen);
            }
            // salvamos el producto
            $funko->delete();
            return redirect()->route('funkos.index'); // Volvemos a la vista de productos
        } catch (Exception $e) {
            return redirect()->back(); // volvemos a la anterior
        }
    }
}
