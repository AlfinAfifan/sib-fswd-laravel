<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $sliders = Slider::where('approve', true)->get();

        if ($request->category) {
            $products = Product::with('category')->whereHas('category', function($query) use($request) {
                $query->where('name', $request->category);
            })->where('approve', true)->get();
        } elseif ($request->min && $request->max) {
            $products = Product::where('price', '>=', $request->min)->where('price', '<=', $request->max)->where('approve', true)->get();
        } elseif ($request->search) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')->where('approve', true)->get();
        } else {
            $products = Product::where('approve', true)->orderBy('id', 'desc')->paginate(12);
        }

        // hitung produk dalam cart
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if ($order) {
                $totalCart = OrderDetail::where('order_id', $order->id)->get()->count();
            } else {
                $totalCart = 0;
            }
            return view('landing.index', compact('categories', 'sliders','products', 'totalCart'));
        }

        $totalCart = 0;
        return view('landing.index', compact('categories', 'sliders','products', 'totalCart'));
    }

    public function detail($id) {
        $categories = Category::all();
        $product = Product::where('id', $id)->with('category')->first();
        $related = Product::where('category_id', $product->category->id)->inRandomOrder()->limit(4)->get();

        // hitung produk dalam cart
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
                $totalCart = OrderDetail::where('order_id', $order->id)->get()->count();
        }

        if ($product) {
            $totalCart = 0;
            return view('landing.detail', compact('categories', 'product', 'related', 'totalCart'));
        } else {
            abort(404);
        }
    }

    public function profile($id)
    {
        $categories = Category::all();
        $roles = Role::all();
        $user = User::find($id);

        // hitung produk dalam cart
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if ($order) {
            $totalCart = OrderDetail::where('order_id', $order->id)->get()->count();
        } else {
            $totalCart = 0;
        }

        return view('landing.profile', compact('categories', 'roles', 'user', 'totalCart'));
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
