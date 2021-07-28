<?php

namespace App\Http\Controllers\Auth;

use App\Admin\TemplateInvoiceManager;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Config;

class CrmLoginController extends Controller
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
        if(!auth()->guard('admin')->check())
            return view('CRM.auth.login');
        else
            return redirect()->route('crm.home');
    }


    public function login(Request $request)
    {
        if(auth()->guard('admin')->attempt(['username' => $request->username, 'password' => $request->password, 'status'=>1])) {
            return redirect()->route('crm.dashboard');
            //return redirect()->intended($this->redirectPath());
        }
        return back()->withErrors(['username' => 'Username or password are wrong.']);

    }

    public function logout(){
        if(!auth()->guard('admin')->check())
            return redirect()->route('crm.login.get');
        else{
            auth()->guard('admin')->logout();
            return redirect()->route('crm.login.get');
        }
    }

    function test()
    {
        $file = Storage::disk('local')->get('settings/style-setting.txt');
//        $contents = file_get_contents(asset('backend_CRM/pages/assets/css/style-setting.css'));
        $contentsReplace = str_replace('{color}', 'black !important', $file);
        file_put_contents('backend_CRM/pages/assets/css/style-setting.css', $contentsReplace);

//        Storage::disk('local')->append('settings/style-setting.txt', $content);
    }
}
