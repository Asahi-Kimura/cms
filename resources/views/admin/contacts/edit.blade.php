@extends('admin.layouts.base')

@section('title', 'お問い合わせ編集')
@section('web-active' , 'active')

@include('admin.layouts.sub')
@include('admin.layouts.header')
@section('content')

<div class="main-contet-inner">
	<div class="page-ttl_ar">
		<h1 class="page-ttl">お問い合わせ編集</h1>
	</div>
    <div class="container">
        <div class="row justify-content-center">
            @if($errors->any())
                <div class="alert-danger">エラーがあります</div>
            @endif
            <form method="POST" action="{{ route('admin_contact_store',$contact) }}">
                @csrf
                <input type="hidden" name="id" value="{{ $contact->id }}">
                <div class="form-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">ステータス
                    </div>
                    <select name="status"class="status-select" id="inputGroupSelect01">
                        <option value="">選択してください</option>
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}" {{ $key == old('status') ? 'selected':'' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    <small>
                        @if( $errors->has( 'status' ) )
                            <li>ステータスを選択してください</li>
                        @endif 
                    </small>
                </div>
                <div class="form-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">対応者
                    </div>
                    <select name="received_name"class="status-select" id="inputGroupSelect01">
                        <option value="">会員を選択する</option>
                            @foreach ($user as $user)
                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                            @endforeach
                    </select>
                    <small>
                        @if( $errors->has( 'received_name' ) )
                            <li>対応者を選択してください</li>
                        @endif 
                    </small>
                </div>
                <div class="form-group">
                    <label class="input-group-text" for="inputGroupSelect01">お問い合わせ内容
                    </label>
                    <div>
                        {{ $contact->content }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">備考
                        <small>
                            <small>
                                @if( $errors->has('remark') )
                                    <li>{{ $errors->first('remark') }}</li>
                                @endif 
                        </small>
                    </div>
                    <textarea name="remark" form-control  rows="20">{{ old('remark') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="input-group-text" for="inputGroupSelect01">お問い合わせ情報</label>
                    <ul>
                        <li class="contact-list">
                            種別: @foreach($inquiry_type as $type)・{{ $type }}@endforeach
                        </li>
                        <li class="contact-list">
                            会社名:{{ $contact->company_name }}
                        </li>
                        <li class="contact-list">
                            氏名:{{ $contact->user_name }}
                        </li>
                        <li class="contact-list">
                            電話番号:{{ $contact->tele_num }}
                        </li>
                        <li class="contact-list">
                            メールアドレス:{{ $contact->email }}
                        </li>
                        <li class="contact-list">
                            生年月日: {{ $contact->birthday }}
                        </li>
                        <li class="contact-list">
                            性別:{{ $sex[$contact->sex] }}
                        </li>
                        <li class="contact-list">
                            職業:{{ $job[$contact->job] }}
                        </li>
                    </ul>
                </div>
                <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
