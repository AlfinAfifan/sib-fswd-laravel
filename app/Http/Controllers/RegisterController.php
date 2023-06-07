<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|integer',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

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
