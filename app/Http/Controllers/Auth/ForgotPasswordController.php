<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendReferralCodeWithPhone;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordRequest;
use App\Models\User;
use App\PasswordReset;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


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
                'otp' => $otp_code,
                'phone_number' => $user->phone_number,
            ];

            return response()->json(['message' => 'OTP code has been sent on given number.', 'data' => $data], 201);

        } catch (QueryException $exception) {
            return response()->json($exception, 400);
        }

    }

    public function verifyOTP(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|exists:users,phone_number',
            'otp_code' => 'required|exists:users,otp_code',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {


            $user = User::where([
                'phone_number' => $request->get('mobile_number'),
                'otp_code' => $request->get('otp_code'),
            ])->first();

            if (!is_null($user)) {
                $user->otp_status = 'verified';
                $user->save();

                return response()->json(['status' => 'success', 'message' => ''], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Provided OTP code is not correct.'], 401);
            }

        } catch (QueryException $exception) {
            return response()->json($exception, 400);
        }

    }

    public function ForgotPasswordRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            $user = User::wherePhoneNumber($request->mobile_number)->first();

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
}
