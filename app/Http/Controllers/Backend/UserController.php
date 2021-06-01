<?php

namespace App\Http\Controllers\Backend;

use App\Events\RegisterEmail;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Driver;
use App\Models\Membership;
use App\Models\Role;
use App\Models\Service;
use App\Models\Staff;
use App\Models\StaffServices;
use App\Models\User;
use App\Models\UserRole;
use App\Standards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Events\SendReferralCodeWithPhone;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        $categories = Service::all();
        $memberships = Membership::all();

        return view('backend.users.index', compact('users', 'categories', 'memberships'));
    }

    public function create()
    {
        $areas = Area::all();
        $cities = City::all();
        $roles = Role::all();
        $categories = Service::all();
        return view('backend.users.create', compact('areas', 'cities', 'roles', 'categories'));
    }

    public function store(Request $request)
    {

        $random_string = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'image' => '|image|mimes:jpg,jpeg,png|max:2048',
            'city_id' => 'required|integer',
            'area_id' => 'required|integer',
            'role_id' => 'required|integer',
            'category_id' => 'required|integer',
            'age' => 'required',
            'phone_number' => 'required|unique:users,phone_number',
            'cnic' => 'required|unique:users,cnic',
            'address' => 'required',
            'status' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
            'service_category_id.0' => Rule::requiredIf(function () use ($request) {
                if ($request->get('role_id') == 2) {
                    return true;
                }
            }),
            'shifts' => Rule::requiredIf(function () use ($request) {
                if ($request->get('role_id') == 2 || $request->get('role_id') == 4) {
                    return true;
                }
            }),
        ], [
            'first_name.required' => 'First name  is required.',
            'last_name.required' => 'Last name  is required.',
            'city_id.required' => 'City is required.',
            'role_id.required' => 'Role is required.',
            'area_id.required' => 'Area  is required.',
            'category_id.required' => 'Gender  is required.',
            'age.required' => 'Age  is required.',
            'phone_number.required' => 'Phone Number  is required.',
            'cnic.required' => 'CNIC  is required.',
            'status.required' => 'Status  is required.',
            'email.required' => 'Email  is required.',
            'service_category_id.0.required' => 'Service  is required.',
        ]);


        if ($request->get('role_id') == 2) {
            $profile_image = '233-x-233.jpg';
        } else {
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
        }

        $role = Role::find((int)$request->get('role_id'));


        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'city_id' => $request->get('city_id'),
            'area_id' => $request->get('area_id'),
            'role_id' => $request->get('role_id'),
            'category_id' => $request->get('category_id'),
            'dob' => $request->get('dob'),
            'age' => $request->get('age'),
            'phone_number' => $request->get('phone_number'),
            'emergency_number' => $request->get('emergency_number'),
            'cnic' => $request->get('cnic'),
            'address' => $request->get('address'),
            'referral_code' => $random_string,
            'user_type' => $role->name,
            'status' => $request->get('status'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'profile_pic' => $profile_image,
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        $remove_zero = ltrim($user->phone_number, '0');
        $add_number = '92';
//        $phone_number = $add_number . $remove_zero;
        $phone_number = $user->phone_number;


        if ($role->id == 2) {
            $staff = Staff::create([
                'user_id' => $user->id,
                'full_name' => $user->fullName(),
                'email' => $request->get('email'),
                'city_id' => $request->get('city_id'),
                'area_id' => $request->get('area_id'),
                'phone_number' => $request->get('phone_number'),
                'emergency_phone_number' => $request->get('emergency_number'),
                'shifts' => $request->get('shifts'),

            ]);
            if (!empty($request->service_category_id)) {
                foreach ($request->service_category_id as $key => $service) {
                    StaffServices::create([
                        'staff_id' => $staff->id,
                        'service_category_id' => $service,

                    ]);
                }
            }
            $message = 'Thank you for becoming a member of Qalbish! Someone from our team will be calling you shortly to complete your registration process. Thank you! \n Mobile Number: ' . $request->get('phone_number') . '\n Password: ' . $request->get('password') . '';


            event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));

        } else if ($role->id == 4) {
            Driver::create([
                'user_id' => $user->id,
                'full_name' => $user->fullName(),
                'email' => $request->get('email'),
                'city_id' => $request->get('city_id'),
                'area_id' => $request->get('area_id'),
                'phone_number' => $request->get('phone_number'),
                'emergency_phone_number' => $request->get('emergency_number'),
                'shifts' => $request->get('shifts'),

            ]);

//            $message = 'Thank you for becoming a member of Qalbish! Someone from our team will be calling you shortly to complete your registration process. Thank you!';
//            event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));
        } else {
            $message = 'Thank you for becoming a member of Qalbish! Someone from our team will be calling you shortly to complete your registration process. Thank you!';
            event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));
        }
        //send the registration email
