<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{

    public function index()
    {
        $referrals = UserReferral::where('user_id', auth()->user()->id)->get();


        foreach ($referrals as $referral) {
            $referral_user = User::where('phone_number', $referral->referral_register_phone_no)->get();

        }
        return view('customer.referrals.index', compact('referrals', 'referral_user'));
    }

}
