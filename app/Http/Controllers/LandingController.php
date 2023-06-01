<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $sliders = Slider::all();
        $products = Product::all();

        return view('landing', compact('categories', 'sliders','products'));
    }

    public function create() {

    }
}
