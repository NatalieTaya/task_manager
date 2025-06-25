<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(Request $request)
    {

        /** @var \App\Models\User $user */        
        $user = Auth::user();
        $tasks = $user->tasks()->get()->groupBy('importance');

        return view('tasks.index', [
            'tasks_0' => $tasks->get(0, collect()),
            'tasks_1' => $tasks->get(1, collect()),
            'tasks_2' => $tasks->get(2, collect()),
            'tasks_3' => $tasks->get(3, collect()),
        ]);
    }


    public function create()
    {
        return view('tasks.create'); // Форма создания
    }


    public function store(Request $request)
    {
        $validated = $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'importance' =>'required'
        ]);
        /** @var \App\Models\User $user */        
        $user = Auth::user();
        $task = $user->tasks()->create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }


    public function show(string $id)
    {
        /** @var \App\Models\User $user */        
        $user = Auth::user();
        $task = $user->tasks()->findOrFail($id);

        //$task=Task::findOrFail($id);
        return view('tasks.show', [
                'task' => $task]
            );
    }

    public function edit(string $id)
    {
        return view('tasks.edit'); // Форма создания

    }


    public function update(Request $request, string $id)
    {
        /** @var \App\Models\User $user */        
        $user = Auth::user();
        $task = $user->tasks()->where('id',$id)->first();
        //$task=Task::findOrFail($id);
        $validated = $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'importance' =>'required'
        ]);
        $task -> update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated!');

    }


    public function destroy(string $id)
    {
        /** @var \App\Models\User $user */        
        $user = Auth::user();
        $task = $user->tasks()->where('id',$id)->first();
        //$task = Task::findOrFail($id);
        $task -> delete();
        return redirect()->route( 'tasks.index')->with('success',"Task deleted");
    }
    public function finished(Request $request)
    {
        /** @var \App\Models\User $user */        
        $user = Auth::user();
        $tasks = $user->tasks()->where('is_completed', true)->get();
        return view( 'tasks.finished', ['tasks'=>$tasks]);
    }
    public function current(Request $request)
    {
        /** @var \App\Models\User $user */        
        $user = Auth::user();
        $tasks = $user->tasks()->where('is_completed', false)->get();
        return view( 'tasks.finished', ['tasks'=>$tasks]);
    }
    public function updateItemImportance(Request $request)
    {
        $validated = $request->validate([
        'item_id' => 'required|numeric',
        'new_zone' => 'required|in:zone-1,zone-2,zone-3,zone-0'
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

        return response()->json(['success' => true]);
    }
}
