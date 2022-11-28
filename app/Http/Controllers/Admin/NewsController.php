<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(News $news)
    {
        if($news->id != null){
            $news = News::all();
        }
        $status = config('const.status');
        return view('admin.news.index',compact('status','news'));
    }

    public function edit(News $news)
    {
        if($news->id != null){
            $news = News::find($news->id);
        }
        return view('admin.news.edit',compact('news'));    
    }
    public function store(NewsRequest $request,News $news){
        $attributes = $request->all();
        $news_dir = 'news';
        $file_name = $request->file_image->getClientOriginalName();
        $request->file_image->store('public/'.$news_dir);
        dd('hogehoge');


        return redirect()->route('admin_news');
    }
    // public function search(UserSearchRequest $request,Prefecture $prefecture)
    // {
    //     $pref = config('const.pref');
    //     $keyword_name = $request->name;
    //     $keyword_phone_number = $request->phone_number;
    //     $keyword_prefecture_id = $request->prefecture_id;

    //     $query = User::query();
    //     if(!empty($keyword_name)){
    //         $query->where('name','like',"%{$keyword_name}%");
    //     }
    //     if(!empty($keyword_phone_number)){
    //         $query->where('phone_number','like',"%{$keyword_phone_number}%");
    //     }
    //     if(!empty($keyword_prefecture_id)){
    //         $int_prefecture_id = intval($request->prefecture_id);
    //         $prefecture = Prefecture::where('id',$int_prefecture_id)->first();
    //         $prefecture_id = $prefecture->id;
    //         $str_prefecture_id = strval($prefecture_id);
    //         $keyword_prefecture_id = $str_prefecture_id;
    //         $query->where('prefecture_id',$keyword_prefecture_id);
    //     }
    //     $user = $query->get();

    //     return view('admin.users.index',compact('user','pref'));
    // }

    //削除処理//
    // public function delete(News $news)
    // {
    //     $news->delete();
    //     return redirect()->route('user');
    // }
}
