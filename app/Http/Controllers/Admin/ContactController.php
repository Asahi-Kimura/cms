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
        return view('admin.contacts.show',compact('status','contact','user'));
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
        return redirect()->route('admin_contact');
    }

    //検索機能処理
    public function search(SearchRequest $request,Contact $contact)
    {
        $contact_sort_name = config('const.contact_sort_name');
        $sort = config('const.sort');
        $sort_pattern = $request->sort;
        $sort_inc_name = $request->sort_name;
        $user = User::all();
        $keyword_status = $request->status;
        $keyword_authority = $request->authority;
        $keyword_name = $request->name;
        $conact_user_id = User::where('name',$keyword_authority)->first();
        $keyword_company = $request->company;     
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
        if(!empty($sort_pattern)){
            if($sort_pattern == 'asc'){
                if($sort_inc_name == 'sort_status'){
                    $query->orderBy('status','asc');
                }
                if($sort_inc_name == 'sort_authority'){
                    $query->orderBy('user_id','asc');
                }
                if($sort_inc_name == 'sort_company'){
                    $query->orderBy('company_name','asc');
                }
                if($sort_inc_name == 'sort_name'){
                    $query->orderBy('user_name','asc');
                }
            }
            if($sort_pattern == 'desc'){
                
                if($sort_inc_name == 'sort_status'){
                    $query->orderBy('status','desc');
                }
                if($sort_inc_name == 'sort_authority'){
                    $query->orderBy('user_id','desc');
                }
                if($sort_inc_name == 'sort_company'){
                    $query->orderBy('company_name','desc');
                }
                if($sort_inc_name == 'sort_name'){
                    $query->orderBy('user_name','desc');
                }
            }
        }
        $contact = $query->get();
        return view('admin.contacts.show',compact('contact','status','keyword_company','keyword_status','keyword_authority','sort','contact_sort_name','user'));
    }
    
    //削除機能
    public function delete(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin_contact');
    }
}
