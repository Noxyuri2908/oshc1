<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        if(auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status'=>1])) {
            return redirect()->intended($this->redirectPath());
        }
        return back()->withErrors(['email' => 'Email or password are wrong.']);

    }

    public function logout(){
        if(!auth()->guard('admin')->check())
            return redirect()->route('home');
        else{
            auth()->guard('admin')->logout();
            return redirect()->route('home');
        }
    }
}
