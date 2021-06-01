<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MembershipDetails;
use Illuminate\Http\Request;

class MembershipDetailsController extends Controller
{
    public function index()
    {
        $membership_detail = MembershipDetails::first();
        return view('backend.membership-details.create', compact('membership_detail'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ], [
            'description.required' => 'Description is required.'
        ]);
        $membership_detail = MembershipDetails::findOrFail(1);

        $membership_detail->update([
            'title' => $request->title,
            'description' => $request->description

        ]);
        return back()->with([
            'flash_status' => 'success',
            'flash_message' => 'Details updated successfully.'
        ]);

    }
}
