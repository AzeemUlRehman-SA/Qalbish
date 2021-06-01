<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ManagingPartener;
use Illuminate\Http\Request;

class ManagingPartenerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $managing_parteners = ManagingPartener::orderBy('id', 'DESC')->get();

        return view('backend.managing_parteners.index', compact('managing_parteners'));
    }

    public function create()
    {
        return view('backend.managing_parteners.create');

    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'image'                 => 'required|mimes:jpg,jpeg,png|max:2048',
        ], [
            'image.required' => 'Image  is required.',
        ]);

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/managing_parteners');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $profile_image = $name;
        } else {
            $profile_image = null;
        }
        ManagingPartener::create([
            'title' => $request->title,
            'designation' => $request->designation,
            'description' => $request->description,
            'image' => $profile_image,

        ]);
        return redirect()->route('admin.managing-parteners.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Managing Partener created successfully.'
            ]);

    }

    public function edit($id)
    {
        $managing_partener = ManagingPartener::find($id);
        return view('backend.managing_parteners.edit', compact('managing_partener'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'image'                 => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        $managing_partener = ManagingPartener::find($id);
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/managing_parteners');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $profile_image = $name;
        } else {
            $profile_image = $managing_partener->image;
        }
        $managing_partener->update([
            'title' => $request->title,
            'designation' => $request->designation,
            'description' => $request->description,
            'image' => $profile_image,
        ]);

        return redirect()->route('admin.managing-parteners.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Managing Partener updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $managing_partener = ManagingPartener::findOrFail($id);
        $managing_partener->delete();

        return redirect()->route('admin.managing-parteners.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Managing Partener has been deleted'
            ]);
    }
}
