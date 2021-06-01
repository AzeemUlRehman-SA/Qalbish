<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('backend.privacypolicy.create', compact('privacyPolicy'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
        ], [
            'description.required' => 'Description is required.'
        ]);
        $privacyPolicy = PrivacyPolicy::findOrFail(1);

        $privacyPolicy->update([
            'description' => $request->description
        ]);
        return back()->with([
            'flash_status' => 'success',
            'flash_message' => 'Privacy Policy description updated successfully.'
        ]);
    }
}
