@extends('layouts.contact')
@section('title','送信しました。')
@section('content')

<div class="Form">
    <h1>送信完了しました</h1>

    <div class="Form-Item">
        <p class="Item-Input">種別:
        @foreach($attributes['inquiry_type'] as $key => $value)
            ・{{$value}}
        @endforeach
    </div>
    </p>
    <div class="Form-Item">
        <p class="Item-Input">会社名: {{ $attributes['company_name'] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">氏名 : {{ $attributes['user_name'] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">証明写真: 
            <img id="confirm_image" src="{{ $temp_image }}" alt="証明写真">
        </p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">電話番号: {{ $attributes['tele_num'] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">メールアドレス: {{ $attributes['email'] }}</p>
    </div>
    @php $birthday = explode('/',$attributes['birthday'] ) @endphp
    <div class="Form-Item">
        @php 
            $birthday = explode("/",$string_birthday,3);
        @endphp
        <p class="Item-Input">生年月日: {{ $birthday[0] }}/{{ $birthday[1] }}/{{ $birthday[2] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">性別: {{ $sex[$attributes['sex']] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">職業: {{ $job[$attributes['job']] }}</p>
    </div>
    <div class="Form-Item">
        <p class="Item-Input">お問い合わせ内容:<br>{!! nl2br( $attributes['content'] ) !!}</p>
    </div>
    <a href="{{ route('contact_index') }}"><button type="button" class="Form-Btn">戻る</button></a>
</div>

<script>
    $("#file_image").on('change', function (e) {
        var reader = new FileReader();
        reader.onload = function(e){
            $("#sample").attr("src",e.target.result).css('width', '100px').css('height', '100px');
        }
        reader.readAsDataURL(e.target.files[0]);
    });
@endsection
