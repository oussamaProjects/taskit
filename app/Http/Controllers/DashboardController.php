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
        // return $this->middleware(['auth']);
    }

    public function favoriteDocument(Document $document)
    {
        // dd($document);
        $user = Auth::user();
        $user->attachFavoriteStatus($document);
    }
    
    public function favoriteFolder(Folder $folder)
    {
        dd($folder);
        $user = Auth::user();
        $user->attachFavoriteStatus($folder);
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
        // with type
        $favorites_docs = $user->favorites()->withType(Document::class)->count();
        dd($favorites_docs);

        if (auth()->user()->hasRole('Admin')) {
            return view('dashboard', compact('users', 'documents', 'folders', 'departments'));
        } elseif (auth()->user()->hasRole('Root')) {
            return view('dashboard', compact('users', 'documents', 'folders', 'departments'));
        }

        return redirect('/documents');
    }
}
