<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'staff') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('landing.index');
        }

        return redirect()->back()->with('error', 'Email / password salah');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing.index');
    }

    public function forgot()
    {
        return view('auth.forgot-password');
    }
}
