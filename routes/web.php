<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

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

Route::post('/update-item-importance', function (Request $request) {
    $validated = $request->validate([
        'item_id' => 'required|numeric', // Должен быть числом
        'new_zone' => 'required|in:zone-1,zone-2,zone-3,zone-0' // Должен быть одной из 4 зон
    ]);
    switch  ($validated['new_zone']) {
        case 'zone-0':
            DB::table('tasks')->where('id', $validated['item_id'])
            ->update(['importance' => 0]);break;
        case 'zone-1':
            DB::table('tasks') ->where('id', $validated['item_id'])
            ->update(['importance' => 1]);   break;
        case 'zone-2':
            DB::table('tasks') ->where('id', $validated['item_id'])
            ->update(['importance' => 2]);  break;
        case 'zone-3':
            DB::table('tasks') ->where('id', $validated['item_id'])
            ->update(['importance' => 3]);   break; 
    }
});
