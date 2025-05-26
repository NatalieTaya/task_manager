<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

Route::get('/', function () {
    return view('welcome', [
        'tasks_0' => Task::all()->where('importance',0),
        'tasks_1' => Task::all()->where('importance',1),
        'tasks_2' => Task::all()->where('importance',2),
        'tasks_3' => Task::all()->where('importance',3),
    ]);
})->name('tasks.index');

Route::get('/finished_tasks', function () {
    return view('finished', ['tasks' => Task::all()->where('is_completed',true)]);
})->name('tasks.finished');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task]
    );
})->name('tasks.show');

Route::post('/update-item-importance', function (Request $request) {
    $validated = $request->validate([
        'item_id' => 'required|numeric', // Должен быть числом
        'new_zone' => 'required|in:zone-1,zone-2,zone-3,zone-0' // Должен быть одной из 4 зон
    ]);
    //dd($validated['new_zone']);

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