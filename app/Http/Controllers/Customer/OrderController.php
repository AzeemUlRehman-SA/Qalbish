<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $orders = Order::where('customer_id', auth()->user()->id);

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


        return view('customer.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('customer.orders.show', compact('order'));

    }
}
