<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        $drivers = Driver::all();

        return view('backend.assign_driver.index', compact('staffs', 'drivers'));
    }
}
