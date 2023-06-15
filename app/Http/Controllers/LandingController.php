<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $sliders = Slider::all();

        if ($request->category) {
            $products = Product::with('category')->whereHas('category', function($query) use($request) {
                $query->where('name', $request->category);
            })->get();
        } elseif ($request->min && $request->max) {
            $products = Product::where('price', '>=', $request->min)->where('price', '<=', $request->max)->get();
        } elseif ($request->search) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')->orWhereHas('category', function($query) use($request) {
                $query->where('name', $request->category);
            })->get();
        } else {
            $products = Product::inRandomOrder()->limit(8)->get();
        }


        return view('landing.index', compact('categories', 'sliders','products'));
    }

    public function detail($id) {
        $categories = Category::all();
        $product = Product::where('id', $id)->with('category')->first();
        $related = Product::where('category_id', $product->category->id)->inRandomOrder()->limit(4)->get();

        if ($product) {
            return view('landing.detail', compact('categories', 'product', 'related'));
        } else {
            abort(404);
        }
    }

    public function profile($id)
    {
        $categories = Category::all();
        $roles = Role::all();
        $user = User::find($id);

        return view('landing.profile', compact('categories', 'roles', 'user'));
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
            return redirect()->route('landing.profile', $id)->with('success', 'Profil anda berhasil di update');
        } else {
            return redirect()->route('landing.profile', $id)->with('error', 'Edit profile gagal');
        }
    }
}
