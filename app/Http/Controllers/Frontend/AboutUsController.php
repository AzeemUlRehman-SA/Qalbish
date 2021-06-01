<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use App\Models\ManagingPartener;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutus = Aboutus::first();
        $teams = ManagingPartener::all();
        return view('frontend.pages.aboutus-detail', compact('aboutus', 'teams'));
    }
}
