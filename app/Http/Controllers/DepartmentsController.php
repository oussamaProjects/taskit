<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Folder;
use App\Helpers\Log;
use App\Subsidiary;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $subsidiaries = Subsidiary::all();
        $subs = Subsidiary::pluck('subsName', 'id')->all();
        $depts = Department::pluck('dptName', 'id')->all();

        return view('departments.index', compact('departments', 'subsidiaries', 'depts', 'subs'));
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
            'dptName' => 'required',
            'subs_id' => 'required',
        ]);

        // $check_name = Department::where('dptName', 'like', $request->input('dptName'))
        //     ->where('dptName', 'like', $request->input('dptName'))
        //     ->first();

        // if ($check_name !== null) {
        //     return redirect()->back()->with('failure', 'Le nom de departement exist deja !');
        // }

        $dept = new Department;
        $dept->dptName = $request->input('dptName');
        $dept->save();
        $dept->subsidiaries()->sync($request->subs_id);

        \Log::addToLog('New department ' . $request->input('dptName') . ' was added');

        return redirect('/departments')->with('success', 'Le département a été ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function active(Request $request)
    {
        $department=new Department;
        $department->users()->get();
        dd($department);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dept = Department::findOrFail($id);
        $subsidiaries = Subsidiary::all();
        $subs = Subsidiary::pluck('subsName', 'id')->all();
        $depts = Department::pluck('dptName', 'id')->all();

        return view('departments.edit', compact('dept', 'subsidiaries','subs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDepartement($subs_id, $folder_id)
    {
        $subsidiary = Subsidiary::findOrFail($subs_id);
        $depts = $subsidiary->departments()->get();

        if (isset($folder_id) && $folder_id != 0)
            foreach ($depts as $key => $dept) {

                $dp = DB::table('folder_departement')
                    ->select('folder_departement.folder_id', 'folder_departement.department_id', 'folder_departement.permission_for')
                    ->Join('subsidiaries_departement', 'subsidiaries_departement.departement_id', '=', 'folder_departement.department_id')
                    ->where('folder_departement.folder_id', '=', $folder_id)
                    ->where('subsidiaries_departement.subs_id', '=', $subs_id)
                    ->where('folder_departement.department_id', '=', $dept['id'])
                    ->get()
                    ->toArray();

                if (isset($dp) && !empty($dp)) {
                    $folder_departement = $dp[0];
                    $dept['permission_for'] = isset($folder_departement->permission_for) ? $folder_departement->permission_for : 0;
                }
            }

        $data = array(
            'departments' => $depts,
        );

        return response()->json([
            'data' => $data
        ]);
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
            'dptName' => 'required',
        ]);

        $dept = Department::findOrFail($id);
        $dept->dptName = $request->input('dptName');
        $dept->subsidiaries()->sync($request->subs_id);
        $dept->save();

        \Log::addToLog('Department ID ' . $id . ' was edited');

        return redirect('/departments')->with('success', 'Le département a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = Department::find($id);
        $dept->delete();

        \Log::addToLog('Department ID ' . $id . ' was deleted');

        return redirect('/departments')->with('success', 'Le département a été supprimé avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function linkDS(Request $request)
    {
        $dept = Department::find($request->dept_id)->first();
        $dept->subsidiaries()->sync($request->subs_id);
        $dept->save();

        \Log::addToLog('Department ID ' . $request->dept_id[0] . '  was linked to the subsidiary ID ' . $request->subs_id[0]);

        return redirect('/departments')->with('success', 'Le département a été lié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function linkDtoS(Request $request)
    {

        $id = $request->id;
        $subs = $request->subs;

        if (isset($id) && isset($subs)) {

            $dept = Department::find($id);
            $dept->subsidiaries()->sync($subs);
            foreach ($subs as $key => $sub) {
                Log::addToLog('Department ID ' .  $id  . '  was linked to the subsidiary ID ' . $sub);
            }
            $dept->save();
            echo $id;
            var_dump($subs);
            $department = Department::find($id);

            $data = array(
                'department' => $department,
            );
            return response()->json([
                'data' => $data
            ]);
        }
        // return redirect()->back()->with('success', 'Le département a été lié avec succès !');
    }
}
