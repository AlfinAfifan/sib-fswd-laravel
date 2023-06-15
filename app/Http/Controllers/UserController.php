<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->sortBy('role_id');
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }


        $imageName = time(). '.' .$request->image->extension();
        Storage::putFileAs('public/user', $request->file('image'), $imageName);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'role_id' => $request->role,
            'avatar' => $imageName,
        ]);

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }


        if ($request->hasFile('image')) {

            $oldImage = User::find($id)->image;
            Storage::delete('public/user/' . $oldImage);

            $imageName = time(). '.' .$request->image->extension();
            Storage::putFileAs('public/user', $request->file('image'), $imageName);

            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'role_id' => $request->role,
                'avatar' => $imageName,
            ]);
        } else {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'role_id' => $request->role,
            ]);
        }

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
