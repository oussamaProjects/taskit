<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Document;
use App\Folder;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function favoriteDocument(int $id)
    {
        $document = Document::findOrFail($id); 
        auth()->user()->toggleFavorite($document); 
        return redirect()->back()->with('success', 'Added to favories');
    }

    public function favoriteFolder(int $id)
    {
        $folder = Folder::findOrFail($id); 
        auth()->user()->toggleFavorite($folder);
        return redirect()->back()->with('success', 'Added to favories');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }
        $users = User::count();
        $documents = Document::count();
        $folders = Folder::count();
        $departments = Department::count();
        $user = Auth::user();

        if ($user->hasRole('Root') || $user->hasRole('Admin')) {
            return view('dashboard', compact('users', 'documents', 'folders', 'departments'));
        }

        return redirect('/documents');
    }
}
