<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Category;
use App\Department;
use App\Document;
use App\Helpers\Log;
use App\Subsidiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FolderController extends Controller
{

    public function __construct()
    {
        // return $this->middleware(['auth', 'permission:manage']);
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $categories = Category::pluck('name', 'id')->all();
        $depts = Department::all();
        $subs = Subsidiary::all();
        $docs = null;

        $folders = $folders_table = Folder::where('parent_id', '=', 0)->get();
        $folders_input = Folder::pluck('name', 'id')->all();

        // $folders = $folders_table = UtilityController::put_folders_size($folders_table);

        return view('folders.index', compact('folders', 'folders_input', 'folders_table', 'docs', 'depts', 'subs', 'categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $user = auth()->user();
        $categories = Category::pluck('name', 'id')->all();
        $depts = Department::all();
        $subs = Subsidiary::all();
        $docs = null;

        $all_folders = Folder::all();
        $folders_table = Folder::where('parent_id', '=', 0)->get();
        $folders_input = Folder::pluck('name', 'id')->all();

        $folders = $folders_table = UtilityController::put_folders_size($folders_table);

        return view('folders.all', compact('folders', 'folders_table', 'folders_input', 'all_folders', 'docs', 'depts', 'subs', 'categories'));
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
        ]);

        $depts = Department::all();
        $permissions = [];

        foreach ($depts as $dep) {
            $permissions[] = $request->input('permissions_' . $dep->id);
        }

        $folder = new Folder;
        $user = auth()->user();
        $user_id = $user->id;
        $department_id = $user->department_id;

        $check_name = Folder::where('name', '=', $request->input('name'))->first();
        if ($check_name !== null) {
            return redirect()->back()->with('failure', 'Le nom du dossier exist deja !');
        }

        $folder->name = $request->input('name');
        $folder->user_id = $user_id;
        $folder->department_id = $department_id;
        $folder->color = $request->input('color') ?? '#fdf4d0';

        if ($request->input('parent'))
            $folder->parent_id = !is_numeric($request->input('folder_parent_id')) ?  0 : $request->input('folder_parent_id');

        // save to db
        $folder->save();

        UtilityController::attachFolderToDept($folder, $permissions);

        Log::addToLog('New folder ' . $request->input('name') . ' was added');

        return redirect('/folders')->with('success', 'Le dossier a ??t?? ajout?? avec succ??s !');
    }

    // searching
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string',
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

        $user = auth()->user();
        if (UtilityController::has_permission_for_folder($folder->id, $user)) {

            $categories = Category::pluck('name', 'id')->all();
            $depts = Department::all();
            $docs = $folder->documents()->get();
            $subs = Subsidiary::all();
            $filetype = '';

            $folders = Folder::where('parent_id', '=', 0)->get();
            $folders_table = Folder::where('parent_id', '=', $folder->id)->get();
            $folders_input = Folder::pluck('name', 'id')->all();

            // $folders_table = UtilityController::put_folders_size($folders_table);
            // $folders = UtilityController::put_folders_size($folders);
            $folder = UtilityController::put_folders_size($folder);

            return view('folders.index', compact('docs', 'folder', 'folders', 'folders_table', 'folders_input', 'filetype', 'depts', 'subs', 'categories'));
        } else
            return redirect('/folders')->with('failure', 'vous n\'avez pas acc??s ?? ce dossier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function child(int $id)
    {

        $user = auth()->user();
        if (UtilityController::has_permission_for_folder($id, $user)) {
            $categories = Category::pluck('name', 'id')->all();
            $depts = Department::all();
            $subs = Subsidiary::all();

            $folder = Folder::findOrFail($id);
            $docs = $folder->documents()->get();
            $filetype = '';

            $folders_input = Folder::pluck('name', 'id')->all();
            $folders = Folder::where('parent_id', '=', '0')->get();
            $folders_table = Folder::where('parent_id', '=', $id)->get();

            $folders_table = UtilityController::put_folders_size($folders_table);

            return view('documents.index', compact('docs', 'folder', 'folders', 'folders_table', 'folders_input', 'filetype', 'depts', 'categories', 'subs'));
        } else
            return redirect('/documents')->with('failure', 'vous n\'avez pas acc??s ?? ce dossier');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        $user = auth()->user();

        if (UtilityController::has_permission_for_folder($folder->id, $user)) {
            $depts   = Department::all();
            $subs    = Subsidiary::all();
            $categories = Category::pluck('name', 'id')->all();
            $folders_input = Folder::pluck('name', 'id')->all();

            foreach ($depts as $key => $dept) {

                $dp = DB::table('folder_departement')
                    ->select('folder_departement.folder_id', 'folder_departement.department_id', 'folder_departement.permission_for')
                    ->Join('subsidiaries_departement', 'subsidiaries_departement.departement_id', '=', 'folder_departement.department_id')
                    ->where('folder_departement.folder_id', '=', $folder->id)
                    ->where('folder_departement.department_id', '=', $dept['id'])
                    ->get()
                    ->toArray();

                if (isset($dp) && !empty($dp)) {
                    $folder_departement = $dp[0];
                    $dept['permission_for'] = isset($folder_departement->permission_for) ? $folder_departement->permission_for : 0;
                }
            }

            return view('folders.edit', compact('folder', 'folders_input', 'categories', 'subs', 'depts'));
        } else
            return redirect('/folders')->with('failure', 'Vous ne pouvez pas modifier ce dossier');
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
            'name' => 'string|required',
        ]);

        $depts = Department::all();
        $permissions = [];

        $folder = Folder::findOrFail($id);
        $folder->name = $request->input('name');
        $folder->save();

        foreach ($depts as $dep) {
            $permissions[] = $request->input('permissions_' . $dep->id);
        }

        UtilityController::attachFolderToDept($folder, $permissions);

        Log::addToLog('Folder ID ' . $id . ' was edited');

        return redirect('folders')->with('success', 'Le dossier a ??t?? mis ?? jour avec succ??s !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->hasRole('Root') || $user->hasRole('Admin')) {

            $folder = Folder::find($id);
            $folder->delete();
            $folder->documents()->detach();
            Log::addToLog('Folder ID ' . $id . ' was deleted');

            return redirect()->back()->with('success', 'Le dossier a ??t?? supprim?? avec succ??s !');
        } else
            return redirect()->back()->with('failure', 'Vous ne pouvez pas supprim?? ce dossier');
    }


    public function changeColor(Request $request, $id)
    {
        $folder = Folder::findOrFail($id);
        $folder->color =  $request->input('color');
        $folder->save();

        Log::addToLog('The color of the folder ID ' . $id . ' was changed');

        return redirect()->back()->with('success', 'La couleur du fichier a ??t?? modifie avec succ??s !');
    }
}
