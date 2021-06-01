<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $service_categories = Category::orderBy('id', 'DESC')->get();

        return view('backend.service_category.index', compact('service_categories'));
    }

    public function create()
    {
        $services = Service::all();
        return view('backend.service_category.create', compact('services'));

    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image'                           => 'required|mimes:jpg,jpeg,png|max:2048',
            'thumbnail_image'                 => 'required|mimes:jpg,jpeg,png|max:2048',
            'slug' => 'required|unique:service_categories,slug',
            'service_id' => 'required',
            'description' => 'required',
        ], [
            'service_id.required' => 'Category is required.',
            'image.required' => 'Image  is required.',
            'thumbnail_image.required' => 'Thumbnail Image  is required.',
        ]);


        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/service_category');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $profile_image = $name;



        } else {
            $profile_image = null;
        }


        if ($request->has('thumbnail_image')) {
            $image_new = $request->file('thumbnail_image');
            $name_new = $image_new->getClientOriginalName();
            $destinationPathThumbail = public_path('/uploads/service_category/thumbnails');
            $imagePathNre = $destinationPathThumbail . "/" . $name_new;
            $image_new->move($destinationPathThumbail, $name_new);
            $thumbnail_image = $name_new;



//
//            $destinationPathMobile = public_path('/uploads/service_category/thumbnails_mobiles/');
//            $imagePathMobile = $destinationPathMobile . "/" . $name;
//            $image->move($destinationPathMobile, $name);
        } else {
            $thumbnail_image = null;
        }


        if ($request->has('discount_type') && $request->discount_type == 'fixed') {
            $price = $request->discount_price;
            $discount = $request->discount_type;

        } elseif ($request->has('discount_type') && $request->discount_type == 'percentage') {
//            $price = (int)ceil($request->discount_price / 100);
            $price = $request->discount_price;
            $discount = $request->discount_type;
        } else {
            $price = 0;
            $discount = null;
        }
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'service_id' => $request->service_id,
            'image' => $profile_image,
            'thumbnail_image' => $thumbnail_image,
            'description' => $request->description,
            'discount_type' => $discount,
            'discount_price' => $price,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);
        return redirect()->route('admin.services.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Service created successfully.'
            ]);

    }

    public function edit($id)
    {
        $service_category = Category::find($id);
        $services = Service::all();
        return view('backend.service_category.edit', compact('service_category', 'services'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'service_id' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'thumbnail_image' => 'mimes:png,jpg,jpeg',
            'description' => 'required',

        ], [
            'service_id.required' => 'Category is required.',
            'image.required' => 'Image  is required.',
            'thumbnail_image.required' => 'Thumbnail Image  is required.',
        ]);

        $category = Category::find($id);
        if ($request->has('image')) {
            $image = $request->file('image');

            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/service_category');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $profile_image = $name;



        } else {
            $profile_image = $category->image;
        }


        if ($request->has('thumbnail_image')) {

            $image_new = $request->file('thumbnail_image');
            $name_new = $image_new->getClientOriginalName();
            $destinationPathThumbail = public_path('/uploads/service_category/thumbnails');
            $imagePathNre = $destinationPathThumbail . "/" . $name_new;
            $image_new->move($destinationPathThumbail, $name_new);
            $thumbnail_image = $name_new;



//            $destinationPathMobile = public_path('/uploads/service_category/thumbnails_mobiles/');
//            $imagePathMobile = $destinationPathMobile . "/" . $name;
//            $image->move($destinationPathMobile, $name);

        } else {
            $thumbnail_image = $category->thumbnail_image;;
        }

        if ($request->has('discount_type') && $request->discount_type == 'fixed') {
            $price = $request->discount_price;
            $discount = $request->discount_type;

        } elseif ($request->has('discount_type') && $request->discount_type == 'percentage') {
//            $price = (int)ceil($request->discount_price / 100);
            $price = $request->discount_price;
            $discount = $request->discount_type;
        } else {
            $price = 0;
            $discount = null;
        }
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'service_id' => $request->service_id,
            'image' => $profile_image,
            'thumbnail_image' => $thumbnail_image,
            'description' => $request->description,
            'discount_type' => $discount,
            'discount_price' => $price,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->route('admin.services.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Service updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $service_category = Category::findOrFail($id);
        $service_category->delete();

        return redirect()->route('admin.services.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Service has been deleted'
            ]);
    }
}
