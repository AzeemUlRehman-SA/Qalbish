<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ManagingPartener;
use Illuminate\Http\Request;

class ManagingPartenerController extends Controller
{
    public function showmodal($id)
    {
        $team = ManagingPartener::whereId($id)->first();
        return view('frontend.modals.teamModel', compact('team'));

    }
}
