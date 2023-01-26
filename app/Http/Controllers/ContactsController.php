<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Mail\AdminContactMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    public $inquiry_types;
    public $sex; 
    public $job;

    public function __construct()
    {
        $this->inquiry_types = config('const.inquiry_type');
        $this->sex = config('const.sex');
        $this->job = config('const.job');
    }

    public function index()
    {
        if(session()->has('reset')){
            session()->forget('reset');
            session()->forget('image');
        }
        return view('contacts.index',
        [
            'inquiry_type' => $this->inquiry_types,
            'sex' => $this->sex,
            'job' => $this->job,
        ]);
    }

    public function confirm(ContactRequest $request)
    {
        if(session()->has('reset'))
        {
            session()->forget('image');
            return redirect()->route('contact_index');
        }
        $attributes = $request->all();
        return view('contacts.confirm',
        [   
            'attributes' => $attributes,
            'inquiry_type' => $this->inquiry_types,
            'sex' => $this->sex,
            'job' => $this->job,
        ]);
    }

    public function send(ContactRequest $request,Contact $contact)
    {
        if($request->back != null){
            return redirect()->route('contact_index')->withInput();
        }
        if(session()->has('reset'))
        {
            session()->forget('image');
            return redirect()->route('contact_index');
        }
        $string_birthday = $request->birthday;
        $attributes = $request->all();
        $attributes = $contact->inpuiry_type_checked($attributes);
        $attributes['birthday'] = date('Y-m-d',strtotime($attributes['birthday']));
        unset($attributes['inquiry_type']);
        session()->put('reset','reset');
        $contact->fill($attributes)->save();
        $attributes['inquiry_type'] = $request->inquiry_type;
        //送信元に送信
        Mail::to($attributes['email'])->send(new ContactMail($attributes,$string_birthday,$this->sex,$this->job));
        //管理者に送信
        Mail::to('test.kimura.ak0914@gmail.com')->send(new AdminContactMail($attributes,$string_birthday,$this->sex,$this->job));
        return view('contacts.thanks',
        [
            'attributes' => $attributes,
            'string_birthday' => $string_birthday,
            'sex' => $this->sex,
            'job' => $this->job,
        ]);
    }
}
