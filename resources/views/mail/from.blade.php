<div>お問い合せいただき誠にありがとうございます</div>
<div>お問い合わせいただいた内容は下記のとおりです。</div>
__________________________________________________________________________

<div>
    <p>種別:
    @foreach($attributes['inquiry_type'] as $key => $value)
        ・{{$value}}
    @endforeach
</div>
</p>
<div>
    <p>会社名: {{ $attributes['company_name'] }}</p>
</div>
<div>
    <p>氏名 : {{ $attributes['user_name'] }}</p>
</div>
<div>
    <p>電話番号: {{ $attributes['tele_num'] }}</p>
</div>
<div>
    <p>メールアドレス: {{ $attributes['email'] }}</p>
</div>
@php $birthday = explode('/',$attributes['birthday'] ) @endphp
<div>
    @php 
        $birthday = explode("/",$string_birthday,3);
    @endphp
    <p>生年月日: {{ $birthday[0] }}/{{ $birthday[1] }}/{{ $birthday[2] }}</p>
</div>
<div>
    <p>性別: {{ $sex[$attributes['sex']] }}</p>
</div>
<div>
    <p>職業: {{ $job[$attributes['job']] }}</p>
</div>
<div>
    <p>お問い合わせ内容:<br>{!! nl2br( $attributes['content'] ) !!}</p>
</div>

__________________________________________________________________________
もし間違いがある場合は文末の連絡先まで、ご一報ください。 よろしくお願いいたします。