<?php

namespace App\Http\Controllers\Backend;

use App\Events\SendReferralCodeWithEmail;
use App\Events\SendReferralCodeWithPhone;
use App\Http\Controllers\Controller;
use App\Models\UserReferral;
use Illuminate\Http\Request;

class SendReferralCodeController extends Controller
{
    public function index(){
        return view('backend.referral-code.create');
    }

    public function sendCodeWithEmail(Request $request){
        $this->validate($request, [
           'email' => 'required|email'
        ]);

        //get sending user name
        $username = Auth()->user()->fullName();
        $referral_code = Auth()->user()->referral_code();

        //check weather someone else refer the same email
        $already_referred = UserReferral::where('referral_register_email', $request->email)->first();

        if(empty($already_referred)){
            try{
                //send referral code with email event
                event(new SendReferralCodeWithEmail($username, $referral_code, $request->email));
            }catch(\Exception $e){
                return back()->with([
                    'flash_status' => 'warning',
                    'flash_message' => 'Something went wrong'
                ]);
            }

            return back()->with([
                'flash_status' => 'success',
                'flash_message' => 'Referral Link has been sent.'
            ]);
        }else{

            return back()->with([
                'flash_status' => 'info',
                'flash_message' => 'Someone already send referral code to this email'
            ]);
        }

    }

    public function sendCodeWithPhone($phone, $message){
        event(new SendReferralCodeWithPhone($user_name = '', $phone, $message));
    }
}
