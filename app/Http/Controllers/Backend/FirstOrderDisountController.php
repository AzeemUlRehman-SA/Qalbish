<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FirstOrderDiscount;
use Illuminate\Http\Request;

class FirstOrderDisountController extends Controller
{
    public function edit($id)
    {
        $first_order_discount = FirstOrderDiscount::find($id);
        return view('backend.discounts.first_order.edit', compact('first_order_discount'));
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
        $first_order_discount = FirstOrderDiscount::find($id);


        if ($request->get('type') == 'fixed') {
            $value = $request->price;
            $first_order_discount->update([
                'type' => $request->get('type'),
                'value' => $value,
                'percent_off' => null,
            ]);
        } else {
            $percent_off = $request->price;
            $first_order_discount->update([
                'type' => $request->get('type'),
                'value' => null,
                'percent_off' => $percent_off,
            ]);
        }
        return redirect()->route('admin.discount.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'First Order Discount updated successfully.'
            ]);

    }

}
