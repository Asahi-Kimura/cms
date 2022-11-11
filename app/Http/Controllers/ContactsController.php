<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function index()
    {
        if(session()->has('reset'))
        {
            session()->forget('reset');
        }
        $inquiry_types = config('const.inquiry_type');
        $sex = config('const.sex');
        $job = config('const.job');
        return view('contacts.index',compact('sex','inquiry_types','job'));
    }

    public function confirm(ContactRequest $request,Contact $contact)
    {
        if(session()->has('reset'))
        {
            return redirect()->route('contact_index');
        }
        $inquiry_types = config('const.inquiry_type');
        $sex = config('const.sex');
        $job = config('const.job');
        $attributes = $request->all();
        return view('contacts.confirm',compact('attributes','sex','inquiry_types','job'));
    }

    public function send(ContactRequest $request,Contact $contact)
    {
        if(session()->has('reset'))
        {
            return redirect()->route('contact_index');
        }
        $string_birthday = $request->birthday;
        $inputs = $request->all();
        $inputs['inquiry_type'] = http_build_query($request->inquiry_type);
        $inputs['birthday'] = date('Y-m-d',strtotime($inputs['birthday']));
        session()->put('reset','リセット');
        $contact->fill($inputs)->save();
        return view('contacts.thanks',compact('inputs','string_birthday'));
    }
}
