@extends('layouts.contact')
@section('title','ニュース一覧')
@section('content')
<div class="Form">
    <div class="alert-danger" style="color: black">タイトルが入ります</div>
    <div class="Form-Item" style="justify-content: space-between">
        <p class="Form-Item-Label">
            {{-- ※公開時間 --}}
            2022/10/10
        </p>
        <div>
            <a href="">ファイル名が入ります</a>
        </div>
    </div>
    <div>
        お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容
        お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容
        お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容
        お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容
        お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容お問い合わせ内容
    </div>
    <button type="button" class="Form-Btn" onClick="history.back()">戻る</button>
</div>
@endsection
