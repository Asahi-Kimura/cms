<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    // 管理画面一覧
    public function show()
    {
        return view('admin.contacts.show');
    }

    // 管理画面詳細
    public function edit()
    {
        return view('admin.contacts.edit');
    }
}
