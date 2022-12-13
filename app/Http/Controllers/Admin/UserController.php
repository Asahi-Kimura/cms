<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\SortRequest;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //　会員一覧
    public function show(User $user)
    {
        if($user != null){
            $user = User::all();
        }
        $pref = config('const.pref');
        $sort = config('const.sort');
        return view('admin.users.index',compact('user','pref','sort'));
    }
    
    // 作成画面.編集画面
    public function create(User $user)
    {
        if($user->id != null){
            $user = User::find($user->id);
        }
        $auth = config('const.authority');
        $pref = config('const.pref');
        return view('admin.users.edit',compact('user','pref','auth'));
    }
    //編集処理
    public function store(UserRequest $request ,User $user)
    {
        $attributes = $request->all();
        if($attributes['password'] != null){
            $attributes['password'] = Hash::make($attributes['password']);     
        } else {
            unset($attributes['password']);
        }
        $user->fill($attributes)->save();
        return redirect()->route('user');
    }
    //検索機能
    public function search(SearchRequest $request,Prefecture $prefecture)
    {
        $sort = config('const.sort');
        $pref = config('const.pref');
        $keyword_name = $request->name;
        $keyword_phone_number = $request->phone_number;
        $keyword_prefecture_id = $request->prefecture_id;
        $query = User::query();
        if(!empty($keyword_name)){
            $query->where('name','like',"%{$keyword_name}%");
        }
        if(!empty($keyword_phone_number)){
            $query->where('phone_number','like',"%{$keyword_phone_number}%");
        }
        if(!empty($keyword_prefecture_id)){
            $int_prefecture_id = intval($request->prefecture_id);
            $prefecture = Prefecture::where('id',$int_prefecture_id)->first();
            $prefecture_id = $prefecture->id;
            $str_prefecture_id = strval($prefecture_id);
            $keyword_prefecture_id = $str_prefecture_id;
            $query->where('prefecture_id',$keyword_prefecture_id);
        }
        $user = $query->get();
        return view('admin.users.index',compact('user','pref','keyword_name','keyword_phone_number','keyword_prefecture_id'));
    }

    //並び替え機能作成途中
    public function sort(SortRequest $request)
    {

        $attributes = $request->all();
        $user = User::all();
        $sort = config('const.sort');
        $pref = config('const.pref');

        if($sort != null){
            if($attributes['sort'] == 'asc'){
                if($attributes['name'] != null){
                    $sort_asc_name = User::orderBy('name','asc');
                    if($attributes['email'] != null){
                        $sort_asc_name_and_email = $sort_asc_name->orderBy('name','asc');
                    }
                } else {
                    $sort_asc_email = User::orderBy('email','asc');
                }
            }
            if($attributes['sort'] == 'desc'){
                if($attributes['name'] != null){
                    $sort_desc_name = User::orderBy('name','desc');
                    if($attributes['email'] != null){
                        $sort_desc_name_and_email = $sort_desc_name->orderBy('name','desc');
                    } else {
                    $sort_desc_email = User::orderBy('email','desc')->get();    
                    }
                }        
            }
        }
        
        return view('admin.users.index',compact('user','pref','sort'));        
    }

    //削除処理//
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('user');
    }
}
