<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect('/admin');
        } elseif ($user->hasRole('patient')) {
            toast("Selamat datang " . $user->nama, 'success');
            return redirect('/');
        } elseif ($user->hasRole('nurse')) {
            return redirect()->route('nurses.index')->withSuccess("Selamat datang {$user->nama}");
        } elseif ($user->hasRole('doctor')) {
            return redirect()->route('doctors.index')->withSuccess("Selamat datang dokter {$user->nama}");
        }

        return redirect('/home');
    }
}
