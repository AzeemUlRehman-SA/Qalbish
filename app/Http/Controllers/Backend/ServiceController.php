<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'DESC')->get();

        return view('backend.category.index', compact('services'));
    }

    public function create()
    {
        return view('backend.category.create');

    }
    public function show($id){

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Service::create($request->all());
        return redirect()->route('admin.category.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Category created successfully.'
            ]);

    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('backend.category.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category = Service::find($id);

        $category->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.category.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Category updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.category.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Category has been deleted'
            ]);
    }
}
