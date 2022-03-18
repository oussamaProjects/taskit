<?php

namespace App\Http\Controllers;

use App\Parametre;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $parametre=Parametre::all();
       
       return view('parametre.index',compact('parametre'));
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
            'value'=>'required'
        ]);

        $parametre=Parametre::create([
            'name'=>$request->name,
            'value'=>$request->value
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parametre=Parametre::find($id);

        return view('parametre.edit',compact('parametre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    { 
       $parametre= Parametre::findOrfail($id)->get();
    
      $parametre->value=$request->value;
      $parametre->save();

       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $parametre=Parametre::find($id);
       $parametre->delete($id);

       return redirect()->back();
    }
}
