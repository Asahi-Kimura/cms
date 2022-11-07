<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //　会員一覧
    public function show()
    {
        return view('admin.users.index');
    }

    // 作成画面.編集画面
    public function create(User $user)
    {
        return view('admin.users.edit',compact('user'));
    }
    //編集処理
    public function store(UserRequest $request ,User $user)
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
