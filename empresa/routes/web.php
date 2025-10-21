<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DispositivosController;
use App\Http\Controllers\AsignacionesController;

// Esta es la ruta principal. Ahora muestra la vista 'about'.
Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    RoutE::get("/users",[UsersController::class,'getUsers']);
    RoutE::post("/users",[UsersController::class,'createUsers']);

    // Rutas para Dispositivos
    Route::get('/dispositivos', [DispositivosController::class, 'index'])->name('dispositivos.index');
    Route::get('/dispositivos/create', [DispositivosController::class, 'create'])->name('dispositivos.create');
    Route::post('/dispositivos', [DispositivosController::class, 'store'])->name('dispositivos.store');

    // Rutas para Asignaciones
    Route::get('/asignaciones', [AsignacionesController::class, 'index'])->name('asignaciones.index');
    Route::get('/asignaciones/create', [AsignacionesController::class, 'create'])->name('asignaciones.create');
    Route::post('/asignaciones', [AsignacionesController::class, 'store'])->name('asignaciones.store');
    Route::get('/asignaciones/{asignacion}/pdf', [AsignacionesController::class, 'generarPdf'])->name('asignaciones.pdf');
    Route::post('/asignaciones/{asignacion}/devolver', [AsignacionesController::class, 'devolver'])->name('asignaciones.devolver');

});




// Rutas de autenticación que vienen con Laravel (login, register, etc.)
Auth::routes();
// Ruta para el dashboard una vez que el usuario inicia sesión.
Route::get('/home', function() {
    return redirect('/dashboard');
})->name('home');