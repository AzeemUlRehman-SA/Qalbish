<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
//        $uri_path = url()->previous();
//        $removeString = strpos($uri_path, 'http://');
//        $removeStringCounter = 7;
//
//        if ($removeString === false) {
//            $removeStringCounter = 8;
//        }
//
//        $pathWithoutHttp = substr($uri_path, $removeStringCounter);
//        $pathToRedirect = substr($pathWithoutHttp, strpos($pathWithoutHttp, '/'));
//        Session::put('url.intended', $pathToRedirect);

        return view('auth.login');
    }

    public function username()
    {
        return 'phone_number';
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status == 'suspended') {
            Auth::logout();
            return redirect()->route('index')->with([
                'flash_status' => 'error',
                'flash_message' => 'Your Account has been suspended.Please Contact Support.'
            ]);
        } else {
            $pendingRatingOrder = null;
            Session::forget('pendingRatingOrder');

            if ($user->hasRole('staff')) {
                dd('staff');
            }
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard.index');
            }
            if ($user->hasRole('customer')) {

                foreach (auth()->user()->completedOrders as $completedOrder) {


                    if (is_null($completedOrder->rating)) {
                        $staff = User::where('id', $completedOrder->staff_id)->first();

                        if(!is_null($staff)){
                            $pendingRatingOrder = [
                                'id' => $completedOrder->id,
                                'order_id' => $completedOrder->order_id,
                                'phone_number' => $completedOrder->phone_number,
                                'requested_date_time' => date('M d, Y, h:i:s A', strtotime($completedOrder->requested_date_time)),
                                'special_instruction' => $completedOrder->special_instruction,
                                'total_persons' => $completedOrder->total_persons,
                                'address' => $completedOrder->address,
                                'staff' => ($staff->profile_pic) ? asset("/uploads/user_profiles/" . $staff->profile_pic) : asset("/uploads/user_profiles/default.png"),
                                'staff_name' => $staff->first_name . " " . $staff->last_name,
                                'staff_id' => $completedOrder->staff_id,
                                'customer_id' => $completedOrder->customer_id,
                            ];

                            break;
                        }

                    }
                }

                $request->session()->put('pendingRatingOrder', $pendingRatingOrder);


                return redirect()->to($this->redirectTo);
//                return redirect()->to(Session::get('url.intended'));
            }

            Auth::logout();

            return redirect()->route('login')->with([
                'flash_status' => 'error',
                'flash_message' => 'You are Unauthorized for this login.'
            ]);
        }


    }

}
