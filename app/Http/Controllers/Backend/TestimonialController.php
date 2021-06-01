<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $testimonials = Testimonial::all();

        return view('backend.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('backend.testimonial.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string|min:300',
            'image'         => 'required|mimes:jpg,jpeg,png|max:2048',

        ], [
            'title.required' => 'Title  is required.',
            'description.required' => 'Description  is required.',
            'image.required' => 'Image  is required.',

        ]);
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/testimonials');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $profile_image = $name;
        } else {
            $profile_image = null;
        }
        Testimonial::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $profile_image
        ]);


        return redirect()->route('admin.testimonial.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Testimonial created successfully.'
            ]);
    }

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);

        return view('backend.testimonial.edit', compact('testimonial'));


    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string|min:300',
            'image'         => 'required|mimes:jpg,jpeg,png|max:2048',

        ], [
            'title.required' => 'Title  is required.',
            'description.required' => 'Description  is required.',

        ]);
        $testimonial = Testimonial::find($id);
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/testimonials');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $profile_image = $name;
        } else {
            $profile_image = $testimonial->image;
        }



        $testimonial->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $profile_image
        ]);
        return redirect()->route('admin.testimonial.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Testimonial updated successfully.'
            ]);
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonial.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Testimonial has been deleted.'
            ]);
    }
}
