@extends('layouts.contact')
@section('title','エラー')
@section('content')

<div class="Form">
    <h1>ErrorCode:419</h1>
    <div class="Form-Item">
        <p class="error-Label">
            セッション切れのためアクセスできません。お手数ですがTOPへお戻りください。
        </p>
    </div>
    @if(Auth::check())
        {{-- ユーザのみログインへ --}}
        <a href="{{ route('login') }}">ログイン画面に戻る</a>
    @else
        <a href="{{ route('contacts.index') }}">お問い合わせTOPへ戻る</a>
    @endif
</div>
@endsection
