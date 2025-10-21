<?php

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

// Esta es la ruta principal. Ahora muestra la vista 'about'.
Route::get('/', function () {
    return view('about');
});

// Rutas de autenticación que vienen con Laravel (login, register, etc.)
Auth::routes();

// Ruta para el dashboard una vez que el usuario inicia sesión.
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');