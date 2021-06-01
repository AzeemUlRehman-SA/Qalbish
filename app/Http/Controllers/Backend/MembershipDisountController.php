<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\MembershipDiscount;
use Illuminate\Http\Request;

class MembershipDisountController extends Controller
{
    public function edit($id)
    {
        $membership_discount = MembershipDiscount::find($id);
        return view('backend.discounts.membership.edit', compact('membership_discount'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required',
            'price' => 'required'
        ], [
            'price.required' => 'Price is required.',
            'type.required' => 'Discount Type is required.'
        ]);
        $membership_discount = MembershipDiscount::find($id);


        if ($request->get('type') == 'fixed') {
            $value = $request->price;
            $membership_discount->update([
                'type' => $request->get('type'),
                'value' => $value,
                'percent_off' => null,
            ]);
        } else {
            $percent_off = $request->price;
            $membership_discount->update([
                'type' => $request->get('type'),
                'value' => null,
                'percent_off' => $percent_off,
            ]);
        }
        return redirect()->route('admin.discount.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Membership Discount updated successfully.'
            ]);

    }
}
