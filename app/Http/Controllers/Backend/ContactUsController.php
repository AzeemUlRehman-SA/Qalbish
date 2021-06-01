<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsEmail;
use App\Models\ContactUs;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::orderBy('id', 'DESC')->get();
        return view('backend.contacts.index', compact('contacts'));

    }

    public function create()
    {
        $settings = Setting::take(3)->get();
        return view('frontend.pages.contact-us', compact('settings'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name'             => 'required',
            'email'                 => 'required',
            'nature_of_contact'     => 'required',
            'subject'               => 'required',
            'message'               => 'required'

        ]);
        $contact = ContactUs::create($request->all());
        $setting = Setting::where('name', $request->nature_of_contact)->first();
        $contact_us_email = Mail::to($setting->value)->send(new ContactUsEmail($contact));

        return back()->with([
            'flash_status' => 'success',
            'flash_message' => 'Your message has been sent.'
        ]);
    }

    public function destroy($id)
    {
        $contactus = ContactUs::findOrFail($id);
        $contactus->delete();

        return redirect()->route('admin.contacts.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Contact has been deleted'
            ]);
    }
}
