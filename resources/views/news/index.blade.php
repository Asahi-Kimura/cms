@extends('layouts.contact')
@section('title','ニュース一覧')
@section('content')
<div class="Form">
    <div class="alert-danger" style="color: black">ニュース一覧</div>
    @for ($i = 3; $i<10; $i++)
    <div class="Form-Item">
        <p class="Form-Item-Label">
            2022/10/10
        </p>
        <div>
            <div>
                <a href="{{ route('news_detail') }}">タイトル</a>
            </div>
        </div>
    </div>
    @endfor
</div>
@endsection
