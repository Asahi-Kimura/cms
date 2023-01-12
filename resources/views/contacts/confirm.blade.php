@extends('layouts.contact')
@section('title','確認画面')
@section('content')
<form method="POST" action="{{ route('contact_send') }}"> 
    @csrf
    <input type="hidden" name="status" value="1">
    <input type="hidden" name="file_image" value='{{ $temp_image }}'>
    @foreach( $attributes['inquiry_type'] as $key => $value )
        <input type="hidden" name="inquiry_type[]" value="{{ $value }}" >
    @endforeach
    <input name="company_name" value ="{{ $attributes['company_name'] }}" type="hidden" >
    <input name="user_name" value ="{{ $attributes['user_name'] }}" type="hidden">
    <input name="tele_num" value ="{{ $attributes['tele_num'] }}" type="hidden">
    <input name="email" value ="{{ $attributes['email'] }}" type="hidden" >
    <input name="birthday" value ="{{ $attributes['birthday'] }}" type="hidden">
    <input name="sex" value ="{{ $attributes['sex'] }}" type="hidden">   
    <input name="job" value ="{{ $attributes['job'] }}" type="hidden">          
    <input name="content" value ="{!! nl2br($attributes['content']) !!}" type="hidden">
    <div class="Form">
        <div class="Form-Item">
            <p class="Item-Input">種別:
                @foreach($attributes['inquiry_type'] as $key => $value)
                    ・{{$value}}
                @endforeach
            </p>
        </div>
        <div class="Form-Item">
            <p class="Item-Input">会社名: {{ $attributes['company_name'] }}</p>
        </div>
        <div class="Form-Item">
            <p class="Item-Input">氏名: {{ $attributes['user_name'] }}</p>
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
        <div class="Form-Item">
            <p class="Item-Input">生年月日: {{ $attributes['birthday'] }}</p>
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
        <button type="submit" class="Form-Btn" name="back" value="back">戻る</button>
    </div>
</form>

<script>
    $('#submit').click(function () { 
        if(!confirm('送信しますか？')){
            return false;
        }
    });
</script>
<script>
    var image = document.getElementById('confirm_image');
    image.style.margin = "0px 0px 0px 100px";
    image.width = 100;
    image.height = 100;
</script>
@endsection
