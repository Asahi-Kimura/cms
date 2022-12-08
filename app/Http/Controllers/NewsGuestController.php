<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsGuestController extends Controller
{
    public function news_index(News $news)
    {
        if(News::whereNull('end_show')->where('start_show','<=',now())->orWhere('end_show','>=',now())->where('start_show','<=',now())->get()){
            $news = News::whereNull('end_show')->where('start_show','<=',now())->orWhere('end_show','>=',now())->where('start_show','<=',now())->get();
        }  
        return view('news.index',compact('news'));
    }

    public function news_detail(News $news)
    {
        if($news->id != null){
            $news = News::find($news->id);
        }
        return view('news.detail',compact('news'));
    }
}