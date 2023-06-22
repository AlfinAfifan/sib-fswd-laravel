<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->where('approve', true)->get()->sortByDesc('id');
        $productsUpdate = Product::where('approve', false)->get();

        if (Auth::user()->role->name == 'user') {
            return view('product.card', compact('products', 'productsUpdate'));
        }

        return view('product.index', compact('products', 'productsUpdate'));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $product = Product::all();

        return view('product.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'price' => 'required|integer',
            'sale_price' => 'required|integer',
            'brand' => 'required|string',
            'rating' => 'required|integer|between:0,5',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $imageName = time(). '.' .$request->image->extension();
        Storage::putFileAs('public/product', $request->file('image'), $imageName);

        if (Auth::user()->role_id == 1) {
            Product::create([
                'category_id' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'brands' => $request->brand,
                'rating' => $request->rating,
                'image' => $imageName,
                'approve' => true,
            ]);
        } else {
            Product::create([
                'category_id' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'brands' => $request->brand,
                'rating' => $request->rating,
                'image' => $imageName,
            ]);
        }

        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->with('category')->first();
        $categories = Category::all();
        $brands = Brand::all();

        return view('product.edit', compact('product' ,'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|',
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'price' => 'required|integer',
            'sale_price' => 'required|integer',
            'brand' => 'required|string',
            'rating' => 'required|integer|between:0,5',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if ($request->hasFile('image')) {
            $oldImage = Product::find($id)->image;
            Storage::delete('public/product/'.$oldImage);

            $imageName = time(). '.' .$request->image->extension();
            Storage::putFileAs('public/product', $request->file('image'), $imageName);

            $product = Product::find($id);
            $product->update([
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'brands' => $request->brand,
            'rating' => $request->rating,
            'image' => $imageName,
            ]);
        } else {
            $product = Product::find($id);
            $product->update([
                'category_id' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'brands' => $request->brand,
                'rating' => $request->rating,
            ]);
        }

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('product.index');
    }

    public function approve($id)
    {
        Product::find($id)->update([
            'approve' => true,
        ]);

        return redirect()->route('product.index');
    }
}
