<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/categorias', App\Http\Controllers\CategoriaController::class);
Route::get('/listar-categorias', [App\Http\Controllers\CategoriaController::class, 'listarCategoria']);

Route::resource('/galeria', App\Http\Controllers\GaleriaController::class);
Route::get('/listar-imagenes', [App\Http\Controllers\GaleriaController::class, 'listarImagenes']);
Route::post('/update-imagenes/{id}', [App\Http\Controllers\GaleriaController::class, 'updateImagenes']);


