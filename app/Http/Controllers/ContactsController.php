<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;


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
        // dd($request->inquiry_type);
        if(session()->has('reset'))
        {
            return redirect()->route('contact_index');
        }
        $sex = config('const.sex');
        $job = config('const.job');
        $attributes = $request->all();
        return view('contacts.confirm',compact('attributes','sex','job'));
    }

    public function send(ContactRequest $request,Contact $contact)
    {
        if(session()->has('reset'))
        {
            return redirect()->route('contact_index');
        }
        $inputs = $request->all();
        session()->put('reset','リセット');
        $contact->fill($inputs)->save();
        return view('contacts.thanks',compact('inputs'));
    }
}
