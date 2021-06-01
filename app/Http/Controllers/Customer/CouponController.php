<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponUser;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function store(Request $request)
    {

        $response = array('data' => array());
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon) {

            $response['data'] = [
                'flash_status' => 'warning',
                'flash_message' => 'Invalid coupon code. Please try again.',
                'session' => 'no'
            ];
            return $response;

        }

        if ($coupon->count_of_used == 0) {
            $response['data'] = [
                'flash_status' => 'warning',
                'flash_message' => 'Coupon limit has been completed.',
                'session' => 'no'
            ];
            return $response;
        }

        if (Date('Y-m-d') > $coupon->expiry_date) {

            $response['data'] = [
                'flash_status' => 'warning',
                'flash_message' => 'Coupon has expired.',
                'session' => 'no'
            ];
            return $response;
        }

        $couponUser = CouponUser::where([
            'user_id' => auth()->user()->id,
            'coupon_id' => $coupon->id,
            'status' => true
        ])->first();

        if ($couponUser) {

            $response['data'] = [
                'flash_status' => 'warning',
                'flash_message' => 'You have already used this coupon.',
                'session' => 'no'
            ];

            return $response;
        }
//        CouponUser::create([
//            'user_id' => auth()->user()->id,
//            'coupon_id' => $coupon->id,
//            'status' => true
//        ]);
        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => (int)$coupon->discount((int)$request->subtotalvalue),
            'type' => $coupon->type,
            'fixed_price' => $coupon->value,
            'percent_off' => $coupon->percent_off,
        ]);
        if ($coupon->type == 'percent') {
            $response['data'] = [
                'flash_status' => 'success',
                'flash_message' => 'Coupon has been applied!',
                'discount' => (int)$coupon->discount($request->subtotalvalue),
                'name' => $coupon->code,
                'session' => 'yes',
                'percent_off' => $coupon->percent_off,
                'type' => $coupon->type,
                'coupon_id' => $coupon->id
            ];
        } else {
            $response['data'] = [
                'flash_status' => 'success',
                'flash_message' => 'Coupon has been applied!',
                'discount' => $coupon->discount($request->subtotalvalue),
                'name' => $coupon->code,
                'session' => 'yes',
                'fixed_price' => $coupon->value,
                'type' => $coupon->type,
                'coupon_id' => $coupon->id
            ];
        }

//        $counter = $coupon->count_of_used;
//        $coupon->count_of_used = --$counter;
//        $coupon->save();

        return $response;
    }

    public function destroy(Request $request)
    {
        $response = array('data' => array());
        session()->forget('coupon');
        $coupon_user = CouponUser::where('coupon_id', $request->coupon_id)->first();
        $coupon_user->delete();


        $response['data'] = [
            'flash_status' => 'success',
            'flash_message' => 'Coupon has been removed.'
        ];
        return $response;
    }
}
