<?php

namespace App\Http\Controllers\Api;

use App\Events\SendReferralCodeWithPhone;
use App\Http\Controllers\Controller;
use App\Http\Resources\Staff\OrderResource as StaffOrderResource;
use App\Models\Driver;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function appointments()
    {

        try {

            $user = Auth::user();
            return response()->json(['data' => StaffOrderResource::collection(Order::where('staff_id', $user->id)->orderBy('id', 'desc')->get())], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }

    }

    public function updateOrderStaffStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'order_staff_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $user = Auth::user();

            if ($request->order_staff_status == 'accepted') {

                $order = Order::find($request->order_id);
                $order->staff_status = $request->order_staff_status;
                $order->save();
                return response()->json(['status' => true, 'message' => 'Order status updated successfully.', 'data' => StaffOrderResource::collection(Order::where('id', $order->id)->get())], 200);
            } else {
                $order = Order::find($request->order_id);
                $order->staff_status = $request->order_staff_status;
                $order->staff_id = null;
                $order->save();
                return response()->json(['status' => true, 'message' => 'Order status updated successfully.'], 200);
            }


        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function updateOrderProgressStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'order_progress_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            if ($request->order_progress_status == 'on-my-way') {

                $order = Order::find($request->order_id);

                $order->order_progress_status = $request->order_progress_status;
                $order->save();

                $user = Auth::user();

                $message = 'We are pleased to inform you that a beautician from Qalbish is on their way for your appointment. We hope you enjoy our services and look forward to your feedback!';
                event(new SendReferralCodeWithPhone($user_name = '', $order->user->phone_number, $message));

                User::whereId($user)->update([
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                ]);
            }


            if ($request->order_progress_status == 'start') {

                $order = Order::find($request->order_id);

                $order->order_progress_status = $request->order_progress_status;
                $order->order_start_time = date('Y-m-d H:i:s');
                $order->save();


            }

            if ($request->order_progress_status == 'end') {

                $order = Order::find($request->order_id);
                $order->order_progress_status = $request->order_progress_status;
                $order->order_end_time = date('Y-m-d H:i:s');
                $order->save();

            }

            if ($request->order_progress_status == 'collect-cash') {


                $order = Order::find($request->order_id);
                $order->order_progress_status = $request->order_progress_status;
                $order->extra_services = $request->extra_services;
                $order->order_status = 'completed';
                $order->staff_status = 'completed';
                $order->save();


                $message = 'We hope you enjoyed the services provided by Qalbish. Please refer a friend through our website or app and get 15% off your next appointment.';
                event(new SendReferralCodeWithPhone($user_name = '', $order->user->phone_number, $message));
            }


            return response()->json(['status' => true, 'message' => 'Order status updated successfully.', 'data' => StaffOrderResource::collection(Order::where('id', $order->id)->get())], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }

    public function updateStaffLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {

            $user = Auth::user();

            User::whereId($user)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return response()->json(['status' => true, 'message' => 'Order status updated successfully.'], 200);

        } catch (QueryException $exception) {
            return response()->json($exception, 404);
        }
    }


}
