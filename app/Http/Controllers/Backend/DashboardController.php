<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $users_count = User::all()->count();
        $total_orders = Order::all()->count();
        $pending_orders = Order::where('order_status', 'pending')->get()->count();
        $completed_orders = Order::where('order_status', 'completed')->get();
        $staff_users = User::where('user_type', 'staff')->get()->toArray();
//        dd($staff_users);
        return view('backend.dashboard.index', compact('users_count', 'total_orders', 'pending_orders', 'completed_orders', 'staff_users'));
    }
}
