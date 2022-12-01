<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\NewsSearchRequest;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session;
use DateTime;

class NewsController extends Controller
{
    public function index(News $news)
    {
        $news = News::all();
        $status = config('const.open');
        return view('admin.news.index',compact('status','news'));
    }

    public function edit(News $news)
    {
        $user = Auth::user();
        if($news->id != null){
            $news = News::find($news->id);
        }
        return view('admin.news.edit',compact('news','user'));    
    }
    public function store(NewsRequest $request,News $news){
        $attributes = $request->all();
        $replace_array = [" ","/",":"]; 
        $attributes['start_show'] = str_replace($replace_array,'',$attributes['start_show']);
        $attributes['start_show'] = date('Y-m-d H:i',strtotime($attributes['start_show']));
        if($attributes['end_show'] != null){
            $attributes['end_show'] = str_replace($replace_array,'',$attributes['end_show']);
            $attributes['end_show'] = date('Y-m-d H:i',strtotime($attributes['end_show']));
        }
        $news_dir = 'news';
        $file_name = $request->file('file_image')->getClientOriginalName();
        $attributes['file_image'] = $request->file_image->storeAs('public/'.$news_dir,$file_name);
        $news->fill($attributes)->save();
        return redirect()->route('admin_news');
    }
    // public function search(NewsSearchRequest $request,News $news)
    // {
    //     $pref = config('const.pref');
    //     $keyword_status = $request->status;
    //     $keyword_title = $request->title;
        
    //     $query = News::query();
    //     dd($query);
    //     $start_show = new DateTime($news->start_show);
    //     $now_time = new DateTime();
    //     $now_time->format('Y-m-d H:i');
    //     $end_show = new DateTime($news->end_show);
    //     if(!empty($keyword_status)){
    //         if($keyword_status['0'] == '公開前'){
    //             $query->where();
    //         }
            
    //     }
    //     $news = $query->get();

    //     return view('admin.users.index',compact('news','pref'));
    // }

    //削除処理//
    // public function delete(News $news)
    // {
    //     $news->delete();
    //     return redirect()->route('user');
    // }
}
