<?php

namespace App\Http\Controllers\Leadassistant\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;

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

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/lead-assistant';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('lead_assistant.auth.login');
    }

    
    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('lead_assistant.login');
    }

    //defining guard for admins
    protected function guard()
    {
        return Auth::guard('lead_assistant');
    }

    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
            return ['mobile'=>$request->get('email'),'password'=>$request->get('password')];
        }
        
        return $request->only($this->username(), 'password');
    }
}
