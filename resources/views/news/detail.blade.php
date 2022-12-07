@extends('layouts.contact')
@section('title','ニュース一覧')
@section('content')
<div class="Form">
    <div class="alert-danger" style="color: black">タイトル：{{ $news->title }}</div>
    <div class="Form-Item" style="justify-content: space-between">
        <p class="Form-Item-Label">
            {{-- ※公開時間 --}}
            {{ $news->start_show }}
        </p>
        @php
            $image_array = explode('/',$news->file_image);
            $image = str_replace('public','',$news->file_image);
        @endphp

        <div>
            <a href="{{ asset('storage'.$image)}}">画像名：{{ end($image_array) }}</a>
        </div>
    </div>
    <div>
        内容：<br>
        {{ $news->content }}
    </div>
    <button type="button" class="Form-Btn" onClick="history.back()">戻る</button>
</div>
@endsection
