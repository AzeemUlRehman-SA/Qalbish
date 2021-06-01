<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $settings = Setting::orderBy('id', 'DESC')->get();
        return view('backend.settings.index', compact('settings'));
    }

    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('backend.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'value' => 'required',
        ]);
        Setting::find($id)->update([
            'value' => $request->value,
        ]);
        return redirect()->route('admin.settings.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Setting updated successfully.'
            ]);

    }
}
