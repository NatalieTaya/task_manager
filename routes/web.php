<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome', [
        'tasks_0' => Task::where('importance',0)->get(),
        'tasks_1' => Task::where('importance',1)->get(),
        'tasks_2' => Task::where('importance',2)->get(),
        'tasks_3' => Task::where('importance',3)->get(),
    ]);
})->name('tasks.index');

Route::get('/finished_tasks', function () {
    return view('finished', ['tasks' => Task::all()->where('is_completed',true)]);
})->name('tasks.finished');

Route::get('/create', function () {
    return view('create');
})->name('tasks.create');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task]
    );
})->name('tasks.show');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task]
    );
})->name('tasks.edit');

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

Route::post('/create', function(TaskRequest $request){
    // $data=$request->validated();
    // $task = new Task;
    // $task->title=$data['title'];
    // $task->description=$data['description'];
    // $task->importance=$data['importance'];
    // $task->save();

    $task=Task::create($request->validated());
    return redirect()->route('tasks.index')->with('success',"New task created");
})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){
    // $data=$request->validated();
    // $task->title=$data['title'];
    // $task->description=$data['description'];
    // $task->importance=$data['importance'];
    // $task->save();
    $task -> update($request->validated());
    return redirect()->route('tasks.index')->with('success',"Task updated");
})->name('tasks.update');

Route::delete('/tasks/{task}', function(Task $task){
    $task -> delete();
    return redirect()->route(route: 'tasks.index')->with('success',"Task deleted");
})->name('tasks.destroy');