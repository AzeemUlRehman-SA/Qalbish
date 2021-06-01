<?php

namespace App\Http\Controllers\Api;

use App\Events\SendReferralCodeWithPhone;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\Staff\OrderResource as StaffOrderResource;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\FirstOrderDiscount;
use App\Models\MembershipDiscount;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderMenuItemAddon;
use App\Models\Rating;
use App\Models\ReferralDiscount;
use App\Models\User;
use App\Models\UserReferral;
use App\Traits\GeneralHelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use GeneralHelperTrait;

    public function orders()
    {
        try {

            $user = Auth::user();
            return response()->json(['data' => StaffOrderResource::collection(Order::where('customer_id', $user->id)->orderBy('id', 'desc')->get())], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function store(Request $request)
    {
        $finalOrder = json_decode($request->finalOrder, true);
        $validator = Validator::make($finalOrder, [
            'noOfPeople' => 'required',
            'requestedDatetime' => 'required',
            'time' => 'required',
            'subtotal' => 'required',
            'totalPrice' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            $referral_amount = null;
            $first_order_amount = null;
            $membership_amount = null;
            $coupon_amount = null;


            if (!empty($finalOrder)) {
                $user = Auth::user();
                $referral_users = UserReferral::where('user_id', $user->id)->where('status', 'pending')->first();
                if (isset($user->membership_id)) {
                    $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                    if ($membership_discount->type == 'fixed') {
                        $membership_amount = (int)$membership_discount->value;
                    } elseif ($membership_discount->type == 'percentage') {
                        $membership_amount = (int)$finalOrder['subtotal'] * (((int)$membership_discount->percent_off / 100));
                    } else {
                        $membership_amount = null;
                    }
                } else {
                    $membership_amount = null;
                }
                if ($user->orders()->count() == 0) {
                    $first_order_discount = FirstOrderDiscount::first();

                    if ($first_order_discount->type == 'fixed') {
                        $first_order_amount = (int)$first_order_discount->value;
                    } elseif ($first_order_discount->type == 'percentage') {
                        $first_order_amount = (int)$finalOrder['subtotal'] * (((int)$first_order_discount->percent_off / 100));
                    } else {
                        $first_order_amount = null;
                    }
                    $referral_discount = null;
                    $coupon_amount = null;

                } elseif (!is_null($referral_users)) {
                    $referral_discount = ReferralDiscount::first();
                    $referral_user_id = $referral_users->id;

                    if ($referral_discount->type == 'fixed') {
                        $referral_amount = (int)$referral_discount->value;
                    } elseif ($referral_discount->type == 'percentage') {
                        $referral_amount = (int)$finalOrder['subtotal'] * (((int)$referral_discount->percent_off / 100));
                    } else {
                        $referral_amount = null;
                    }

                    if (!is_null($referral_user_id)) {
                        $user_referrals = UserReferral::where('user_id', $user->id)->where('status', 'pending')->first();
                        $user_referrals->status = 'taken';
                        $user_referrals->save();
                    }

                    $first_order_amount = null;
                    $coupon_amount = null;
                } elseif (!is_null($finalOrder['coupon_code'])) {

                    $coupon = Coupon::where('code', $finalOrder['coupon_code'])->first();

                    if ($coupon->count_of_used == 0) {
                        return response()->json(['message' => 'Coupon limit has been completed.'], 200);
                    }

                    if (Date('Y-m-d') > $coupon->expiry_date) {
                        return response()->json(['message' => 'Coupon has expired.'], 200);
                    }

                    $couponUser = CouponUser::where([
                        'user_id' => $user->id,
                        'coupon_id' => $coupon->id,
                        'status' => true
                    ])->first();

                    if ($couponUser) {
                        return response()->json(['message' => 'You have already used this coupon.'], 200);
                    }

                    CouponUser::create([
                        'user_id' => $user->id,
                        'coupon_id' => $coupon->id,
                        'status' => true
                    ]);


                    if ($coupon->type == 'fixed') {
                        $coupon_amount = (int)$coupon->value;
                    } elseif ($coupon->type == 'percentage') {
                        $coupon_amount = (int)$coupon->discount((int)$finalOrder['subtotal']);
                    } else {
                        $coupon_amount = null;
                    }

                    $counter = $coupon->count_of_used;
                    $coupon->count_of_used = --$counter;
                    $coupon->save();


                    $first_order_amount = null;
                    $referral_discount = null;
                } else {
                    $coupon_amount = null;
                    $referral_amount = null;
                    $first_order_amount = null;
                }
                $order_id = $this->orderNumber();

                $order = Order::create([

                    'customer_id' => $user->id,
                    'order_id' => $order_id,
                    'area_id' => $user->area_id,
                    'city_id' => $user->city_id,
                    'address' => $user->address,
                    'phone_number' => $user->phone_number,
                    'total_persons' => $finalOrder['noOfPeople'],
                    'special_instruction' => $finalOrder['specialInstructions'],
                    'requested_date_time' => $finalOrder['requestedDatetime'] . ' ' . $finalOrder['time'],
                    'total_price' => $finalOrder['subtotal'],
                    'grand_total' => $finalOrder['totalPrice'],
                    'order_status' => 'pending',
                    'membership_discount' => $membership_amount,
                    'first_order_discount' => $first_order_amount,
                    'referral_discount' => $referral_amount,
                    'alternate_address' => $finalOrder['alternateAddress'],
                    'coupon_discount' => $coupon_amount,
                    'delivery_charges' => (int)$user->area->price,
                    'time_zone' => $finalOrder['timeZone'],

                ]);


                if (!empty($finalOrder['services'])) {
                    foreach ($finalOrder['services'] as $service) {
                        if ($service['type'] == 'Service') {
                            $order_details = OrderDetail::create([
                                'order_id' => $order->id,
                                'category_id' => $user->category_id,
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
                                'category_id' => $user->category_id,
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
//                $remove_zero = ltrim($user->phone_number, '0');
//                $add_number = '92';
//                $phone_number = $add_number . $remove_zero;
                $message = 'Thank you for booking an appointment with Qalbish!';
                $message2 = 'Someone from our team will be calling you shortly to confirm your appointment.Your Order ID is:' . $order_id . '.';

                $phone_number = $user->phone_number;
                $message3 = 'Thank you for booking an appointment with Qalbish!Someone from our team will be calling you shortly to confirm your appointment.Your Order ID is:' . $order_id . '.';
                event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message3));


                $admin_phone_number = User::where('user_type', 'admin')->first()->phone_number;
                $message4 = 'Customer ' . $user->fullName() . ' has requested for a service. Please call customer to confirm appointment.Order ID is :' . $order_id . '';
                event(new SendReferralCodeWithPhone($user_name = '', $admin_phone_number, $message4));


                return response()->json(['status' => true, 'message' => $message, 'message2' => $message2, 'data' => StaffOrderResource::collection(Order::where('id', $order->id)->get())], 200);
            } else {
                return response()->json(['status' => true, 'message' => 'Data  not found'], 401);
            }

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }


    }

    public function rating(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'time' => 'required',
            'professionalism' => 'required',
            'service' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            $order = Order::whereId($request->order_id)->first();
            $rating = Rating::where('order_id', $request->order_id)->get();

            if (!empty($rating) && $rating->count() > 0) {


//
//                $rating->update([
//                    'staff_id' => $order->staff_id,
//                    'customer_id' => $order->customer_id,
//                    'rate_star_1' => $request->time,
//                    'rate_star_2' => $request->professionalism,
//                    'rate_star_3' => $request->service,
//                ]);

                return response()->json(['status' => true, 'message' => 'You has already rate this staff.'], 200);
            } else {
                Rating::create([
                    'order_id' => $order->id,
                    'staff_id' => $order->staff_id,
                    'customer_id' => $order->customer_id,
                    'rate_star_1' => $request->time,
                    'rate_star_2' => $request->professionalism,
                    'rate_star_3' => $request->service,
                ]);

                return response()->json(['status' => true, 'message' => 'You have successfully rate this staff.'], 200);

            }


        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }

    }
}
