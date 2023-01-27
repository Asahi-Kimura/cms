<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\SearchRequest;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(News $news)
    {
        $news = News::all();
        $status = config('const.open');
        session()->forget(['keyword_status','keyword_title']);
        return view('admin.news.index',compact('status','news'));
    }

    public function edit(News $news)
    {
        $user = Auth::user();
        if($news->id != null){
            $news = News::find($news->id);
            $news->start_show = substr($news->start_show,0,-3);
            $news->end_show = substr($news->end_show,0,-3);
        }
        return view('admin.news.edit',compact('news','user'));    
    }

    public function store(NewsRequest $request,News $news)
    {
        $attributes = $request->all();
        $attributes['start_show'] = $news->text_convert_datetime($attributes['start_show']);
        if($attributes['end_show'] != null){
            $attributes['end_show'] = $news->text_convert_datetime($attributes['end_show']);
        }
        if(isset($attributes['file_image'])){
            $file_name = $request->file('file_image')->getClientOriginalName();
            $attributes['file_image'] = $request->file_image->storeAs('public/news',$file_name);
        }
        $news->fill($attributes)->save();
        return redirect()->route('search_news',['news' => $news]);
    }

    public function search(SearchRequest $request,News $news)
    {
        $status = config('const.open');
        if($news->id != null){
            $keyword_status = session()->get('keyword_status');
            $keyword_title = session()->get('keyword_title');
        } else {
            $request->session()->put('keyword_status',$request->status);
            $request->session()->put('keyword_title',$request->title);
            $keyword_status = session()->get('keyword_status');
            $keyword_title = session()->get('keyword_title');
        }
        $query = News::query();
        if(!empty($keyword_status)){
            if($keyword_status == '1'){
                $query->where('start_show','>=',now());
                }    
            }
            if($keyword_status == '2'){
                if(News::whereNull('end_show')->where('start_show','<=',now())->orWhere('end_show','>=',now())->where('start_show','<=',now())->get()){
                    $query->whereNull('end_show')->where('start_show','<=',now())->orWhere('end_show','>=',now())->where('start_show','<=',now())->get();
                } 
            }    
            if($keyword_status == '3'){
                if(News::where('end_show','<=',now())->get()){
                    $query->where('end_show','<=',now())->get();
                }    
            }
        
        if(!empty($keyword_title)){
            $query->where('title','like',"%{$keyword_title}%");
        }
        $news = $query->get();
        return view('admin.news.index',compact('news','status','keyword_status','keyword_title'));
    }

    public function search_delete(SearchRequest $request)
    {
        $request->session()->forget(['keyword_status','keyword_title']);
        return redirect()->route('admin_news');
    }
    
    //削除処理//
    public function delete(News $news)
    {
        $news->delete();
        return redirect()->route('admin_news');
    }
}

