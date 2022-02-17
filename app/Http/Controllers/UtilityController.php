<?php

namespace App\Http\Controllers;

use App\Document;
use App\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
{
    static function attachFolderToDept(Folder $folder, array $permissions)
    {

        $user = auth()->user();
        $department_id = $user->department_id;

        if ($user->hasRole('Root') || $user->hasRole('Admin')) {

            $folder->department()->detach();

            foreach ($permissions as $key => $permission) {
                if ($permission !== null) {

                    $perms = explode('_', $permission[0]);

                    if ($perms[1] == 'all')
                        $permission_for = 0;
                    elseif ($perms[1] == 'admins')
                        $permission_for = 1;
                    elseif ($perms[1] == 'none')
                        $permission_for = -1;
                    else
                        $permission_for = -1;

                    // $doc->department()->sync($perms[0]);
                    $folder->department()->attach($folder->id, [
                        'department_id' => $perms[0],
                        'permission_for' => $permission_for
                    ]);
                }
            }
        } else {
            $folder->department()->attach($department_id, [
                'permission_for' => 0
            ]);
        }
    }

    static function attachDocToDept(Document $document, array $permissions)
    {
        $user = auth()->user();
        $department_id = $user->department_id;
        if ($user->hasRole('Root') || $user->hasRole('Admin')) {
            foreach ($permissions as $key => $permission) {
                if ($permission !== null) {
                    $perms = explode('_', $permission[0]);

                    if ($perms[1] == 'all')
                        $permission_for = 0;
                    elseif ($perms[1] == 'admins')
                        $permission_for = 1;
                    elseif ($perms[1] == 'none')
                        $permission_for = -1;
                    else
                        $permission_for = -1;

                    $document->department()->attach($document->id, [
                        'department_id' => $perms[0],
                        'permission_for' => $permission_for
                    ]);
                }
            }
        } else {
            $document->department()->attach($department_id, [
                'permission_for' => 0
            ]);
        }
    }

    static function has_permission_for_doc($id, $user)
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

        return true;
    }

    static function has_permission_for_folder($id, $user)
    {
        $permission = DB::table('departments')
            ->leftJoin('folder_departement', 'folder_departement.department_id', 'departments.id')
            ->where('folder_departement.folder_id', '=', $id)
            ->where('folder_departement.department_id', '=', $user->department_id)
            ->distinct()
            ->get();

        if (!$user->hasRole('Root')) {
            // var_dump($user->department_id);
            // var_dump($id);
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
            return false;
        }

        return true;
    }
}
