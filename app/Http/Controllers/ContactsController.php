<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    // public $inquiry_types;
    // public $sex; 
    // public $job;
    // public function __construct()
    // {
    //     $this->inquiry_types = config('const.inquiry_type');
    //     $this->sex = config('const.sex');
    //     $this->job = config('const.job');
    // }

    public function index()
    {
        if(session()->has('reset'))
        {
            session()->forget('reset');
        }
        $inquiry_type = config('const.inquiry_type');
        $sex = config('const.sex');
        $job = config('const.job');
        return view('contacts.index',compact('sex','inquiry_type','job'));
        // return view('contacts.index',compact('sex','inquiry_types','job'));
    }

    public function confirm(ContactRequest $request,Contact $contact)
    {
        if(session()->has('reset'))
        {
            return redirect()->route('contact_index');
        }
        $inquiry_type = config('const.inquiry_type');
        $sex = config('const.sex');
        $job = config('const.job');
        $attributes = $request->all();
        return view('contacts.confirm',compact('attributes','sex','inquiry_type','job'));
    }

    public function send(ContactRequest $request,Contact $contact)
    {
        if(session()->has('reset'))
        {
            return redirect()->route('contact_index');
        }
        
        $string_birthday = $request->birthday;
        $inputs = $request->all();

        $inquiry_type = config('const.inquiry_type');
        $inquiry_type_array = array_intersect($inquiry_type,$inputs['inquiry_type']);
        foreach($inquiry_type_array as $key => $value){
            $inquiry_type_array[$key] = 'checked';
        }
        $inputs = array_merge($inputs,$inquiry_type_array);
        $inputs['birthday'] = date('Y-m-d',strtotime($inputs['birthday']));
        unset($inputs['inquiry_type']);
        session()->put('reset','リセット');
        $contact->fill($inputs)->save();
        return view('contacts.thanks',compact('inputs','string_birthday'));
    }
}
