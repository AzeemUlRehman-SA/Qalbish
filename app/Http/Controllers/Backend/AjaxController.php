<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AddOn;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\DealSubCategoryAddon;
use App\Models\FirstOrderDiscount;
use App\Models\MembershipDiscount;
use App\Models\Order;
use App\Models\Rating;
use App\Models\ReferralDiscount;
use App\Models\Staff;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    public function cityArea(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'city_id' => 'required|exists:cities,id'
        ], [
            'city_id.required' => "City is Required.",
            'city_id.exists' => "Invalid City Selected."
        ]);

        if (!$validator->fails()) {
            $area = Area::where('city_id', $request->city_id)->get();

            $response['status'] = 'success';
            $response['data'] = [
                'area' => $area,
            ];
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;
    }

    public function serviceCategory(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id'
        ], [
            'service_id.required' => "Service is Required.",
            'service_id.exists' => "Invalid Service Selected."
        ]);

        if (!$validator->fails()) {
            $service_category = Category::where('service_id', $request->service_id)->get();

            $response['status'] = 'success';
            $response['data'] = [
                'service_category' => $service_category,
            ];
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;
    }

    public function serviceSubCategory(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:service_categories,id'
        ], [
            'service_id.required' => "Service is Required.",
            'service_id.exists' => "Invalid Service Selected."
        ]);

        if (!$validator->fails()) {
            $service_category = SubCategory::where('service_category_id', $request->service_id)->get();

            $response['status'] = 'success';
            $response['data'] = [
                'service_category' => $service_category,
            ];
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;
    }

    public function packageServiceSubCategory(Request $request)
    {
//        dd($request->service_id);
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:service_categories,id'
        ], [
            'service_id.required' => "Service is Required.",
            'service_id.exists' => "Invalid Service Selected."
        ]);

