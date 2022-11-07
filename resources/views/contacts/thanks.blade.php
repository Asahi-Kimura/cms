@extends('layouts.contact')
@section('title','送信しました。')
@section('content')

<div class="Form">
    <h1>送信完了しました</h1>
    <div class="Form-Item">
        <p class="Item-Input">会社名: {{ $inputs['company_name'] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">氏名 : {{ $inputs['user_name'] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">電話番号: {{ $inputs['tele_num'] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">メールアドレス: {{ $inputs['email'] }}</p>
    </div>
    @php $birthday = explode('/',$inputs['birthday'] ) @endphp
    <div class="Form-Item">
        <p class="Item-Input">生年月日: {{ $birthday[0] }}/{{ $birthday[1] }}/{{ $birthday[2] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">性別: {{ $inputs['sex'] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">職業: {{ $inputs['job'] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">お問い合わせ内容:<br>{!! nl2br( $inputs['content'] ) !!}</p>
    </div>
    <a href="{{ route('contact_index') }}"><button type="button" class="Form-Btn">戻る</button></a>
</div>
@endsection
