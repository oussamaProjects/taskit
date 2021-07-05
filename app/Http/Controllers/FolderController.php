<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $folders        = Folder::where('parent_id', '=', '0')->get();
        $folders_input  = Folder::pluck('name', 'id')->all();

        $folders_ = DB::table('folders as f1')
            ->leftJoin('folders as f2', 'f2.parent_id', '=', 'f1.id')
            ->leftJoin('folders as f3', 'f3.parent_id', '=', 'f2.id')
            ->leftJoin('folders as f4', 'f4.parent_id', '=', 'f3.id')
            ->select('f1.id as f1_id', 'f1.name as f1_name', 'f2.id as f2_id', 'f2.name as f2_name', 'f3.id as f3_id', 'f3.name as f3_name', 'f4.id  as f4_id', 'f4.name as f4_name')
            ->where('f1.parent_id', '=', 0)
            ->get();


        $all_folders = [];
        $folder_f1_id = '';
        $folder_f2_id = '';
        $folder_f3_id = '';
        $folder_f4_id = '';
        $f1_id = -1;
        $f2_id = -1;
        $f3_id = -1;
        $f4_id = -1;
        foreach ($folders_ as $k => $folder) {
            if ($folder->f1_id != $folder_f1_id) {
                $f1_id = $f1_id + 1;
                $all_folders[$f1_id]['id'] = $folder->f1_id;
                $all_folders[$f1_id]['name'] = $folder->f1_name;
                $f2_id = -1;
            }
            if ($folder->f2_id != $folder_f2_id && $folder->f2_id <> NULL) {
                $f2_id = $f2_id + 1;
                $all_folders[$f1_id]['children'][$f2_id]['id'] = $folder->f2_id;
                $all_folders[$f1_id]['children'][$f2_id]['name'] = $folder->f2_name;
                $f3_id = -1;
            }
            if ($folder->f3_id != $folder_f3_id && $folder->f3_id <> NULL) {
                $f3_id = $f3_id + 1;
                $all_folders[$f1_id]['children'][$f2_id]['children'][$f3_id]['id'] = $folder->f3_id;
                $all_folders[$f1_id]['children'][$f2_id]['children'][$f3_id]['name'] = $folder->f3_name;
                $f4_id = -1;
            }
            if ($folder->f4_id != $folder_f4_id && $folder->f3_id <> NULL) {
                $f4_id = $f4_id + 1;
                $all_folders[$f1_id]['children'][$f2_id]['children'][$f3_id]['children'][$f4_id]['id'] = $folder->f4_id;
                $all_folders[$f1_id]['children'][$f2_id]['children'][$f3_id]['children'][$f4_id]['name'] = $folder->f4_name;
            }
            $folder_f1_id = $folder->f1_id;
            $folder_f2_id = $folder->f2_id;
            $folder_f3_id = $folder->f3_id;
            $folder_f4_id = $folder->f4_id;
        }

        // dd($all_folders);
        return view('folders.index', compact('folders', 'folders_input'));
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
        // dd($request->input('folder_parent_id'));

        $folder->parent_id = $request->input('folder_parent_id')[0];

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
        $folders            = Folder::where('parent_id', '=', $folder->id)->get();
        $folders_input      = Folder::pluck('name', 'id')->all();
        $docs               = $folder->documents()->get();
        $filetype           = '';

        return view('folders.show', compact('docs', 'folder', 'folders', 'folders_input', 'filetype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        // $folder = Folder::findOrFail($folder);

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