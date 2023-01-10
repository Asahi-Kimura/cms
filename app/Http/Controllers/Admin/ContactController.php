<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Contact;
use App\Models\User;

class ContactController extends Controller
{
    // 管理画面一覧
    public function show()
    {
        $contact = Contact::all();
        $user = User::all();
        $auth = config('const.authority');
        $status = config('const.status');
        $item = config('const.contact_sort_name');
        session()->forget(['keyword_status','keyword_authority','keyword_name','conact_user_id','keyword_company']);
        return view('admin.contacts.show',compact('status','contact','user','item')); 
    }

    // 管理画面詳細
    public function edit(Contact $contact)
    {
        $user = User::all();
        $contact = Contact::find($contact->id);
        $sex = config('const.sex');
        $job = config('const.job');
        $status = config('const.status');
        $inquiry_type = [];
        if($contact->questionnaire =='checked'){
            array_push($inquiry_type,'アンケート');
        }
        if($contact->company_business =='checked'){
            array_push($inquiry_type,'会社事業');
        }
        if($contact->contact =='checked'){
            array_push($inquiry_type,'お問い合わせ');
        }
        if($contact->job_offer =='checked'){
            array_push($inquiry_type,'求人');
        }
        if($contact->others =='checked'){
            array_push($inquiry_type,'その他');
        }
        return view('admin.contacts.edit',compact('status','user','contact','inquiry_type','sex','job'));
    }

    public function store(ContactRequest $request,Contact $contact)
    {
        $contact->fill($request->all())->save();  
        return redirect()->route('search_contact',['contact' => $contact]);
    }

    //検索機能処理
    public function search(SearchRequest $request,Contact $contact)
    {
        if($contact->id != null){
            $keyword_status = session()->get('keyword_status');
            $keyword_authority = session()->get('keyword_authority');
            $keyword_name = session()->get('keyword_name');  
            $keyword_company = session()->get('keyword_company');
        } else {
            session()->put('keyword_status',$request->status);
            session()->put('keyword_authority',$request->authority);
            session()->put('keyword_name',$request->name);
            session()->put('keyword_company',$request->company);
            $keyword_status = session()->get('keyword_status');
            $keyword_authority = session()->get('keyword_authority');
            $keyword_name = session()->get('keyword_name');
            $keyword_company = session()->get('keyword_company');
        }
        
        $user = User::all();
        $conact_user_id = User::where('name',$keyword_authority)->first();
        $status = config('const.status');
        
        $query = Contact::query();

        if(!empty($keyword_status)){
            $query->where('status',$keyword_status);
        }
        if(!empty($keyword_authority)){
            $query->where('user_id',$conact_user_id->id);
        }
        if(!empty($keyword_company)){
            $query->where('company_name','like',"%{$keyword_company}%");
        }
        // 並び替えする場合        
        $sort = config('const.sort');
        $contact_sort_name = config('const.contact_sort_name');
        $contact->sort($request,$query);
        $contact = $query->get();
        return view('admin.contacts.show',compact('contact','status','keyword_company','keyword_status','keyword_authority','sort','contact_sort_name','user'));
    }
    //検索削除
    public function search_delete(SearchRequest $request){
        $request->session()->forget(['keyword_status','keyword_authority','keyword_name','conact_user_id','keyword_company']);
        return redirect()->route('admin_contact');
    }

    //削除機能
    public function delete(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin_contact');
    }
}
