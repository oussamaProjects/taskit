<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth', 'permission:manage']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folders = Folder::all();

        return view('folders.index', compact('folders'));
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
            'name' => 'required'
        ]);

        $folder = new Folder;

        $user_id = auth()->user()->id;
        $department_id = auth()->user()->department_id;

        $folder->name = $request->input('name');
        $folder->user_id = $user_id;
        $folder->department_id = $department_id;

        // save to db
        $folder->save();

        \Log::addToLog('New folder ' . $request->input('name') . ' was added');

        return redirect('/folders')->with('success', 'Folder Added');
    }

    // searching
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string'
        ]);

        $srch = strtolower($request->input('search'));
        $names = Folder::pluck('name')->all();
        $results = [];

        for ($i = 0; $i < count($names); $i++) {
            $lower = strtolower($names[$i]);
            if (strpos($lower, $srch) !== false) {
                $results[$i] = Folder::where('name', $names[$i])->get();
            }
        }

        return view('folders.results', compact('results'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        $docs = $folder->documents()->get();
        $filetype = '';
        return view('documents.index', compact('docs', 'folder', 'filetype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        $folder = Folder::findOrFail($id);

        return view('folders.edit', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|required'
        ]);

        $folder = Folder::findOrFail($id);
        $folder->name = $request->input('name');
        $folder->save();

        \Log::addToLog('Folder ID ' . $id . ' was edited');

        return redirect('folders')->with('success', 'Folder Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder = Folder::find($id);

        $folder->delete();

        $folder->documents()->detach();

        \Log::addToLog('Folder ID ' . $id . ' was deleted');

        return redirect('/folders')->with('success', 'Folder Deleted');
    }
}