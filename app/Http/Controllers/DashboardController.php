<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Document;
use App\User;

class DashboardController extends Controller
{
    public function __construct() {
        return $this->middleware(['auth','role:Root']);
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

        return view('dashboard', compact('users', 'documents'));  
    }
   

    
}
