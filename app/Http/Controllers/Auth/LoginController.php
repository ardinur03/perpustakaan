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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // check if authenticated, then redirect to dashboard
    protected function authenticated()
    {
        if (Auth::user()->hasRole('member')) {
            return redirect()->route('member.dashboard')->with('success_message', 'Hallo Selamat datang Kembali 👋 !');
        } else if (Auth::user()->hasRole('petugas')) {
            return redirect()->route('admin.dashboard')->with('success_message', 'Hallo Selamat datang Kembali 👋 !');
        } else if (Auth::user()->hasRole('super-admin')) {
            return redirect()->route('superadmin.dashboard')->with('success_message', 'Hallo Selamat datang Kembali 👋 !');
        } else {
            return redirect()->route('welcome')->with('success_message', 'Hallo Selamat datang Kembali 👋 !');
        }
    }

    // login with username or email address
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_code';

        if (auth()->attempt(array($fieldType => $request->email, 'password' => $request->password))) {
            if (Auth::user()->hasRole('member')) {
                return redirect()->route('member.dashboard')->with('success_message', 'Hallo Selamat datang Kembali 👋 !');
            } else if (Auth::user()->hasRole('petugas')) {
                return redirect()->route('admin.dashboard')->with('success_message', 'Hallo Selamat datang Kembali 👋 !');
            } else if (Auth::user()->hasRole('super-admin')) {
                return redirect()->route('superadmin.dashboard')->with('success_message', 'Hallo Selamat datang Kembali 👋 !');
            } else {
                return redirect()->route('welcome')->with('success_message', 'Hallo Selamat datang Kembali 👋 !');
            }
        } else {
            return redirect()->route('login')->with('error_message', 'Email atau Password salah');
        }
    }
}
