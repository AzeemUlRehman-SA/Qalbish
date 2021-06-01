<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $user_referrals = UserReferral::orderBy('id', 'DESC')->get();

//        foreach ($user_referrals as $referral) {
//            $referred_to[] = User::where('id', $referral->referred_id)->first();
//
//        }
        return view('backend.referral.index', compact('user_referrals'));
    }
}