//
//        if (Session::has('service_category_id')) {
//            $session_value = Session::get('service_category_id');
//
//            Session::forget('service_category_id');
//            $service_id = $request->service_id;
////            dd($service_id);
//            foreach ($service_id as $ser_id) {
//
//                if (in_array($ser_id, $session_value[0])) {
//                    break;
//                } else {
//                    Session::push('service_category_id', $session_value);
//                    Session::push('service_category_id', $ser_id);
//                    if (!$validator->fails()) {
//                        $service_category = SubCategory::where('service_category_id', $ser_id)->get();
//                        $response['status'] = 'success';
//                        $response['data'] = [
//                            'service_category' => $service_category,
//                        ];
//                    } else {
//                        $response['status'] = 'error';
//                        $response['message'] = "Validation Errors.";
//                        $response['data'] = $validator->errors()->toArray();
//                    }
//                }
//
//            }
//        } else {
//            Session::push('service_category_id', $request->service_id);
        if (!$validator->fails()) {
            $service_category = SubCategory::where('service_category_id', $request->service_id)->get();
            $response['status'] = 'success';
            $response['data'] = [
                'service_category' => $service_category,
            ];
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }
//        }

        return $response;
    }

    public function serviceSubCategoryAddon(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:service_sub_categories,id'
        ], [
            'service_id.required' => "Menu Item is Required.",
            'service_id.exists' => "Invalid Service Selected."
        ]);

        if (!$validator->fails()) {
            $service_sub_category_addon = AddOn::where('service_sub_category_id', $request->service_id)->get();

            $response['status'] = 'success';
            $response['data'] = [
                'service_sub_category_addon' => $service_sub_category_addon,
            ];
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;
    }


    public function assignMembership(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'membership_id' => 'required|exists:memberships,id'
        ], [
            'membership_id.required' => "Membership is Required.",
            'membership_id.exists' => "Invalid Membership Selected."
        ]);

        if (!$validator->fails()) {
            $user = User::where('id', $request->get('user_id'))->update([
                'membership_id' => (int)$request->get('membership_id'),
            ]);

            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;

    }


    public function customerServiceCategory(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:users,id'
        ], [
            'customer_id.required' => "Customer is Required.",
            'customer_id.exists' => "Invalid Customer Selected."
        ]);

        $user = User::where('id', $request->customer_id)->first();

        $city_name = City::where('id', $user->city_id)->first()->name;
        $area_name = Area::where('id', $user->area_id)->first()->name;


        if (!$validator->fails()) {
            $service_category = Category::where('service_id', $user->category_id)->get();

            $response['status'] = 'success';
            $response['data'] = [
                'service_category' => $service_category,
                'user' => $user,
                'city_name' => $city_name,
                'area_name' => $area_name,
            ];
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;
    }

    public function getDiscounts(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:users,id'
        ], [
            'customer_id.required' => "Customer is Required.",
            'customer_id.exists' => "Invalid Customer Selected."
        ]);


        if (!$validator->fails()) {

            $referral_users = UserReferral::where('user_id', $request->customer_id)->where('status', 'pending')->first();
            $user = User::where('id', $request->customer_id)->first();
            if (!is_null($referral_users)) {
                $referral_discount = ReferralDiscount::first();


                if (isset($user->membership_id)) {
                    $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                    $response['status'] = 'success';
                    $response['data'] = [
                        'membership_discount' => $membership_discount,
                        'user' => $user,
                        'referral_discount' => $referral_discount,
                    ];

                } else {
                    $response['data'] = [

                        'user' => $user,
                        'referral_discount' => $referral_discount,
                    ];
                }

            }
            if ($user->orders()->count() == 0) {
                $first_order_discount = FirstOrderDiscount::first();
                if (isset($user->membership_id)) {
                    $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                    $response['status'] = 'success';
                    $response['data'] = [
                        'membership_discount' => $membership_discount,
                        'user' => $user,
                        'first_order_discount' => $first_order_discount,
                    ];

                } else {
                    $response['data'] = [

                        'user' => $user,
                        'first_order_discount' => $first_order_discount,
                    ];
                }

            }
            if (isset($user->membership_id)) {
                $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                $response['status'] = 'success';
                $response['data'] = [
                    'membership_discount' => $membership_discount,
                    'user' => $user,
                ];

            }

        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }


        return $response;
    }


    public function orderStatus(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'order_status' => 'required'
        ], [
            'order_status.required' => "Order Status is Required.",

        ]);

        if (!$validator->fails()) {
            $order = Order::where('id', $request->get('order_id'))->update([
                'order_status' => $request->order_status,
            ]);

            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;

    }

    public function assignStaff(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'staff_id' => 'required|exists:users,id'
        ], [
            'staff_id.required' => "Staff is Required.",
            'staff_id.exists' => "Invalid Staff Selected."
        ]);


        $user = User::where('id', $request->staff_id)->first();
        if (!$validator->fails()) {
            $order = Order::where('id', $request->get('order_id'))->update([
                'order_status' => 'assigned',
                'staff_status' => 'pending',
                'staff_id' => $request->staff_id,
                'suggested_staff' => $user->fullName()
            ]);

            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;

    }


    public function assignDriver(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:drivers,id'
        ], [
            'driver_id.required' => "Driver is Required.",
            'driver_id.exists' => "Invalid Driver Selected."
        ]);
        if (!$validator->fails()) {
            $order = Staff::where('id', $request->get('staff_id'))->update([
                'driver_id' => $request->driver_id,
                'driver_status' => 'assigned',

            ]);

            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;

    }


    public function staffRating(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());


        $rating = Rating::where('order_id', $request->order_id)->get();
        if (!empty($rating) && $rating->count() > 0) {
            $staff_rating = $rating->update([
                'staff_id' => $request->staff_id,
                'customer_id' => $request->customer_id,
                'rate_star_1' => $request->rate_stat_1,
                'rate_star_2' => $request->rate_stat_2,
                'rate_star_3' => $request->rate_stat_3,
            ]);
        } else {
            $staff_rating = Rating::create([
                'order_id' => $request->order_id,
                'staff_id' => $request->staff_id,
                'customer_id' => $request->customer_id,
                'rate_star_1' => $request->rate_stat_1,
                'rate_star_2' => $request->rate_stat_2,
                'rate_star_3' => $request->rate_stat_3,
            ]);

        }

        Session::forget('pendingRatingOrder');
        $response['status'] = 'success';


        return $response;

    }

    public function getLatLng(Request $request)
    {

        $response = array('status' => '', 'message' => "", 'data' => array());

        $order = Order::findOrFail($request->order_id);
        $staff_latlng = User::where('id', $order->staff_id)->first();
        $customer_latlng = User::where('id', $order->customer_id)->first();
        $response['status'] = 'success';
        $response['data'] = [
            'staff_latlng' => $staff_latlng,
            'customer_latlng' => $customer_latlng,
        ];


        return $response;
    }


}
