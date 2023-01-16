<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function show()
    {
        if(session()->has('image')){
            session()->forget('image');
        }
        
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        if(auth()->attempt(['email' => $email,'password' => $password],$remember))
        {
            // dd($request->user()->authority);
            if($request->user()->authority == 'guest'){
                
                Auth::logout();
                return back()->with('error','管理者のみログインできます');
            }
            
            return redirect()->route('home');
        } else {
            return back()->with('error','emailかパスワードが間違っています。');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
