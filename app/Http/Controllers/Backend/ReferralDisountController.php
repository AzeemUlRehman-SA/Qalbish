<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ReferralDiscount;
use Illuminate\Http\Request;

class ReferralDisountController extends Controller
{
    public function edit($id)
    {
        $referral_discount = ReferralDiscount::find($id);
        return view('backend.discounts.referral.edit', compact('referral_discount'));
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
        $referral_discount = ReferralDiscount::find($id);


        if ($request->get('type') == 'fixed') {
            $value = $request->price;
            $referral_discount->update([
                'type' => $request->get('type'),
                'value' => $value,
                'percent_off' => null,
            ]);
        } else {
            $percent_off = $request->price;
            $referral_discount->update([
                'type' => $request->get('type'),
                'value' => null,
                'percent_off' => $percent_off,
            ]);
        }
        return redirect()->route('admin.discount.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Referral Discount updated successfully.'
            ]);

    }
}
