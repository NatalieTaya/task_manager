<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $tasks = Task::when($id, 
            fn($query,$id) => $query->id($id))
            ->get();
        return view('tasks.index', [
            'tasks_0' => Task::where('importance',0)->get(),
            'tasks_1' => Task::where('importance',1)->get(),
            'tasks_2' => Task::where('importance',2)->get(),
            'tasks_3' => Task::where('importance',3)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create'); // Форма создания
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'importance' =>'required'
        ]);

        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task=Task::findOrFail($id);
        return view('tasks.show', [
                'task' => $task]
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('tasks.edit'); // Форма создания

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task=Task::findOrFail($id);
        $validated = $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'importance' =>'required'
        ]);
        $task -> update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task -> delete();
        return redirect()->route( 'tasks.index')->with('success',"Task deleted");
    }
    public function finished(Request $request)
    {
        $tasks = Task::where('is_completed', true)->get();
        return view( 'tasks.finished', ['tasks'=>$tasks]);
    }
    public function current(Request $request)
    {
        $tasks = Task::where('is_completed', false)->get();
        return view( 'tasks.finished', ['tasks'=>$tasks]);
    }
}
