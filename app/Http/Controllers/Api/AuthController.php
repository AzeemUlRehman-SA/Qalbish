<?php

namespace App\Http\Controllers\Api;

use App\Events\SendReferralCodeWithPhone;
use App\Http\Resources\UserResource;
use App\Models\ReferralDiscount;
use App\Models\Setting;
use App\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\UserReferral;
use DB;
use Mail;
use App\Mail\ForgotPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public $successStatus = 200;

    public function otp(Request $request)
    {
        $details = ['phone_number' => $request->phone_number];

        $validator = Validator::make($details, [
            'phone_number' => 'required|exists:users,phone_number',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            $otp_code = null;
            $user = User::where('phone_number', $request->phone_number)->first();

            if (is_null($user->otp_code)) {
                $otp_code = substr(str_shuffle(str_repeat($x = '0123456789', ceil(10 / strlen($x)))), 1, 4);
            } else {
                $otp_code = $user->otp_code;
            }

            $user->update([
                'otp_code' => $otp_code,
            ]);

//            $remove_zero = ltrim($request->get('phone_number'), '0');
//            $add_number = '92';
//            $phone_number = $add_number . $remove_zero;
            $phone_number = $request->phone_number;
            $message = 'Your OTP Code is ' . $otp_code . ' Please enter this code to verify your mobile number. This message is from Qalbish';
            event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));

            $data = [
                'phone_number' => $user->phone_number,
                'code' => $otp_code,
            ];

            return response()->json(['message' => 'OTP code has been sent on given number.', 'data' => $data], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 400);
        }

    }

    public function verifyOTP(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|exists:users,phone_number',
            'otp_code' => 'required|exists:users,otp_code',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {


            $user = User::where([
                'phone_number' => $request->get('phone_number'),
                'otp_code' => $request->get('otp_code'),
            ])->first();

            if (!is_null($user)) {

                $user->otp_status = 'verified';
                $user->save();

                return response()->json(['status' => true, 'message' => 'OTP Code verified successfully.'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Provided OTP code is not correct.'], 200);
            }

        } catch (QueryException $exception) {
            return response()->json($exception, 400);
        }

    }

    public function ForgotPasswordRequest(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|exists:users,phone_number',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            $user = User::where('phone_number', $request->phone_number)->first();

            if (is_null($user) || is_null($user->phone_number) || empty($user->phone_number)) {
                return response()->json(["status" => 'error', "message" => 'Your account is not associated with this mobile number.'], 404);
            }

            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['status' => 'success', "message" => 'Your password has been changes successfully.'], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 400);
        }
    }

    public function register(Request $request)
    {


        $random_string = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'city_id' => 'required|integer',
            'area_id' => 'required|integer',
            'age' => 'required',
            'referral_code' => 'nullable|exists:users,referral_code',
            'phone_number' => 'required|max:11|unique:users,phone_number',
            'cnic' => 'required|max:15|unique:users,cnic',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'city_id.required' => 'City is required.',
            'area_id.required' => 'Area is required.',
            'gender.required' => 'Gender is required.',
            'age.required' => 'Age is required.',
            'phone_number.required' => 'Phone Number is required.',
            'cnic.required' => 'CNIC is required.',
            'address.required' => 'Address is required.',
            'email.required' => 'Email is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }



        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/user_profiles');
            $image->move($destinationPath, $name);
            $profile_image = $name;
        } else {
            $profile_image = 'default.png';
        }

        $role = Role::find(3);

        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'city_id' => $request->get('city_id'),
            'area_id' => $request->get('area_id'),
            'role_id' => $role->id,
            'category_id' => $request->get('gender'),
            'age' => $request->get('age'),
            'emergency_number' => $request->get('emergency_number'),
            'phone_number' => $request->get('phone_number'),
            'cnic' => $request->get('cnic'),
            'address' => $request->get('address'),
            'referral_code' => $random_string,
            'user_type' => $role->name,
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'profile_pic' => $profile_image,
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        //Check the cookie value
        if (!is_null($request->referral_code)) {
            //get referral user id
            $referral_user_id = $this->getUserWithReferralCode($request->referral_code);
            UserReferral::create([
                'referral_register_email' => $user->email,
                'referral_register_phone_no' => $user->phone_number,
                'user_id' => $referral_user_id,
                'referred_id' => $user->id,
                'status' => 'taken'
            ]);
        }

//        $remove_zero = ltrim($request->get('phone_number'), '0');
//        $add_number = '92';
        $phone_number = $request->get('phone_number');
//        $phone_number = $add_number . $remove_zero;

        $message = 'Thank you for becoming a member of Qalbish! Someone from our team will be calling you shortly to complete your registration process. Thank you!';
        event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));

        $admin_phone_number = User::where('user_type', 'admin')->first()->phone_number;
        $message1 = 'A new customer ' . ucfirst($request->get('first_name')) . ' ' . ucfirst($request->get('last_name')) . ' has registered. Please call customer to complete verification process.';
        event(new SendReferralCodeWithPhone($user_name = '', $admin_phone_number, $message1));

        return response()->json(['message' => $message], 201);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|exists:users,phone_number',
            'password' => 'required'
        ],[
            'phone_number.required' =>'Phone Number is required',
            'password.required' =>'Password is required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if (Auth::attempt(['phone_number' => request('phone_number'), 'password' => request('password')])) {


            $user = Auth::user();

            if ($user->status == 'suspended') {

                return response()->json(['message' => 'Your account is suspended.'], 401);
            }

            $success['token'] = $user->createToken('AppName')->accessToken;
            $success['data'] = new UserResource($user);
            $referral_discount = ReferralDiscount::first();
            $referral_discount_description = null;
            $success['referral_discount'] = $referral_discount;
            $success['settings'] = Setting::get();

            if ($referral_discount && $referral_discount->type == 'fixed') {
                $referral_discount_description = "Join me on Qalbish and get 15% off your first order.";
            }
            $success['referral_discount_description'] = $referral_discount_description;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['message' => 'Invalid Password'], 401);
        }
    }

    public function logout()
    {


        try {
            $user = Auth::user();

            foreach ($user->tokens as $token) {
                $token->revoke();
                $token->delete();
            }

            return response()->json(['status' => true], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 400);
        }

        return response()->json(null, 204);
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    private function setCookieValue($referral_code)
    {
        Cookie::queue('referral_code', $referral_code, 1440);
    }

    private function returnCookieValue()
    {
        return Cookie::get('referral_code');
    }

    private function getUserWithReferralCode($referral_code)
    {
        return User::where('referral_code', $referral_code)->first()->id;
    }

}
