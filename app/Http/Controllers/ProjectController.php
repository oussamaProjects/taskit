<?php

namespace App\Http\Controllers;

use App\Client;
use App\Department;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProjectController extends Controller
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $projects = Project::all();
        $departments = Department::all();


        return view('project.index', compact('projects', 'clients', 'departments'));
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
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'estimate_time' => 'required',
            'estimate_value' => 'required',
            'client_id' => 'required',

        ]);


        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'estimate_time' => $request->estimate_time,
            'estimate_value' => $request->estimate_value,
            'client_id' => $request->client_id,
            'color' => $request->color
        ]);
        $project->departments()->sync($request->department);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $clients = Client::all();
        $departments = Department::all();
        $project->departments()->get();


        return view('project.show', compact('project', 'clients', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::all();
        $departments = Department::all();
        $project = Project::where('id', $id)->first();

        return view('project.edit', compact('project', 'clients', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'client_id' => 'required'
        ]);

        $project->name = $request->name;
        $project->description = $request->description;
        $project->estimate_time = $request->estimate_time;
        $project->estimate_value = $request->estimate_value;
        $project->color = $request->color;
        $project->client_id = $request->client_id;

        if($request->department != null){
            $project->departments()->detach($request->department);
            $project->departments()->sync($request->department);
        }
        
        $project->save();
       

        return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete($id);

        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function tasks(Int $id)
    {

        $project = Project::find($id);
        $clients = Client::all();

        return view('project.project.tasks', compact('project', 'clients'));
    }
   
    // public function edit_department($id)
    // {
    //     $user = $this->chart->pieChart()
    //         ->setTitle('Top 3 scorers of the team.')
    //         ->setSubtitle('Season 2021.')
    //         ->addData([20000, 24000, 30000])
    //         ->setLabels(['Player 7', 'Player 10', 'Player 9']);

    //     return view('project.project.edit', compact('user'));
    // }
}
