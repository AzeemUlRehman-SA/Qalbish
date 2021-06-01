<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:customer');
    }

    public function index()
    {
        $total_orders = Order::where('customer_id', auth()->user()->id)->get()->count();
        $pending_orders = Order::where('order_status', 'pending')->where('customer_id', auth()->user()->id)->get()->count();
        $completed_orders = Order::where('order_status', 'completed')->where('customer_id', auth()->user()->id)->get();
        return view('customer.dashboard.index', compact('total_orders', 'pending_orders', 'completed_orders'));
    }
}
