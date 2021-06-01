<?php

namespace App\Http\Controllers\Frontend;

use App\Events\SendReferralCodeWithPhone;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\FirstOrderDiscount;
use App\Models\MembershipDiscount;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderMenuItemAddon;
use App\Models\ReferralDiscount;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Http\Request;
use App\Traits\GeneralHelperTrait;

class OrderController extends Controller
{
    use GeneralHelperTrait;

    public function orderDetail()
    {
        $user = auth()->user();
        $city_name = City::where('id', $user->city_id)->first()->name;
        $areas = Area::where('id', $user->area_id)->get();

//        dd($areas);
        $referral_users = UserReferral::where('user_id', $user->id)->where('status', 'pending')->first();
        if (!is_null($referral_users)) {
            $referral_discount = ReferralDiscount::first();
            $referral_user_id = $referral_users->id;
            if (isset($user->membership_id)) {
                $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                return view('frontend.pages.orders.order_details', compact('user', 'city_name', 'areas', 'membership_discount', 'referral_discount', 'referral_user_id'));

            } else {
                return view('frontend.pages.orders.order_details', compact('user', 'city_name', 'areas', 'referral_discount', 'referral_user_id'));

            }


        }
        if ($user->orders()->count() == 0) {
            $first_order_discount = FirstOrderDiscount::first();
            if (isset($user->membership_id)) {
                $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                return view('frontend.pages.orders.order_details', compact('user', 'city_name', 'areas', 'membership_discount', 'first_order_discount'));

            } else {
                return view('frontend.pages.orders.order_details', compact('user', 'city_name', 'areas', 'first_order_discount'));

            }

        }
        if (isset($user->membership_id)) {
            $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
            return view('frontend.pages.orders.order_details', compact('user', 'city_name', 'areas', 'membership_discount'));

        } else {
            return view('frontend.pages.orders.order_details', compact('user', 'city_name', 'areas'));

        }
    }

    public function orderReview()
    {
        $user = auth()->user();
        $city_name = City::where('id', $user->city_id)->first()->name;
        $areas = Area::where('id', $user->area_id)->get();

        $referral_users = UserReferral::where('user_id', $user->id)->where('status', 'pending')->first();

        if (!is_null($referral_users)) {
            $referral_discount = ReferralDiscount::first();
            $referral_user_id = $referral_users->id;
            if (isset($user->membership_id)) {
                $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                return view('frontend.pages.orders.order-review', compact('user', 'city_name', 'areas', 'membership_discount'));

            } else {
                return view('frontend.pages.orders.order-review', compact('user', 'city_name', 'areas'));

            }


        }
        if ($user->orders()->count() == 0) {
            $first_order_discount = FirstOrderDiscount::first();
            if (isset($user->membership_id)) {
                $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                return view('frontend.pages.orders.order-review', compact('user', 'city_name', 'areas', 'membership_discount', 'first_order_discount'));

            } else {
                return view('frontend.pages.orders.order-review', compact('user', 'city_name', 'areas', 'first_order_discount'));

            }

        }
        if (isset($user->membership_id)) {
            $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
            return view('frontend.pages.orders.order-review', compact('user', 'city_name', 'areas', 'membership_discount'));

        } else {
            return view('frontend.pages.orders.order-review', compact('user', 'city_name', 'areas'));

        }

    }

