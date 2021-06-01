<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $cities = City::orderBy('id', 'DESC')->get();

        return view('backend.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('backend.cities.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        City::create($request->all());
        return redirect()->route('admin.cities.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'City created successfully.'
            ]);

    }

    public function edit($id)
    {
        $city = City::find($id);
        return view('backend.cities.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        City::find($id)->update($request->all());
        return redirect()->route('admin.cities.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'City updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('admin.cities.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'City has been deleted'
            ]);
    }
}
