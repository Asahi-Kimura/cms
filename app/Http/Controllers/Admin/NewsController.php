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
    
    
    public function search(NewsSearchRequest $request)
    {
        $status = config('const.open');
        $keyword_status = $request->status;
        $keyword_title = $request->title;
        $query = News::query();

        if(!empty($keyword_status)){
            if($keyword_status == '公開開始前'){
                $query->where('start_show','>=',now());
                }    
            }
            if($keyword_status == '公開中'){
                if(News::whereNull('end_show')->where('start_show','<=',now())->orWhere('end_show','>=',now())->where('start_show','<=',now())->get()){
                    $query->whereNull('end_show')->where('start_show','<=',now())->orWhere('end_show','>=',now())->where('start_show','<=',now())->get();
                } 
            }    
            if($keyword_status == '公開終了'){
                if(News::where('end_show','<=',now())->get()){
                    $query->where('end_show','<=',now())->get();
                }    
            }
        
        if(!empty($keyword_title)){
            $query->where('title','like',"%{$keyword_title}%");
        }
        $news = $query->get();
        return view('admin.news.index',compact('news','status'));
    }

    //削除処理//
    public function delete(News $news)
    {
        $news->delete();
        return redirect()->route('user');
    }
}

