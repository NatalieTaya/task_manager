<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
