<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PackageResource;
use App\Http\Resources\UserResource;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Deal;
use App\Models\FirstOrderDiscount;
use App\Models\MembershipDiscount;
use App\Models\Order;
use App\Models\ReferralDiscount;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    public function cities()
    {
        try {
            return response()->json(['data' => City::orderBy('name', 'asc')->get()], 200);
        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function areas($city_id)
    {
        try {

            return response()->json(['data' => Area::where('city_id', $city_id)->orderBy('name', 'asc')->get()], 200);
        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function genders()
    {
        try {

            return response()->json(['data' => Service::orderBy('name', 'asc')->get()], 200);
        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function discounts()
    {
        try {

            $user = Auth::user();
            return response()->json(['data' => $this->getDiscounts(),], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function services()
    {
        try {

            $package = [
                'name' => 'PACKAGES',
                'package_descritpipn' => 'Book our special packages and save up to 70% off your favourite treatments.',
                'image' => asset('/uploads/packages/1140x420_0002_03.jpg'),
                'thumbnail' => asset('/uploads/packages/thumbnails/8.png')
            ];
            $user = Auth::user();
            return response()->json([
                'discounts' => $this->getDiscounts(),
                'data' => CategoryResource::collection(Category::where('service_id', $user->category_id)->get()),
                'packages' => PackageResource::collection(Deal::where('category_id', $user->category_id)->orderBy('name', 'asc')->get()),
                'packageInformation' => $package,
            ],
                200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function packages()
    {
        try {

            $user = Auth::user();
            return response()->json([
                'data' => PackageResource::collection(Deal::where('category_id', $user->category_id)->orderBy('name', 'asc')->get()),
            ],
                200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function coupon(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|exists:coupons,code',
            'sub_total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $coupon = Coupon::where('code', $request->coupon_code)->first();

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

//            CouponUser::create([
//                'user_id' => Auth::user()->id,
//                'coupon_id' => $coupon->id,
//                'status' => true
//            ]);


            if ($coupon->type == 'percent') {
                $response = [
                    'status' => 'success',
                    'message' => 'Coupon has been applied!',
                    'discount' => $coupon->discount($request->sub_total),
                    'type' => $coupon->type,
                    'percent_off' => $coupon->percent_off,
                    'coupon_id' => $coupon->id
                ];
            } else {
                $response = [
                    'status' => 'success',
                    'message' => 'Coupon has been applied!',
                    'discount' => $coupon->discount($request->sub_total),
                    'fixed_price' => $coupon->value,
                    'type' => $coupon->type,
                    'coupon_id' => $coupon->id
                ];
            }

//            $counter = $coupon->count_of_used;
//            $coupon->count_of_used = --$counter;
//            $coupon->save();

            return response()->json(['data' => $response], 201);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function settings()
    {
        try {

            return response()->json(['data' => Setting::get()], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function getDiscounts()
    {

        $data = [
            'membership_discount' => null,
            'referral_discount' => null,
            'first_order_discount' => null,
            'coupon_discount' => true,
        ];

        $user = Auth::user();
        $referral_users = UserReferral::where('user_id', $user->id)->where('status', 'pending')->first();

        if ($user->orders()->count() == 0) {

            $first_order_discount = FirstOrderDiscount::first();

            if (isset($user->membership_id) && !is_null($user->membership_id)) {

                $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                $data['membership_discount'] = $membership_discount;
                $data['first_order_discount'] = $first_order_discount;
                $data['coupon_discount'] = false;


            } else {
                $data['first_order_discount'] = $first_order_discount;
                $data['coupon_discount'] = false;
            }

        } elseif (!is_null($referral_users)) {

            $referral_discount = ReferralDiscount::first();

            if (isset($user->membership_id) && !is_null($user->membership_id)) {
                $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                $data['membership_discount'] = $membership_discount;
                $data['referral_discount'] = $referral_discount;
                $data['coupon_discount'] = false;

            } else {
                $data['referral_discount'] = $referral_discount;
                $data['coupon_discount'] = false;
            }

        } else {
            if (isset($user->membership_id) && !is_null($user->membership_id)) {
                $membership_discount = MembershipDiscount::where('id', $user->membership_id)->first();
                $data['membership_discount'] = $membership_discount;
                $data['coupon_discount'] = true;
            } else {
                $data['coupon_discount'] = true;
            }

        }

        return $data;
    }

    public function userReferral()
    {
        try {

            $user = Auth::user();
            return response()->json(['data' => UserReferral::whereUserId($user->id)->get()], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function updateProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,jpg,png|required|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            $user = Auth::user();
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/user_profiles');
            $image->move($destinationPath, $name);
            $profile_image = $name;


            $user->update([
                'profile_pic' => $profile_image,
            ]);
            return response()->json(['status' => true, 'message' => 'Profile image updated successfully.', 'data' => new UserResource($user)], 200);


        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function updateProfile(Request $request)
    {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
//            'first_name'    => 'required|string',
//            'last_name'     => 'required|string',
            'email' => 'required|string|email|max:255',
//            'gender'        => 'required',
//            'age'           => 'required',
            'phone_number' => 'required|min:11|max:11|unique:users,phone_number,' . $user->id,
//            'cnic'          => 'required|min:12|max:12|unique:users,cnic,'.$user->id,
            'address' => 'required',
//            'city_id'       => 'required|integer',
//            'area_id'       => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            $user->update([
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);

//            User::whereId($user->id)->update([
////                'first_name'    => $request->first_name,
////                'last_name'     => $request->last_name,
//                'email' => $request->email,
////                'category_id'   => $request->gender,
////                'age'           => $request->age,
//                'phone_number' => $request->phone_number,
////                'cnic'          => $request->cnic,
//                'address' => $request->address,
////                'city_id'       => $request->city_id,
////                'area_id'       => $request->area_id,
//            ]);

            return response()->json(['status' => true, 'message' => 'Profile updated successfully.','data' => new UserResource($user)], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }

    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try {

            if (!(Hash::check($request->get('current-password'), $user->password))) {
                // The passwords matches
                return response()->json(['status' => 'error', 'message' => 'Your current password does not matches with the password you provided. Please try again.'], 200);
            }

            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                //Current password and new password are same
                return response()->json(['status' => 'error', 'message' => 'New Password cannot be same as your current password. Please choose a different password.'], 200);
            }

            if (strcmp($request->get('new-password-confirm'), $request->get('new-password')) == 0) {
                //Change Password
                $user->password = bcrypt($request->get('new-password'));
                $user->save();

                return response()->json(['status' => 'success', 'message' => 'Password Changed successfully.'], 200);

            } else {
                return response()->json(['status' => 'error', 'message' => 'New Password must be same as your confirm password.'], 200);
            }
        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }


    }
    public function getLatLong(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'staff_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try {
            $user = User::where('id', $request->staff_id)->where('user_type', 'staff')->first();

            if (!is_null($user)) {
                $userInfo = [
                    'staff_id' => $user->id,
                    'latitude' => $user->latitude,
                    'longitude' => $user->longitude,
                ];
                return response()->json(['status' => true, 'message' => '', 'data' => $userInfo], 200);
            } else {
                $userInfo = [];
                return response()->json(['status' => false, 'message' => 'Staff Not Found.', 'data' => $userInfo], 200);
            }


        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }
    public function saveLatLong(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $user_auth =Auth::user();
        try {
            $user = User::where('id', $user_auth->id)->where('user_type', 'staff')->first();
            if (!is_null($user)) {

                $user->latitude = $request->latitude;
                $user->longitude = $request->longitude;
                $user->save();

                $userInfo = [
                    'staff_id' => $user->id,
                    'latitude' => $user->latitude,
                    'longitude' => $user->longitude,
                ];
                return response()->json(['status' => true, 'message' => 'Location Updated Successfully.', 'data' => $userInfo], 200);
            } else {
                $userInfo = [];
                return response()->json(['status' => false, 'message' => 'Staff Not Found.', 'data' => $userInfo], 200);
            }


        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }


}
