<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart;
use App\Client;
use Illuminate\Http\Request;
use App\User;
// for displaying data
use App\Department;
use App\Group;
use App\Log;
use App\Subsidiary;
use App\Task;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// for assigning roles
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{ 
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  // public function __construct()
  // {
  //   return $this->middleware(['auth','permission:manage']);
  //   $this->middleware(['auth','admin']);
  // }
 

  public function index()
  {
    // $users = User::where('status',true)->get();
    if (auth()->user()->hasRole('Root')) {
      $users = User::where('status', true)->get();
    } elseif (auth()->user()->hasRole('Admin')) {
      $d = auth()->user()->department_id;
      $users = User::where('status', true)->where('department_id', $d)->where('id', '!=', auth()->user()->id)->get();
    } else {
      $users = User::where('status', true)->get();
    }
    // get all dept
    $depts = Department::all();
    //get task all
    $tasks = Task::all();
    //Group
    $groups = Group::all();
    $user = new User;

    // get roles
    if (auth()->user()->hasRole('Root')) {
      $roles = Role::where('name', '!=', 'Root')->get();
    } else {
      $roles = Role::where('name', '!=', 'Root')->where('name', '!=', 'Admin')->get();
    }
    // dd($roles);
    return view('users.index', compact('users', 'depts', 'roles', 'groups', 'tasks'));
  }

  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
    $user=User::find($id);
    dd($user);
    $user->tasks()->get();

    // return view('users.home', [
    //   'chartPie' => $chart->buildPie(),
    //   'chartLine' => $chart->buildLine(),
    //   'chartBar' => $chart->buildBar($user->id),
    //   'chartH_bar' => $chart->horizontalBar(),
    //   'donutChart' =>$chart->donutChart(),
    //   'user' => $user
    // ]);
    
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
      'email' => 'required',
      'password' => 'required',
    ]);

    // $user = User::create($request->only('name','email','password','department_id'));
    $user = new User;
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = $request->input('password');
    $user->status = true;


    $user->save();

    $group = $user->groups()->sync($request->group_id);
    $department = $user->departments()->sync($request->department_id);
    $task = $user->tasks()->sync($request->task_id);



    // $user->departments()->detach();
    // foreach ($request->input('dept') as $dep) {
    //   $user->departments()->attach($dep);
    // }

    // $role = $request->input('role');
    // $role_r = Role::where('id', $role)->firstOrFail();
    // $user->assignRole($role_r);


    return redirect('/users')->with('success', 'User Added');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::find($id);
    $clients = Client::all();
    return view('users.show', compact('user', 'clients'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $user = User::findOrFail($id);
    $depts = Department::all();
    $subsidiaries = Subsidiary::all();
    $tasks = Task::all();
    $groups = Group::all();
    // get roles
    if (auth()->user()->hasRole('Root')) {
      $roles = Role::where('name', '!=', 'Root')->get();
    } else {
      $roles = Role::where('name', '!=', 'Root')->where('name', '!=', 'Admin')->get();
    }

    return view('users.edit', compact('user', 'depts', 'subsidiaries', 'roles', 'tasks', 'groups'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {

    $this->validate($request, [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
      'dept' => 'required'
    ]);
   
    $user = User::findOrFail($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    // $user->department_id = 0;
    // $user->status = true;
   
    $user_p = Auth::getUser();
    if (Hash::check($request->get('current_password'), $user_p->password)) {
      // if the current password is correct
      $user_p->password = $request->input('new_password');
      $user_p->save();

      return redirect()->route('users.edit')->with('success', 'Le profil a été changé avec succès !');
    } else {
      return redirect()->back()->withErrors('Current Password is incorrect!');
    }

    if ($request->input('status')) {
      $user->status = true;
    } else {
      $user->status = false;
    }
    dd($request);
    $user->save();

    if ($request->group_id != null) {
      $user->groups()->detach($request->group_id);
      $user->groups()->sync($request->group_id);
    }

    if ($request->task_id != null) {
      $user->tasks()->detach($request->group_id);
      $user->tasks()->sync($request->task_id);
    }

    $user->departments()->detach();
    foreach ($request->input('dept') as $dep) {
      $user->departments()->attach($dep);
    }


    // $role_id = $request->input('role');
    //
    // // get the obj of current role
    // $curr_role = Role::findByName($user->roles->pluck('name')->implode(' '));
    // // get the obj of new role
    // $new_role = Role::where('id',$role_id)->firstOrFail();
    // // first remove current role
    // $user->removeRole($curr_role);
    // // then assign the new role
    // $user->assignRole($new_role);

    // if ($request->input('role') !== $user->roles->pluck('name')->implode(' ')) {
    //   // first remove current role
    //   $user->removeRole($user->roles->pluck('name')->implode(' '));
    //   // then assign the new role
    //   $user->assignRole($request->input('role'));
    // }

    // \Log::addToLog('User ID ' . $id . ' was edited');

    return redirect('/users')->with('success', 'User Data Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(int $id)
  {
    $user = User::findOrFail($id);
    $user->delete();

    Log::addToLog('User ID : ' . $id . ' was deleted');

    return redirect('/users')->with('success', 'User deleted');
  }

  public function tasks(Int $id)
  {

    $user = User::find($id);
    $tasks = $user->tasks()->get();

    return view('task.project.tasks', compact('tasks'));
  }
  public function dashboad(Int $id)
  {

    $user = User::find($id);
    dd($user);
    $tasks = $user->tasks()->get();

    return view('task.project.tasks', compact('tasks'));
  }
 
}
