<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Project;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        $users = User::all();
        $projects = Project::all();
        $categorys = Category::all();


        // $task_p=$tasks->project->name;
        // $task_c=$tasks->category()->name;

        return view('task.index', compact('users', 'tasks', 'projects', 'categorys'));
    }

    public function startTask(Task $task)
    {
        dd($task);
        $task->start_time = Carbon::now();
    }
    public function endTask(Task $task)
    {
        $task->end_time = Carbon::now();
    }

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
    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'estimate_time' => 'required',
            'active' => 'required'
        ]);


        $task = new Task;
        $task->name = $request->name;
        $task->start_time = $request->start_time;
        $task->end_time = $request->end_time;
        $task->estimate_time = $request->estimate_time;
        $task->active = $request->active;

        $task->save();

        $task->users()->sync($request->user_id);
        $task->projects()->sync($request->project_id);
        $task->categorys()->sync($request->category_id);

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $clients = Client::all();

        return view('task.show', compact('task', 'clients'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projects = Project::all();
        $categorys = Category::all();
        $users = User::all();

        $task = Task::find($id);

        return view('task.edit', compact('task', 'projects', 'categorys', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'estimate_time' => 'required',
            'active' => 'required',
        ]);

        $task = Task::find($id);
        $task->name = $request->name;
        $task->start_time = $request->start_time;
        $task->end_time = $request->end_time;
        $task->estimate_time = $request->estimate_time;
        $task->active = $request->active;


        $task->save();

        if ($request->user_id != null) {
            $task->users()->detach($request->user_id);
            $task->users()->sync($request->user_id);
        }
        if ($request->category_id != null) {
            $task->categorys()->detach($request->category_id);
            $task->categorys()->sync($request->category_id);
        }
        if ($request->project_id != null) {
            $task->projects()->detach($request->project_id);
            $task->projects()->sync($request->project_id);
        }


        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete($id);

        return redirect()->back();
    }
}
