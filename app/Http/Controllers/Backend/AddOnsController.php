<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\AddOn;
use Illuminate\Http\Request;

class AddOnsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $service_sub_categories_addons = AddOn::orderBy('id', 'DESC')->get();

        return view('backend.service_sub_category_addons.index', compact('service_sub_categories_addons'));
    }

    public function create()
    {
        $services = Service::all();
        $service_sub_categories = SubCategory::all();
        return view('backend.service_sub_category_addons.create', compact('service_sub_categories', 'services'));

    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                       => 'required',
            'slug'                       => 'required',
            'service_id'                 => 'required',
            'service_category_id' => 'required',
            'service_sub_category_id' => 'required'
        ], [
            'service_id.required' => 'Category is required.',
            'service_category_id.required' => 'Service is required.',
            'service_sub_category_id.required' => 'Sub Category is required.'
        ]);
        AddOn::create([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'category_id' => $request->get('service_id'),
            'service_category_id' => $request->get('service_category_id'),
            'service_sub_category_id' => $request->get('service_sub_category_id'),
            'price' => $request->get('price')
        ]);
        return redirect()->route('admin.addons.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Addons created successfully.'
            ]);

    }

    public function edit($id)
    {
        $service_sub_category_addon = AddOn::find($id);
        $service_sub_categories = SubCategory::where('id', $service_sub_category_addon->service_sub_category_id)->get();
        $categories = Service::all();
        $services = Category::where('id', $service_sub_category_addon->service_category_id)->get();
        return view('backend.service_sub_category_addons.edit', compact('service_sub_category_addon', 'service_sub_categories', 'categories', 'services'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'service_id' => 'required',
            'service_category_id' => 'required',
            'service_sub_category_id' => 'required'
        ], [
            'service_id.required' => 'Category is required.',
            'service_category_id.required' => 'Service is required.',
            'service_sub_category_id.required' => 'Sub Category is required.'
        ]);
        AddOn::find($id)->update([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'category_id' => $request->get('service_id'),
            'service_category_id' => $request->get('service_category_id'),
            'service_sub_category_id' => $request->get('service_sub_category_id'),
            'price' => $request->get('price')
        ]);
        return redirect()->route('admin.addons.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Addons updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $service_sub_category_addons = AddOn::findOrFail($id);
        $service_sub_category_addons->delete();

        return redirect()->route('admin.addons.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Addons has been deleted'
            ]);
    }
}
