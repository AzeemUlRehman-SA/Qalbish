<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $memberships = Membership::orderBy('id', 'DESC')->get();
        return view('backend.membership.index', compact('memberships'));
    }

    public function edit($id)
    {
        $membership = Membership::find($id);
        return view('backend.membership.edit', compact('membership'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        Membership::find($id)->update($request->all());
        return redirect()->route('admin.memberships.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Membership updated successfully.'
            ]);

    }

}