    public function finalOrder(Request $request)
    {
        if (!empty($request->finalOrder)) {
            $order_id = $this->orderNumber();


            if (!is_null($request->couponDiscount['code'])) {

                $coupon = Coupon::where('code', $request->couponDiscount['code'])->first();

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


                CouponUser::create([
                    'user_id' => auth()->user()->id,
                    'coupon_id' => $coupon->id,
                    'status' => true
                ]);


                if ($coupon->type == 'fixed') {
                    $coupon_amount = (int)$coupon->value;
                } elseif ($coupon->type == 'percentage') {

                    $coupon_amount = (int)$coupon->discount((int)$request->finalOrder['grandTotal']);
                } else {
                    $coupon_amount = null;
                }

                $counter = $coupon->count_of_used;
                $coupon->count_of_used = --$counter;
                $coupon->save();

            } else {
                $coupon_amount = null;
            }

            $order = Order::create([

                'customer_id' => auth()->user()->id,
                'order_id' => $order_id,
                'area_id' => $request->finalOrder['areaId'],
                'city_id' => $request->finalOrder['cityId'],
                'address' => $request->finalOrder['address'],
                'phone_number' => $request->finalOrder['mobileNumber'],
                'total_persons' => $request->finalOrder['noOfPeople'],
                'special_instruction' => $request->finalOrder['specialInstructions'],
                'requested_date_time' => $request->finalOrder['requestedDatetime'] . ' ' . $request->finalOrder['time'],
                'total_price' => $request->finalOrder['subtotal'],
                'grand_total' => $request->finalOrder['totalPrice'],
                'order_status' => 'pending',
                'membership_discount' => $request->orderDiscount['memberships_discount'],
                'first_order_discount' => $request->orderDiscount['first_order_discount'],
                'referral_discount' => $request->orderDiscount['referral_discount'],
                'alternate_address' => $request->finalOrder['alternateAddress'],
                'coupon_discount' => $coupon_amount,
                'delivery_charges' => (int)auth()->user()->area->price,
                'time_zone' => $request->finalOrder['timeZone'],

            ]);

            if (!is_null($request->orderDiscount['referral_discount']) && !empty($request->orderDiscount['referral_discount'])) {

                $user_referrals = UserReferral::where('user_id', auth()->user()->id)->where('status', 'pending')->first();
                $user_referrals->status = 'taken';
                $user_referrals->save();

            }


            if (!empty($request->finalOrder['services'])) {
                foreach ($request->finalOrder['services'] as $service) {
                    if ($service['type'] == 'Service') {
                        $order_details = OrderDetail::create([
                            'order_id' => $order->id,
                            'category_id' => auth()->user()->category_id,
                            'service_id' => $service['subcategoryId'],
                            'menu_item_id' => $service['id'],
                            'name' => $service['name'],
                            'quantity' => $service['quantity'],
                            'amount' => $service['amount'],
                            'duration' => $service['duration'],
                            'type' => $service['type'],
                        ]);
                        if (!empty($service['addOns'])) {
                            foreach ($service['addOns'] as $addOn) {
                                OrderMenuItemAddon::create([
                                    'order_details_id' => $order_details->id,
                                    'menu_item_id' => $addOn['subcategoryId'],
                                    'add_on_id' => $addOn['id'],
                                    'name' => $addOn['name'],
                                    'quantity' => $addOn['quantity'],
                                    'amount' => $addOn['amount'],
                                    'duration' => $addOn['duration'],
                                ]);
                            }
                        }
                    } else {
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'category_id' => auth()->user()->category_id,
                            'package_id' => $service['id'],
                            'name' => $service['name'],
                            'quantity' => $service['quantity'],
                            'amount' => $service['amount'],
                            'duration' => $service['duration'],
                            'type' => $service['type'],

                        ]);
                    }
                }

            }
//            $remove_zero = ltrim(auth()->user()->phone_number, '0');
//            $add_number = '92';
//            $phone_number = $add_number . $remove_zero;
            $phone_number = auth()->user()->phone_number;
            $message = 'Thank you for booking an appointment with Qalbish. Someone from our team will be calling you shortly to confirm your appointment.Your Order ID is :' . $order_id . '';
            event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));


            $admin_phone_number = User::where('user_type', 'admin')->first()->phone_number;
            $message1 = 'Customer ' . auth()->user()->fullName() . ' has requested for a service. Please call customer to confirm appointment.Order ID is :' . $order_id . '';
            event(new SendReferralCodeWithPhone($user_name = '', $admin_phone_number, $message1));

            $response['data'] = [
                'flash_status' => 'success',
                'flash_message' => 'Order Created Successfully.',
                'order_id' => $order->id
            ];

        } else {
            $response['data'] = [
                'flash_status' => 'error',
                'flash_message' => 'Something Went Wrong.Please Try Again.',
            ];

        }
        return $response;

    }
}
