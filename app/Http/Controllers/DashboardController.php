<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index() {
        $totalOrder = Order::where('approve', true)->count();
        $orderReq = Order::where('approve', false)->count();
        $totalProduct = Product::where('approve', true)->count();
        $productReq = Product::where('approve', false)->count();

        return view('dashboard.index', compact('totalOrder', 'orderReq', 'totalProduct', 'productReq'));
    }

    public function profile($id)
    {
        $categories = Category::all();
        $roles = Role::all();
        $user = User::find($id);

        return view('dashboard.profile', compact('categories', 'roles', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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

            $update = User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'avatar' => $imageName,
            ]);
        } else {
            $update = User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
            ]);
        }

        if ($update) {
            return redirect()->route('dashboard.profile', $id)->with('success', 'Profil anda berhasil di update');
        } else {
            return redirect()->route('dashboard.profile', $id)->with('error', 'Edit profile gagal');
        }
    }
}
