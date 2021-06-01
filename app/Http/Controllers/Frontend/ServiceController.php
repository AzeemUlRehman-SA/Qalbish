<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Deal;
use App\Models\Service;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = Service::with('categories')->get();

        if (Auth::check()) {
            if (auth()->user()->hasRole('customer')) {
                session()->forget('coupon');
                $services = Category::where('service_id', auth()->user()->category_id)->get();
                $packages = Deal::where('category_id', auth()->user()->category_id)->orderBy('id', 'DESC')->get();
                $servicename = Session::get('servicename');
                $getservicedetail=[];
                if($servicename ==null){

//                    $getservicedetail = Category::first();
//                    $servicename = $getservicedetail->name;

                    $servicename= 'packages';

                }
                else{
                    if($servicename =="packages"){
                        $getservicedetail==null;
                    }
                    else{
                         $getservicedetail = Category::where('name', $servicename)->first();
                    }
                }
                return view('frontend.pages.orders.order', compact('services', 'packages','servicename','getservicedetail'));
            } else {
                return view('frontend.pages.service', compact('categories'));
            }
        } else {
            return view('frontend.pages.service', compact('categories'));
        }

    }

    public function serviceItems($slug)
    {
        $service_detail = Category::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.service-detail-single', compact('service_detail'));
    }

    public function getservicesname(Request $request){
        $status = "error";

        if($request->name){
            Session::put('servicename',$request->name);
            $status="success";
        }
        return response()->json(['status' => $status]);
    }
}
