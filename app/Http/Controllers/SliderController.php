<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('slider.create');
    }

    public function store(Request $request)
    {
        $imageName = time().'.'.$request->image->extension();
        Storage::putFileAs('public/slider', $request->file('image'), $imageName);

        $slider = Slider::create([
            'title' => $request->title,
            'caption' => $request->caption,
            'image' => $imageName,
        ]);

        return redirect()->route('slider.index');
    }

    public function edit(Request $request, $id)
    {
        $slider = Slider::find($id);

        // load view edit.blade.php dan passing data slider
        return view('slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        if($request->hasFile('image')) {
            $oldImage = Slider::find($id)->image;
            Storage::delete('public/slider/' . $oldImage);

            $imageName = time().'.'.$request->image->extension();

            Storage::putFileAs('public/slider', $request->file('image'), $imageName);

            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
                'image' => $imageName,
            ]);
        } else {
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
            ]);
        }

        return redirect()->route('slider.index');
    }

    public function destroy($id)
    {
        Slider::find($id)->delete();

        return redirect()->route('slider.index');
    }
}
