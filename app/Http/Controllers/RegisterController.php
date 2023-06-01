<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        $store = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role_id' => 3,
        ]);

        if ($store) {
            return redirect()->route('login')->with('success', 'Register berhasil, silahkan login') ;
        } else {
            return redirect()->route('login')->with('error', 'Register gagal, silahkan coba lagi') ;
        }
    }
}
