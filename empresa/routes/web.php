<?php
//modifcare










use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
//ENDPOINT
Route::get('/', function () {
    return view('welcome');
});
RoutE::get("/contact", function(){ 
    return view('contact');
});
RoutE::get("/post", function(){ 
    return view('post');
});
RoutE::get("/about", function(){ 
    return view('about');
});

    Route::group(['prefix'=>'dashboard'],function(){

    Route::resource('/',DashboardController::class);
    Route::resource('/posts',PostController::class);
    Route::get('/posts/actions/add',[PostController::class, 'showAdd']);

    RoutE::get("/users",[UsersController::class,'getUsers']);
    RoutE::post("/users",[UsersController::class,'createUsers']);


});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
