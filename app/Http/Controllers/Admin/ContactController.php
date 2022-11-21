<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;

class ContactController extends Controller
{
    // 管理画面一覧
    public function show(Contact $contact,User $user)
    {
        $contact = Contact::all();
        $user = User::all();
        $status = config('const.status');
        return view('admin.contacts.show',compact('status','contact','user'));
    }

    // 管理画面詳細
    public function edit()
    {
        return view('admin.contacts.edit');
    }
    public function search()
    {

    }
    //削除
    public function delete(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('user');
    }
}
