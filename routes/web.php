<?php
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SiteController;


// // Bosh sahifa
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/login',[SiteController::class, 'login'])->name('login');
//     Route::get('/registar',[SiteController::class, 'register'])->name('register');
//     Route::get('/task-create',[SiteController::class, 'task-create'])->name('task-create');
//     Route::get('/task-edit',[SiteController::class, 'task-edit'])->name('task-edit');
//     Route::get('/tasks',[SiteController::class, 'tasks'])->name('tasks'); 


use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('auth.register');
})->name('auth.register');


Route::get('logout',[AuthController::class,'logout'])->name('logout');


Route::middleware(['guest'])->group(function () {
    Route::post('login', [AuthController::class, 'loginStore'])->name('login.store');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::resource('users', AuthController::class)->names('users');   
    
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', SiteController::class)->names('tasks');
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
  
});