<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //　会員一覧
    public function show(User $user)
    {
        if($user != null){
            $user = User::all();
        }
        return view('admin.users.index',compact('user'));
    }

    // 作成画面.編集画面
    public function create(User $user)
    {
        // dd($user->id);
        if($user->id != null){
            $user = User::find($user->id);
        } 
        $pref = config('const.pref');
        return view('admin.users.edit',compact('user','pref'));
    }
    //編集処理
    public function store(UserRequest $request ,User $user,Prefecture $prefecture)
    {
        $attributes = $request->all();
        if($user->id == null ){
            $user->password = Hash::make($$attributes['password']);
        } else { 
            if($user->password != null){
                $user->password = Hash::make($$attributes['password']);
            } else {
                unset($attributes['password']);
            };
        }
        $user->fill($attributes)->save();
        return view('admin.users.index');
    }
    // //削除処理//
    // public function delete(User $user)
    // {

    // }
}
