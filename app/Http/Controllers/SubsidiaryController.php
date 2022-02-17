<?php

namespace App\Http\Controllers;

use App\Department;
use App\Subsidiary;
use Illuminate\Http\Request;

class SubsidiaryController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'role:Root']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsidiaries = Subsidiary::all();

        return view('subsidiaries.index')->with('subsidiaries', $subsidiaries);
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
            'subsName' => 'required',
        ]);

        // $subs = Subsidiary::create($request->only('subsName'));

        $subs = new Subsidiary; 
        $subs->subsName = $request->input('subsName'); 
        $subs->save();

        \Log::addToLog('New subsidiary ' . $request->input('subsName') . ' was added');

        return redirect('/subsidiaries')->with('success', 'Le département a été ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subs = Subsidiary::findOrFail($id);
        $subsidiaries = Subsidiary::all();

        $departments = $subs->departments()->get();
        $depts = $subs->departments()->get()->pluck('dptName', 'id')->all();

        return view('subsidiaries.edit', compact('departments', 'subsidiaries', 'depts', 'subs'));

     
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
            'subsName' => 'required',
        ]);

        $subs = Subsidiary::findOrFail($id);
        $subs->subsName = $request->input('subsName');
        $subs->save();

        \Log::addToLog('Subsidiary ID ' . $id . ' was edited');

        return redirect('/subsidiaries')->with('success', 'Le département a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subs = Subsidiary::find($id);
        $subs->delete();

        \Log::addToLog('Subsidiary ID ' . $id . ' was deleted');

        return redirect('/subsidiaries')->with('success', 'Le département a été supprimé avec succès !');
    }

   
}
