@extends('layouts.contact')
@section('title','ニュース一覧')
@section('content')
<div class="Form">
    <div class="alert-danger" style="color: black">ニュース一覧</div>
    @if($news != null)
        @foreach ($news as $news)
            <div class="Form-Item">
                <p class="Form-Item-Label">{{ $news->start_show }}</p>
                <div>
                    <div>
                        <a href="{{ route('news_detail',$news) }}">{{ $news->title }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        新着情報はありません。
    @endif
</div>
@endsection
