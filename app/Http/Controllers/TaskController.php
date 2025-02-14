<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $tasks = $user->tasks()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->filled('date'), function ($query) use ($request) {
                $query->whereDate('date', Carbon::parse($request->date)->startOfDay());
            })
            ->get();

        return view('task', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        Task::create([
            'name'        => $request->name,
            'date'        => $request->date,
            'time'        => $request->time,
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);
        return redirect()->route('task.index')->with('success','Task Berhasil Ditambahkan');
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, Task $task):RedirectResponse
    {
        $task->update($request->validated());

        return redirect()
            ->route('task.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
      
        $task->delete();
        return redirect()->route('task.index');
    }
}
