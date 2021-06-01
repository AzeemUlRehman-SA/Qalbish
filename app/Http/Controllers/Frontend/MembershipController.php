<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\MembershipDetails;
use Illuminate\Http\Request;
use Session;

class MembershipController extends Controller
{
    public function index()
    {

        $membership_details = MembershipDetails::first();
        $memberships = Membership::all();
        return view('frontend.pages.membership', compact('membership_details', 'memberships'));
    }
}
