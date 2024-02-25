<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\FunkoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('funkos.index');
});

Route::group(['prefix' => 'funkos'], function () {
    Route::get('/', [FunkoController::class, 'index'])->name('funkos.index');
    Route::get('/{id}', [FunkoController::class,'show'])->name('funkos.show');
    Route::get('/create', [FunkoController::class,'create'])->name('funkos.create');
    Route::post('/', [FunkoController::class,'store'])->name('funkos.store');
    Route::get('/{id}/edit', [FunkoController::class, 'edit'])->name('funkos.edit');
    Route::put('/{id}', [FunkoController::class, 'update'])->name('funkos.update');
    Route::delete('/{id}', [FunkoController::class, 'destroy'])->name('funkos.destroy');
    Route::get('/{id}/edit-image', [FunkoController::class, 'editImage'])->name('funkos.editImage');
    Route::patch('/{id}/edit-image', [FunkoController::class, 'updateImage'])->name('funkos.updateImage');
});





Route::group(['prefix' => 'categorias'], function () {
    Route::get('/', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/{id}', [CategoriasController::class,'show'])->name('categorias.show');
    Route::get('/create', [CategoriasController::class,'create'])->name('categorias.create');
    Route::post('/', [CategoriasController::class,'store'])->name('categorias.store');
    Route::get('/{id}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::put('/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
});
