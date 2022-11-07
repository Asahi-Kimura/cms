@extends('layouts.contact')
@section('title','確認画面')
@section('content')
<form method="POST" action="{{ route('contact_send') }}">
    @csrf
    <div class="Form">
        <div class="Form-Item">
            <p class="Item-Input">種別:<br>
                アンケート
                会社事業
            </p>
        </div>
        
        <div class="Form-Item">
            <p class="Item-Input">会社名: {{ $attributes['company_name'] }}</p>
        <div class="Form-Item">
            <p class="Item-Input">会社名: {{ $attributes['company_name'] }}</p>
        </div>
        <div class="Form-Item">
            <p class="Item-Input">氏名: {{ $attributes['user_name'] }}</p>
        </div>
        <div class="Form-Item">
            <p class="Item-Input">電話番号: {{ $attributes['tele_num'] }}</p>
        </div>
        <div class="Form-Item">
            <p class="Item-Input">メールアドレス: {{ $attributes['email'] }}</p>
        </div>
        <div class="Form-Item">
            <p class="Item-Input">生年月日: {{ $attributes['birthday'] }}</p>

            @foreach($attributes as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </div>
        <div class="Form-Item">
            <p class="Item-Input">性別: {{ $sex[ $attributes['sex'] ] }}</p>
        </div>
        <div class="Form-Item">
            <p class="Item-Input">職業: {{ $job[$attributes['job']] }}</p>
        </div>
        <div class="Form-Item">
            <p class="Item-Input">お問い合わせ内容:<br>
                {!! nl2br($attributes['content']) !!}
            </p>
        </div>
        <input type="submit" class="Form-Btn" id='submit' value="送信する">
        <button type="button" class="Form-Btn" onClick="history.back()">戻る</button>
    </div>
</form>
<script>
    $('#submit').click(function () { 
        alert('送信しますか？');
    });


</script>
@endsection
