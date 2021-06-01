<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutus = Aboutus::first();
        return view('backend.aboutus.create', compact('aboutus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'summary' => 'required',
            'description' => 'required',
        ], [
            'summary.required' => 'Summary is required.',
            'description.required' => 'Description is required.'
        ]);
        $aboutus = Aboutus::findOrFail(1);

        $aboutus->update([
            'summary' => $request->summary,
            'description' => $request->description
        ]);
        return back()->with([
            'flash_status' => 'success',
            'flash_message' => 'About us description updated successfully.'
        ]);
    }
}
