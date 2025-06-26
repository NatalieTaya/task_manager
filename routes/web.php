<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

Route::get('/', function() {
    return Auth::check() 
        ? redirect('/tasks')
        : view('welcome');
});


// routes for login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/', [LoginController::class, 'logout'])->name('logout');
// routes for register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


//routes for task logic
Route::resource('tasks',TaskController::class);
Route::get('/finished_tasks', [TaskController::class, 'finished'])
     ->name('tasks.finished');
Route::get('/current_tasks', [TaskController::class, 'current'])
     ->name('tasks.current');


Route::post('/update-item-importance', [TaskController::class, 'updateItemImportance'])
     ->name('tasks.update-importance');
     

