<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;

//ENDPOINT
Route::get('/', function () {
    return view('welcome');
});


    Route::group(['prefix'=>'dashboard'],function(){

    Route::resource('/',DashboardController::class);
    

    RoutE::get("/users",[UsersController::class,'getUsers']);
    RoutE::post("/users",[UsersController::class,'createUsers']);


});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
