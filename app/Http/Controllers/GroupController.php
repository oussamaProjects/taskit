<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups=Group::all();
        $users=User::all();

        return view('group.index',compact('groups','users'));
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
       $this->validate($request,[
           'name'=>'required',
           'color'=>'required',

       ]);

       $group=Group::create([
           'name'=>$request->name,
           'color'=>$request->color
       ]);

        $group->users()->sync($request->user_id);
      
       
       return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group=Group::where('id',$id)->first();
        $users=User::all();
      
        return view('group.edit',compact('group','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
       $this->validate($request,[
           'name'=>'required',
           'color'=>'required'
       ]);

       $group=Group::find($id);
      
       $group->name=$request->name;
       $group->color=$request->color;

        $group->save();

        if($request->user_id!=null){
            $group->users()->detach();
            $group->users()->sync($request->user_id);
        }
      

       return  redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group=Group::find($id);
     
        $group->delete($id);

        return redirect()->back();
    }
}
