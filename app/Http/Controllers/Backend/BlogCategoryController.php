<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $blog_categories = BlogCategory::orderBy('id', 'DESC')->get();

        return view('backend.category-blogs.index', compact('blog_categories'));
    }

    public function create()
    {
        return view('backend.category-blogs.create');

    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:blog_categories,slug',
        ]);
        BlogCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);
        return redirect()->route('admin.category-blogs.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Blog Category created successfully.'
            ]);

    }

    public function edit($id)
    {
        $blog_category = BlogCategory::find($id);
        return view('backend.category-blogs.edit', compact('blog_category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        $category = BlogCategory::find($id);
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('admin.category-blogs.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Blog Category updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $blog_category = BlogCategory::findOrFail($id);

        $blog_category->blogs()->delete();
        $blog_category->delete();

        return redirect()->route('admin.category-blogs.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Blog Category has been deleted'
            ]);
    }
}
