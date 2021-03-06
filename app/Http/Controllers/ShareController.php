<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use Illuminate\Http\Request;
use App\Shared;
use App\Document;
use App\Folder;
use App\Subsidiary;
use Illuminate\Support\Facades\DB;

class ShareController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
        // return $this->middleware(['auth', 'permission:shared']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shared = Shared::all();
        $user = auth()->user();
        $filetype = null;
        $categories = Category::pluck('name', 'id')->all();
        $depts = Department::all();
        $subs  = Subsidiary::all();
        $docs = Document::where('isExpire', '!=', 2)->get();
        $folders  = Folder::where('parent_id', '=', '0')->get();
        $folders_input = Folder::pluck('name', 'id')->all();

        return view('pages.shared', compact('shared', 'filetype', 'folders', 'folders_input', 'categories', 'depts', 'subs'));
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
        //
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
        //
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
        $doc = Document::findOrFail($id);

        if ($this->has_permission($id, auth()->user())) {
            $shared = new Shared;
            $shared->name = $doc->name;
            $shared->description = $doc->description;
            $shared->document_id = $doc->id;
            $shared->user_id = $doc->user_id;
            $shared->department_id = $doc->department_id;
            $shared->file = $doc->file;
            $shared->mimetype = $doc->mimetype;
            $shared->filesize = $doc->filesize;
            $shared->isExpire = $doc->isExpire;
            $shared->expires_at = $doc->expires_at;
            $shared->save();

            \Log::addToLog('Document ID ' . $id . ' was shared');

            return redirect('/documents')->with('success', 'Fichier partag??!');
        } else
            return redirect('/documents')->with('failure', 'Vous ne pouvez pas partager ce document');
    }

    function has_permission($id, $user)
    {

        $permission = DB::table('departments')
            ->leftJoin('document_departement', 'document_departement.department_id', 'departments.id')
            ->where('document_departement.document_id', '=', $id)
            ->where('document_departement.department_id', '=', $user->department_id)
            ->distinct()
            ->get();

        if (!$user->hasRole('Root')) {
            // var_dump($user->department_id);
            // var_dump($id);
            // var_dump($permission[0]->permission_for);
            if (isset($permission[0]) && !is_null($permission[0])) {
                if ($user->hasRole('Admin')) {
                    if ($permission[0]->permission_for == 1 || $permission[0]->permission_for == 0)
                        return true;
                    else
                        return false;
                } else if ($user->hasRole('User')) {
                    if ($permission[0]->permission_for == 0)
                        return true;
                    else
                        return false;
                } else
                    return false;
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
