<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\FirstOrderDiscount;
use App\Models\MembershipDiscount;
use App\Models\ReferralDiscount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function index()
    {
        $membership_discounts = MembershipDiscount::orderBy('id', 'DESC')->get();
        $coupon_discounts = Coupon::orderBy('id', 'DESC')->get();
        $referral_discounts = ReferralDiscount::orderBy('id', 'DESC')->get();
        $first_order_discounts = FirstOrderDiscount::orderBy('id', 'DESC')->get();
        return view('backend.discounts.index', compact('coupon_discounts', 'membership_discounts', 'referral_discounts', 'first_order_discounts'));
    }
}
