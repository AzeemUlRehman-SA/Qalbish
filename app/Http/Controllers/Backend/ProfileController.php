<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {

        $user = auth()->user();
        return view('backend.profiles.index', compact('user'));
    }

    public function editProfile()
    {

        $user = auth()->user();
        $categories = Service::all();
        $cities = City::all();
        $areas = Area::all();
        return view('backend.profiles.edit-profile', compact('user', 'categories', 'cities', 'areas'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'city_id' => 'required|integer',
            'area_id' => 'required|integer',
            'category_id' => 'required|integer',
            'age' => 'required',
            'cnic' => 'required',
            'address' => 'required',
            'email' => 'required|string|email|max:255',
        ], [
            'first_name.required' => 'First name  is required.',
            'last_name.required' => 'Last name  is required.',
            'city_id.required' => 'City is required.',
            'area_id.required' => 'Area  is required.',
            'category_id.required' => 'Gender  is required.',
            'age.required' => 'Age  is required.',
            'cnic.required' => 'CNIC  is required.',
            'email.required' => 'Email  is required.',
        ]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'city_id' => $request->get('city_id'),
            'area_id' => $request->get('area_id'),
            'category_id' => $request->get('category_id'),
            'age' => $request->get('age'),
            'cnic' => $request->get('cnic'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
        ]);

        return redirect()->route('admin.profile.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Profile updated successfully.'
            ]);
    }

    public function editProfileImage(Request $request)
    {
        $response = array('status' => '', 'message' => "", 'data' => array());
        $user = User::where('id', $request->user_id)->first();

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
        $user->update([
            'profile_pic' => $profile_image,
        ]);

        $response['status'] = 'success';
        $response['message'] = 'Profile Image updated successfully.';

        return $response;


    }

    public function changePassword()
    {

        $user = auth()->user();
        return view('backend.profiles.change-password', compact('user'));
    }

    public function changeMobileNumber()
    {

        $user = auth()->user();
        return view('backend.profiles.change-mobile-number', compact('user'));
    }

    public function updateMobileNumber(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
        ], [
            'phone_number.required' => 'Mobile Number is required.',

        ]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'phone_number' => $request->get('phone_number'),
        ]);

        return redirect()->route('admin.profile.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Mobile Number updated successfully.'
            ]);
    }

    public function updatePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
        ]);

        if (strcmp($request->get('new-password-confirm'), $request->get('new-password')) == 0) {
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();

            return redirect()->route('admin.profile.index')
                ->with([
                    'flash_status' => 'success',
                    'flash_message' => 'Password Changed successfully.'
                ]);

        } else {
            return redirect()->back()->with("error", "New Password must be same as your confirm password.");
        }


    }
}
