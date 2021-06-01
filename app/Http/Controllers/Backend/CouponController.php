<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();

        return view('backend.discounts.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('backend.discounts.coupon.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:coupons,code',
            'type' => 'required',
            'expiry_date' => 'required',
            'no_of_used' => 'required',
            'price' => 'required',
        ], [
            'expiry_date.required' => 'Expiry Date is required.',
            'type.required' => 'Discount Type is required.'
        ]);
        if ($request->get('type') == 'fixed') {
            $value = $request->price;
            Coupon::create([
                'code' => $request->get('code'),
                'type' => $request->get('type'),
                'value' => $value,
                'percent_off' => null,
                'expiry_date' => $request->get('expiry_date'),
                'no_of_used' => $request->get('no_of_used'),
                'count_of_used' => $request->get('no_of_used'),
            ]);
        } else {
            $percent_off = $request->price;
            Coupon::create([
                'code' => $request->get('code'),
                'type' => $request->get('type'),
                'value' => null,
                'percent_off' => $percent_off,
                'expiry_date' => $request->get('expiry_date'),
                'no_of_used' => $request->get('no_of_used'),
                'count_of_used' => $request->get('no_of_used'),
            ]);
        }

        return redirect()->route('admin.discount.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Coupon created successfully.'
            ]);

    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('backend.discounts.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required',
            'type' => 'required',
            'expiry_date' => 'required',
            'no_of_used' => 'required'
        ], [
            'expiry_date.required' => 'Expiry Date is required.',
            'type.required' => 'Discount Type is required.'
        ]);
        $coupon = Coupon::find($id);


        if ($request->get('type') == 'fixed') {
            $value = $request->price;
            $coupon->update([
                'code' => $request->get('code'),
                'type' => $request->get('type'),
                'value' => $value,
                'percent_off' => null,
                'expiry_date' => $request->get('expiry_date'),
                'no_of_used' => $request->get('no_of_used'),
                'count_of_used' => $request->get('no_of_used'),
            ]);
        } else {
            $percent_off = $request->price;
            $coupon->update([
                'code' => $request->get('code'),
                'type' => $request->get('type'),
                'value' => null,
                'percent_off' => $percent_off,
                'expiry_date' => $request->get('expiry_date'),
                'no_of_used' => $request->get('no_of_used'),
                'count_of_used' => $request->get('no_of_used'),
            ]);
        }
        return redirect()->route('admin.discount.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Coupon updated successfully.'
            ]);

    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.discount.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Coupon has been deleted'
            ]);
    }
}
