<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->hasRole('customer')) {
                $deals = Deal::where('category_id', auth()->user()->category_id)->orderBy('id', 'DESC')->get();
                return view('frontend.pages.packages', compact('deals'));
            } else {
                $deals = Deal::orderBy('id', 'DESC')->get();
                return view('frontend.pages.packages', compact('deals'));
            }
        }
        $deals = Deal::orderBy('id', 'DESC')->get();
        return view('frontend.pages.packages', compact('deals'));
    }

    public function getPackage($slug)
    {
        $category_id = Service::where('name', $slug)->first()->id;
        $deals = Deal::where('category_id', $category_id)->orderBy('name', 'ASC')->get();
        return view('frontend.pages.packages', compact('deals'));
    }
}
