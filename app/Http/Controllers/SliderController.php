<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('approve', true)->get();
        $slidersUpdate = Slider::where('approve', false)->get();

        return view('slider.index', compact('sliders', 'slidersUpdate'));
    }

    public function create()
    {
        return view('slider.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'title' => 'string',
            // 'caption' => 'string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

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
        $validator = Validator::make($request->all(), [
            // 'title' => 'string',
            // 'caption' => 'string',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }


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

    public function approve($id)
    {
        Slider::find($id)->update([
            'approve' => true,
        ]);

        return redirect()->route('slider.index');
    }
}
