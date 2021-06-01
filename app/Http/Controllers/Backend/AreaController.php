<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AreasImport;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $areas = Area::orderBy('id', 'DESC')->get();

        return view('backend.areas.index', compact('areas'));
    }

    public function create()
    {
        $cities = City::all();
        return view('backend.areas.create', compact('cities'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required',
            'city_id' => 'required'
        ], [
            'city_id.required' => 'City is required.'
        ]);
        Area::create($request->all());
        return redirect()->route('admin.areas.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Area created successfully.'
            ]);

    }

    public function edit($id)
    {
        $area = Area::find($id);
        $cities = City::all();
        return view('backend.areas.edit', compact('area', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required',
            'city_id' => 'required'
        ], [
            'city_id.required' => 'City is required.'
        ]);
        Area::find($id)->update($request->all());
        return redirect()->route('admin.areas.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Area updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('admin.areas.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Area has been deleted'
            ]);
    }

    public function importFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        if (!$validator->fails()) {

            Excel::import(new AreasImport(), $request->file('file'));

            $status = 'success';
            $message = 'Area File Imported Successfully.';
        } else {
            $status = 'error';
            $message = 'File Format is not correct or Incorrect Data.';
        }

        return redirect()->route('admin.areas.index')
            ->with([
                'flash_status' => $status,
                'flash_message' => $message
            ]);
    }
}
