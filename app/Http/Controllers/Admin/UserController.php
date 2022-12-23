<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\SearchRequest;
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
        $sort_name = config('const.sort_name');
        $sort = config('const.sort');
        $pref = config('const.pref');
        return view('admin.users.index',compact('user','pref','sort','sort_name'));
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
        $sort_name = config('const.sort_name');
        $sort = config('const.sort');
        $pref = config('const.pref');
        $sort_pattern = $request->sort;
        $sort_inc_name = $request->sort_name;
        $keyword_sort = $request->sort;
        $keyword_sort_name = $request->sort_name;
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
        //並び替え
        $user = new User;
        if($sort_name != ""){
            $user->user_sort($query,$sort_inc_name,$sort_pattern);
        }
        $user = $query->get();
        return view('admin.users.index',compact('user','pref','keyword_name','keyword_phone_number','keyword_prefecture_id','sort','sort_name','keyword_sort','keyword_sort_name'));
    }

    //削除処理//
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('user');
    }
}
