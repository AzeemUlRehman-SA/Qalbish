<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendReferralCodeWithPhone;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Role;
use App\Models\Service;
use App\Models\UserReferral;
use App\Models\UserRole;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\SendSms;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm($referral_code = null)
    {
        if ($referral_code) {
            $this->setCookieValue($referral_code);
        }
        $cities = City::all();
        $categories = Service::all();
        return view('auth.register', compact('cities', 'categories', 'referral_code'));
    }

    public function register(Request $request)
    {
        $random_string = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'city_id' => 'required|integer',
            'area_id' => 'required|integer',
            'age' => 'required',
            'phone_number' => 'required|unique:users,phone_number',
            'cnic' => 'required|unique:users,cnic',
            'category_id' => 'required|integer',
            'address' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
        ], [
            'first_name.required' => 'First name field  is required.',
            'last_name.required' => 'Last name field is required.',
            'city_id.required' => 'City field is required.',
            'area_id.required' => 'Area field  is required.',
            'category_id.required' => 'Gender  is required.',
            'age.required' => 'Age field  is required.',
            'phone_number.required' => 'Phone Number field  is required.',
            'cnic.required' => 'CNIC field  is required.',
            'address.required' => 'Address field is required.',
            'email.required' => 'Email field  is required.',
        ]);
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/user_profiles');
            $imagePath = $destinationPath . "/" . $name;
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
            'category_id' => $request->get('category_id'),
            'age' => $request->get('age'),
            'phone_number' => $request->get('phone_number'),
            'emergency_number' => $request->get('emergency_number'),
            'cnic' => $request->get('cnic'),
            'address' => $request->get('address'),
            'referral_code' => $random_string,
            'user_type' => $role->name,
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'profile_pic' => $profile_image,
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        //Check the cookie value
        if ($cookie = $this->returnCookieValue()) {
            //get referral user id
            $referral_user_id = $this->getUserWithReferralCode($cookie);
            UserReferral::create([
                'referral_register_email' => $user->email,
                'referral_register_phone_no' => $user->phone_number,
                'user_id' => $referral_user_id,
                'referred_id' => $user->id,
                'status' => 'pending'
            ]);

            $this->destroyCookie();
        }

//        $remove_zero = ltrim($user->phone_number, '0');
//        $add_number = '92';
//        $phone_number = $add_number . $remove_zero;
        $phone_number = $user->phone_number;

        $message = 'Thank you for becoming a member of Qalbish! Someone from our team will be calling you shortly to complete your registration process. Thank you!';
        event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));


        $admin_phone_number = User::where('user_type', 'admin')->first()->phone_number;
        $message1 = 'A new customer ' . ucfirst($request->get('first_name')) . ' ' . ucfirst($request->get('last_name')) . ' has registered. Please call customer to complete verification process.';
        event(new SendReferralCodeWithPhone($user_name = '', $admin_phone_number, $message1));

        $response['status'] = 'success';
        $response['data'] = [
            'flash_status' => 'success',
            'flash_message' => 'Dear Customer,Thank you for signing up at Qalbish'
        ];


        session()->put('user', 'register');

        return redirect()->route('login')->with(['flash_status' => 'success', 'flash_message' => 'Dear Customer,Thank you for signing up at Qalbish']);

    }

    private function setCookieValue($referral_code)
    {
        Cookie::queue('referral_code', $referral_code, 1440);
    }

    private function returnCookieValue()
    {
        return Cookie::get('referral_code');
    }

    private function destroyCookie()
    {
        Cookie::queue(Cookie::forget('referral_code'));
    }

    private function getUserWithReferralCode($referral_code)
    {
        return User::where('referral_code', $referral_code)->first()->id;
    }
}
