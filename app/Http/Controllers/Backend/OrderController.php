<?php

namespace App\Http\Controllers\Backend;

use App\Events\SendReferralCodeWithPhone;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Deal;
use App\Models\DealService;
use App\Models\DealSubCategory;
use App\Models\DealSubCategoryAddon;
use App\Models\Driver;
use App\Models\FirstOrderDiscount;
use App\Models\MembershipDiscount;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderMenuItemAddon;
use App\Models\ReferralDiscount;
use App\Models\Service;
use App\Models\Staff;
use App\Models\StaffServices;
use App\Models\User;
use App\Models\UserReferral;
use App\Traits\GeneralHelperTrait;
use Carbon\Carbon;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class OrderController extends Controller
{

    use GeneralHelperTrait;

    public function index(Request $request)
    {

        $orders = Order::whereNotNull('id');

        if (!is_null($request->status)) {

            $orders->where('order_status', $request->status);

        }

        if (!is_null($request->start_date)) {

            $orders->whereDate('created_at', '>=', $request->start_date);

        }

        if (!is_null($request->end_date)) {

            $orders->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $orders->get();

        $staffs = User::where('user_type', 'staff')->get();
        return view('backend.orders.index', compact('orders', 'staffs'));
    }

    public function showOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.orders.show', compact('order'));

    }

    public function create()
    {

        $categories = Service::all();
        $packages = Deal::all();
        $employees = User::where('user_type', 'customer')->where('status', '!=', 'suspended')->get();

        return view('backend.orders.create', compact('categories', 'employees', 'packages'));
    }

    public function store(Request $request)
    {
        if (!is_null($request->customer_id)) {

            $order_id = $this->orderNumber();
            $order = Order::create([

                'customer_id' => $request->customer_id,
                'order_id' => $order_id,
                'area_id' => $request->area_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'phone_number' => $request->mobile_number,
                'total_persons' => $request->no_of_peoples,
                'special_instruction' => $request->special_notes,
                'alternate_address' => $request->alternate_address,
                'requested_date_time' => $request->datetimepicker1 . ' ' . $request->time,
                'total_price' => $request->net_price,
                'grand_total' => $request->grand_total,
                'order_status' => 'pending',
                'membership_discount' => $request->memberships_discount,
                'first_order_discount' => $request->first_order_discount,
                'referral_discount' => $request->referral_discount,
                'admin_discount' => $request->admin_discount,
                'delivery_charges' => (int)$request->delivery_charges,

            ]);
            if (!is_null($request->referral_discount) && !empty($request->referral_discount)) {
                $user_referrals = UserReferral::where('user_id', $request->customer_id)->where('status', 'pending')->first();
                $user_referrals->status = 'taken';
                $user_referrals->save();
            }


            if (!empty($request->service_category_id)) {
                foreach ($request->get('service_category_id') as $key => $ser_cat_id) {

                    if (!empty($request->get('service_sub_category_id')[$ser_cat_id])) {
                        foreach ($request->get('service_sub_category_id')[$ser_cat_id] as $index => $ser_sub_cat_id) {
                            $order_details = OrderDetail::create([
                                'order_id' => $order->id,
                                'category_id' => $request->category_id,
                                'service_id' => (int)$ser_cat_id,
                                'menu_item_id' => (int)$ser_sub_cat_id,
                                'name' => $request->get('service_sub_category_name')[$ser_cat_id][$ser_sub_cat_id],
                                'quantity' => (int)$request->get('service_sub_category_quantity')[$ser_cat_id][$ser_sub_cat_id],
                                'amount' => (int)$request->get('service_sub_category_price')[$ser_cat_id][$ser_sub_cat_id],
                                'duration' => 0,
                                'type' => 'Service',
                            ]);
                            if (!empty($request->get('service_sub_category_addon_id')[$ser_cat_id][$ser_sub_cat_id])) {
                                foreach ($request->get('service_sub_category_addon_id')[$ser_cat_id][$ser_sub_cat_id] as $i => $ser_sub_cat_addon_id) {

                                    OrderMenuItemAddon::create([
                                        'order_details_id' => $order_details->id,
                                        'menu_item_id' => (int)$ser_sub_cat_id,
                                        'add_on_id' => (int)$ser_sub_cat_addon_id,
                                        'name' => $request->get('service_sub_category_addons_name')[$ser_cat_id][$ser_sub_cat_id][$ser_sub_cat_addon_id],
                                        'quantity' => (int)$request->get('service_sub_category_addons_quantity')[$ser_cat_id][$ser_sub_cat_id][$ser_sub_cat_addon_id],
                                        'amount' => (int)$request->get('service_sub_category_addons_price')[$ser_cat_id][$ser_sub_cat_id][$ser_sub_cat_addon_id],
                                        'duration' => 0,
                                    ]);
                                }
                            }

                        }
                    }

                }


            }
            if (!empty($request->service_sub_category_packages_id)) {
                foreach ($request->get('service_sub_category_packages_id') as $key => $ser_cat_id_package) {
                    $order_details = OrderDetail::create([
                        'order_id' => $order->id,
                        'category_id' => $request->category_id,
                        'package_id' => (int)$ser_cat_id_package,
                        'name' => $request->get('package_name')[$ser_cat_id_package],
                        'quantity' => (int)$request->get('package_quantity')[$ser_cat_id_package],
                        'amount' => (int)$request->get('package_price')[$ser_cat_id_package],
                        'duration' => 0,
                        'type' => 'Package',
                    ]);

                }
            }


            $response['data'] = [
                'flash_status' => 'success',
                'flash_message' => 'Order Created Successfully.',
            ];

        } else {
            $response['data'] = [
                'flash_status' => 'error',
                'flash_message' => 'Something Went Wrong.Please Try Again.',
            ];
        }
        return $response;
    }

    public function editOrder($id)
    {

        $order = Order::whereId($id)->first();
        $services = Category::whereServiceId($order->user->category_id)->get();
        $packages = Deal::all();
        $employees = User::where('user_type', 'customer')->get();
        $serviceIds = OrderDetail::whereOrderId($order->id)->pluck('service_id')->toArray();
        $menu_itemIds = OrderDetail::whereOrderId($order->id)->pluck('menu_item_id')->toArray();
        $menu_itemQuantity = OrderDetail::whereOrderId($order->id)->pluck('quantity')->toArray();
        $menu_items = OrderDetail::whereOrderId($order->id)->get();
        $discount = 0;

        $coupon_discount = $order->coupon_discount ?? 0;
        $membership_discount = $order->membership_discount ?? 0;
        $first_order_discount = $order->first_order_discount ?? 0;
        $referral_discount = $order->referral_discount ?? 0;
        $discount = $coupon_discount + $membership_discount + $first_order_discount + $referral_discount;

        if (!is_null($serviceIds[0])) {

            $staffIDs = StaffServices::whereIn('service_category_id', $serviceIds)->pluck('staff_id')->toArray();
            $staffs_users = Staff::whereIn('id', $staffIDs)->pluck('user_id')->toArray();
            $staffs = User::whereIn('id', $staffs_users)->where('user_type', 'staff')->get();
        } else {
            $staffs = User::where('user_type', 'staff')->get();
        }


        $drivers = Driver::all();
        return view('backend.orders.edit', compact('drivers', 'staffs', 'services', 'employees', 'packages', 'order', 'serviceIds', 'menu_itemIds', 'menu_itemQuantity', 'menu_items', 'discount'));
    }

//menu_itemPackageIds

    public function updateOrder(Request $request)
    {

        if (!is_null($request->customer_id)) {

            $order = Order::whereId($request->order_id)->update([

                'customer_id' => $request->customer_id,
                'area_id' => $request->area_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'phone_number' => $request->mobile_number,
                'total_persons' => $request->no_of_peoples,
                'special_instruction' => $request->special_notes,
                'alternate_address' => $request->alternate_address,
                'requested_date_time' => $request->datetimepicker1 . ' ' . $request->time,
                'total_price' => $request->net_price,
                'grand_total' => $request->grand_total - $request->discount,
                'order_status' => $request->order_status,
                'staff_status' => 'pending',
                'staff_id' => $request->staff_id,
                'driver_id' => $request->driver_id,
                'admin_discount' => $request->admin_discount,
                'delivery_charges' => (int)$request->delivery_charges,

            ]);


            $order_detail_id = OrderDetail::whereOrderId($request->order_id)->get();

            if (!empty($order_detail_id) && count($order_detail_id) > 0) {

                foreach ($order_detail_id as $order) {
                    OrderMenuItemAddon::where('order_details_id', $order->id)->delete();
                }


            }
            OrderDetail::whereOrderId($request->order_id)->delete();


            if (!empty($request->service_category_id)) {
                foreach ($request->get('service_category_id') as $key => $ser_cat_id) {

                    if (!empty($request->get('service_sub_category_id')[$ser_cat_id])) {
                        foreach ($request->get('service_sub_category_id')[$ser_cat_id] as $index => $ser_sub_cat_id) {

                            $order_details = OrderDetail::create([
                                'order_id' => $request->order_id,
                                'category_id' => $request->category_id,
                                'service_id' => (int)$ser_cat_id,
                                'menu_item_id' => (int)$ser_sub_cat_id,
                                'name' => $request->get('service_sub_category_name')[$ser_cat_id][$ser_sub_cat_id],
                                'quantity' => (int)$request->get('service_sub_category_quantity')[$ser_cat_id][$ser_sub_cat_id],
                                'amount' => (int)$request->get('service_sub_category_price')[$ser_cat_id][$ser_sub_cat_id],
                                'duration' => 0,
                                'type' => 'Service',
                            ]);

                            if (!empty($request->get('service_sub_category_addon_id')[$ser_cat_id][$ser_sub_cat_id])) {

                                foreach ($request->get('service_sub_category_addon_id')[$ser_cat_id][$ser_sub_cat_id] as $i => $ser_sub_cat_addon_id) {

                                    OrderMenuItemAddon::create([
                                        'order_details_id' => $order_details->id,
                                        'menu_item_id' => (int)$ser_sub_cat_id,
                                        'add_on_id' => (int)$ser_sub_cat_addon_id,
                                        'name' => $request->get('service_sub_category_addons_name')[$ser_cat_id][$ser_sub_cat_id][$ser_sub_cat_addon_id],
                                        'quantity' => (int)$request->get('service_sub_category_addons_quantity')[$ser_cat_id][$ser_sub_cat_id][$ser_sub_cat_addon_id],
                                        'amount' => (int)$request->get('service_sub_category_addons_price')[$ser_cat_id][$ser_sub_cat_id][$ser_sub_cat_addon_id],
                                        'duration' => 0,
                                    ]);
                                }
                            }

                        }
                    }

                }


            }
            if (!empty($request->service_sub_category_packages_id)) {
                foreach ($request->get('service_sub_category_packages_id') as $key => $ser_cat_id_package) {
                    $order_details = OrderDetail::create([
                        'order_id' => $request->order_id,
                        'category_id' => $request->category_id,
                        'package_id' => (int)$ser_cat_id_package,
                        'name' => $request->get('package_name')[$ser_cat_id_package],
                        'quantity' => (int)$request->get('package_quantity')[$ser_cat_id_package],
                        'amount' => (int)$request->get('package_price')[$ser_cat_id_package],
                        'duration' => 0,
                        'type' => 'Package',
                    ]);

                }
            }

            if (!is_null($request->staff_id)) {
                $staff = User::where('id', $request->staff_id)->first();
                $remove_zero = ltrim($staff->phone_number, '0');
                $add_number = '92';
//                $phone_number = $add_number . $remove_zero;
                $phone_number = $staff->phone_number;


                if (!is_null($request->alternate_address)) {
                    $address = $request->alternate_address;
                } else {
                    $address = auth()->user()->address;
                }

                $smsUser = User::where('id', $request->customer_id)->first();
                //Staff
                $message = 'You have an appointment with ' . strtoupper($smsUser->fullName()) . ' at ' . $request->datetimepicker1 . ' ' . $request->time . ' at ' . $address . '';

                event(new SendReferralCodeWithPhone($user_name = '', $phone_number, $message));

                //Customer
                $message1 = 'Your appointment is confirmed for ' . $request->datetimepicker1 . ' ' . $request->time . '. Thank you for using Qalbish! ';

                event(new SendReferralCodeWithPhone($user_name = '', $smsUser->phone_number, $message1));
            }


            $response['data'] = [
                'flash_status' => 'success',
                'flash_message' => 'Order Updated Successfully.',
            ];

        } else {
            $response['data'] = [
                'flash_status' => 'error',
                'flash_message' => 'Something Went Wrong.Please Try Again.',
            ];
        }
        return $response;

    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.get.order.history')->with([
            'flash_status' => 'success',
            'flash_message' => 'Order Deleted Successfully.',
        ]);
    }
}
