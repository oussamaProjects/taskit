<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected function redirectTo()
    {

        $authUser = auth()->user();
        
        if ($authUser->status == 1) {
            if ($authUser->hasRole('Root')) {
                return '/dashboard';
            } elseif ($authUser->hasRole('Admin')) {
                return '/users';
            } else {
                return '/documents';
            }
        } else {
            // return redirect()->back()->withErrors('Current Password is incorrect!');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