//        event(new RegisterEmail($request->email, $request->password));


        return redirect()->route('admin.users.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'User created successfully.'
            ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $areas = Area::all();
        $cities = City::all();
        $roles = Role::all();
        $categories = Service::all();

        $services = Category::where('service_id', $user->category_id)->get();
        return view('backend.users.edit', compact('user', 'areas', 'cities', 'roles', 'categories', 'services'));


    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'image' => '|image|mimes:jpg,jpeg,png|max:2048',
            'city_id' => 'required|integer',
            'area_id' => 'required|integer',
            'role_id' => 'required|integer',
            'category_id' => 'required|integer',
            'age' => 'required',
            'phone_number' => 'required',
            'cnic' => 'required',
            'address' => 'required',
            'status' => 'required',
            'email' => 'required|string|email|max:255',
            'service_category_id.0' => Rule::requiredIf(function () use ($request) {
                if ($request->get('role_id') == 2) {
                    return true;
                }
            }),
            'shifts' => Rule::requiredIf(function () use ($request) {
                if ($request->get('role_id') == 2 || $request->get('role_id') == 4) {
                    return true;
                }
            }),
        ], [
            'first_name.required' => 'First name  is required.',
            'last_name.required' => 'Last name  is required.',
            'city_id.required' => 'City is required.',
            'area_id.required' => 'Area  is required.',
            'category_id.required' => 'Gender  is required.',
            'age.required' => 'Age  is required.',
            'phone_number.required' => 'Phone Number  is required.',
            'cnic.required' => 'CNIC  is required.',
            'status.required' => 'Status  is required.',
            'email.required' => 'Email  is required.',
            'service_category_id.0.required' => 'Service  is required.',
        ]);

        $user = User::find($id);
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/user_profiles');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $profile_image = $name;
        } else {
            $profile_image = $user->profile_pic;
        }

        $remove_zero = ltrim($user->phone_number, '0');
        $add_number = '92';
//        $phone_number = $add_number . $remove_zero;
        $phone_number = $user->phone_number;


        $role = Role::find((int)$request->get('role_id'));


        $user->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'city_id' => $request->get('city_id'),
            'area_id' => $request->get('area_id'),
            'role_id' => $request->get('role_id'),
            'category_id' => $request->get('category_id'),
            'dob' => $request->get('dob'),
            'age' => $request->get('age'),
            'phone_number' => $request->get('phone_number'),
            'emergency_number' => $request->get('emergency_number'),
            'cnic' => $request->get('cnic'),
            'address' => $request->get('address'),
            'user_type' => $role->name,
            'status' => $request->get('status'),
            'email' => $request->get('email'),
            'profile_pic' => $profile_image,
        ]);
        (new \App\Models\UserRole)->update([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);


        if ($role->id == 2) {
            $staff = $user->staff->update([
                'user_id' => $user->id,
                'full_name' => $user->fullName(),
                'email' => $request->get('email'),
                'city_id' => $request->get('city_id'),
                'area_id' => $request->get('area_id'),
                'phone_number' => $request->get('phone_number'),
                'emergency_phone_number' => $request->get('emergency_number'),
                'shifts' => $request->get('shifts'),

            ]);

            StaffServices::where('staff_id', $user->staff->id)->delete();
            if (!empty($request->service_category_id)) {
                foreach ($request->service_category_id as $key => $service) {
                    StaffServices::create([
                        'staff_id' => $user->staff->id,
                        'service_category_id' => $service,

                    ]);
                }
            }

        } else if ($role->id == 4) {
            $user->driver->update([
                'user_id' => $user->id,
                'full_name' => $user->fullName(),
                'email' => $request->get('email'),
                'city_id' => $request->get('city_id'),
                'area_id' => $request->get('area_id'),
                'phone_number' => $request->get('phone_number'),
                'emergency_phone_number' => $request->get('emergency_number'),
                'shifts' => $request->get('shifts'),

            ]);
        } else {
            $message = 'We are pleased to confirm your membership with Qalbish. You can book an appointment anytime using our app, website, phone or WhatsApp. We look forward to providing you our luxury home spa services.';
            event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));
        }
        return redirect()->route('admin.users.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'User updated successfully.'
            ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'User has been deleted'
            ]);
    }

    public function assignMembership(Request $request)
    {

        $user = User::find($request->get('user_id'));

        $user->update([
            'membership_id' => $request->get('membership_id'),
        ]);


        $response = array('status' => '', 'message' => "", 'data' => array());

        $validator = Validator::make($request->all(), [
            'membership_id' => 'required|exists:memberships,id'
        ], [
            'membership_id.required' => "Membership is Required.",
            'membership_id.exists' => "Invalid Membership Selected."
        ]);

        if (!$validator->fails()) {
            $user = User::find($request->get('user_id'));
            $user->update([
                'membership_id' => $request->get('membership_id'),
            ]);

            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = "Validation Errors.";
            $response['data'] = $validator->errors()->toArray();
        }

        return $response;

    }

    public function updateLocation(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->update([
            'current_address' => $request->current_address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return redirect()->route('admin.users.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'User Location Updated Successfully.'
            ]);
    }
}
