<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->get();
        return view('backend.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('backend.blogs.create', compact('categories'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'service_category_id' => 'integer|required',
            'image'                 => 'required|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required',
            'slug' => 'required|unique:blogs,slug',
            'description' => 'required',


        ], [
            'service_category_id.required' => 'Category is required.'
        ]);
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $blog_image = $name;


            // for save original image
            $ImageUpload = Image::make($image->getRealPath());
            $originalPath = public_path('/uploads/blogs_images/');
            // prevent possible upsizing
            $ImageUpload->resize(510, 510);
            $ImageUpload->save($originalPath . $name);

            // for save thumnail image
            $ImageUploadThumbnail = Image::make($image->getRealPath());
            $thumbnailPath = public_path('/uploads/blogs_images/thumbnails/');
            // prevent possible upsizing
            $ImageUploadThumbnail->resize(350, 262);
            $ImageUploadThumbnail = $ImageUploadThumbnail->save($thumbnailPath . $name);


        } else {
            $blog_image = null;
        }
        $blog = Blog::create([
//            'name' => Auth()->user()->fullName(),
            'blog_category_id' => $request->service_category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $blog_image,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);
        return redirect()->route('admin.special-offers.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Special Offer created successfully.'
            ]);

    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        $categories = BlogCategory::all();
        return view('backend.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'service_category_id' => 'integer|required',
            'description'           => 'required',
            'image'                 => 'required|mimes:jpg,jpeg,png|max:2048',

        ], [
            'service_category_id.required' => 'Category is required.'
        ]);
        $blog = Blog::find($id);
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $blog_image = $name;


            // for save original image
            $ImageUpload = Image::make($image->getRealPath());
            $originalPath = public_path('/uploads/blogs_images/');
            // prevent possible upsizing
            $ImageUpload->resize(510, 510);
            $ImageUpload->save($originalPath . $name);

            // for save thumnail image

            $ImageUploadThumbnail = Image::make($image->getRealPath());
            $thumbnailPath = public_path('/uploads/blogs_images/thumbnails/');
            // prevent possible upsizing
            $ImageUploadThumbnail->resize(350, 262);
            $ImageUploadThumbnail = $ImageUploadThumbnail->save($thumbnailPath . $name);
        } else {
            $blog_image = $blog->image;
        }

        $blog->update([
//            'name' => Auth()->user()->fullName(),
            'blog_category_id' => $request->service_category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $blog_image,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);
        return redirect()->route('admin.special-offers.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Special Offer updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('admin.special-offers.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Special Offer has been deleted'
            ]);
    }
}
