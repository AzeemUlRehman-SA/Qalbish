<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $service_sub_categories = SubCategory::orderBy('id', 'DESC')->get();

        return view('backend.service_sub_category.index', compact('service_sub_categories'));
    }

    public function create()
    {
        $services = Service::all();
        return view('backend.service_sub_category.create', compact('services'));

    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'service_category_id' => 'required',
            'service_id' => 'required',
//            'description' => 'required'
        ], [
            'service_category_id.required' => 'Service is required.',
            'service_id.required' => 'Category is required.',
//            'description.required' => 'Description is required.'
        ]);
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
        SubCategory::create([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'service_category_id' => $request->get('service_category_id'),
            'category_id' => $request->get('service_id'),
            'description' => $request->get('description'),
            'is_available' => $request->get('is_available'),
            'price' => $request->get('price'),
            'discount_type' => $discount,
            'discount_price' => $price,
        ]);
        return redirect()->route('admin.menu-items.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Menu Item created successfully.'
            ]);

    }

    public function edit($id)
    {
        $service_sub_category = SubCategory::find($id);
        $services = Service::all();
        $service_categories = Category::all();
        return view('backend.service_sub_category.edit', compact('service_sub_category', 'services', 'service_categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'service_category_id' => 'required',
            'service_id' => 'required',
//            'description' => 'required',
        ], [
            'service_category_id.required' => 'Service is required.',
            'service_id.required' => 'Category is required.',
//            'description.required' => 'Description is required.'
        ]);
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
        SubCategory::find($id)->update([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'service_category_id' => $request->get('service_category_id'),
            'category_id' => $request->get('service_id'),
            'description' => $request->get('description'),
            'is_available' => $request->get('is_available'),
            'price' => $request->get('price'),
            'discount_type' => $discount,
            'discount_price' => $price,
        ]);
        return redirect()->route('admin.menu-items.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Menu Item updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $service_sub_category = SubCategory::findOrFail($id);
        $service_sub_category->delete();

        return redirect()->route('admin.menu-items.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Menu Item has been deleted'
            ]);
    }
}
