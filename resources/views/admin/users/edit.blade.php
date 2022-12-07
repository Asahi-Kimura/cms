@extends('admin.layouts.base')

@section('title', 'ユーザー作成')
@section('web-active' , 'active')

@include('admin.layouts.sub')
@include('admin.layouts.header')
@section('content')

<div class="main-contet-inner">
	<div class="page-ttl_ar">
		<h1 class="page-ttl">会員一覧</h1>
	</div>
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('admin_store',$user) }}">
                @csrf
                @if($user->id != null)
                    <input type="hidden" name="id" value="{{ $user->id }}">
                @else
                    <input type="hidden" name="id" value="">
                @endif
                <div class="form-group">
                    <label for="exampleInputUserName"><span class="Form-Item-Label-Required">必須</span>権限
                        <small>
                            @if( $errors->has('authority') )
                                <li>{{ $errors->first('authority') }}</li>
                            @endif
                        </small>
                    </label>
                    <div class="">
                        @foreach($auth as $key => $value)
                            <div class="radio-wrapper">
                                <input class="radio01-input" id="{{ $key }}" name="authority" type="radio" value="{{ $key }}" {{ $user->authority == $key ? 'checked' : '' }}>
                                <label for="{{ $key }}" class="radio01-parts">{{ $value }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputUserName"><span class="Form-Item-Label-Required">必須</span>会員名
                        <small>
                            @if( $errors->has('name') )
                                <li>{{ $errors->first('name') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="name" name="name" value="{{ old('name',$user->name) }}" class="form-control" id="exampleInputEmail1" placeholder="山田">
                </div>
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>フリガナ
                        <small>
                            @if( $errors->has('kana') )
                                <li>{{ $errors->first('kana') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="text" name="kana" value="{{ old('kana',$user->kana) }}" placeholder="タロウ">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail"><span class="Form-Item-Label-Required">必須</span>メールアドレス
                        <small>
                            @if( $errors->has('email') )
                                <li>{{ $errors->first('email') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="email" name="email"  value="{{ old('email',$user->email) }}" class="form-control" id="exampleInputEmail" placeholder="example@hoge.com">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">@if($user->password == null)<span class="Form-Item-Label-Required">必須 @endif</span>パスワード
                        <small>
                            @if( $errors->has('password') )
                                <li>{{ $errors->first('password') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    @php $phone_number = explode('-',$user->phone_number) @endphp
                    <label for="exampleInputPhone_Number"><span class="Form-Item-Label-Required">必須</span>電話番号
                        <small>
                            @if($errors->has('phone_number'))
                                <li>{{ $errors->first('phone_number') }}</li>
                            @endif
                        </small>
                    </label>

                    @dump(old('phone_number'))
                    @dump(old('phone_number[0]'))
                    <div class="col">
                        <input type="tel" name="phone_number[0]"  value="@if($user->id != null){{ old('phone_number[0]',$phone_number[0]) }}@else{{ old('phone_number[0]') }}@endif" class="form-control"  placeholder="000">
                    </div>
                    <div class="col">
                        <input type="tel" name="phone_number[1]"  value="@if($user->id != null){{ old('phone_number[1]',$phone_number[1]) }}@else{{ old('phone_number[1]')}}@endif" class="form-control"  placeholder="000">
                    </div>
                    <div class="col">
                        <input type="tel" name="phone_number[2]"  value="@if($user->id != null){{ old('phone_number[2]',$phone_number[2]) }}@else{{ old('phone_number[2]') }}@endif" class="form-control"  placeholder="000">
                    </div>
                </div>

                @dump(old('post_code'))
                @dump(old('post_code[0]'))
                <div class="form-group">
                    @php $post_code = explode('-',$user->post_code) @endphp
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>郵便番号
                        <small>
                            @if( $errors->has('post_code') )
                                <li>{{ $errors->first('post_code') }}</li>
                            @endif
                        </small>
                    </label>
                    <div class="col">
                        <input type="tel" name="post_code[0]" value="@if($user->id != null){{ old('post_code[0]',$post_code[0]) }}@else{{ old('post_code[0]')}}@endif" class="form-control" placeholder="000">
                    </div>
                    <div class="col">
                        <input type="tel" name="post_code[1]" value="@if($user->id != null){{ old('post_code[1]',$post_code[1]) }}@else{{ old('post_code[1]') }}@endif" class="form-control" placeholder="0000">
                    </div>
                </div>
                <div class="input-group pb-3">
                    <div class="input-group-prepend">
                        <label class="input-group" for="inputGroupSelect01"><span class="Form-Item-Label-Required">必須</span>都道府県
                            <small>
                                @if( $errors->has('prefecture') )
                                <li>{{ $errors->first('prefecture') }}</li>
                            @endif
                            </small>
                        </label>
                    </div>
                    <select name="prefecture_id"class="custom-select" id="inputGroupSelect01">
                            <option value="" >選択してください</option>
                            @foreach ($pref as $key => $value)
                                <option value="{{ $key }}" @if($user->id != null) {{ $value == $user->prefecture->prefecture_chinese_name ? 'selected' : '' }} @else {{ old('prefecture_id') == $key ? 'selected':'' }} @endif>{{ $value }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>市区町村
                        <small>
                            @if( $errors->has('city') )
                                <li>{{ $errors->first('city') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="text" name="city" value="{{ old('city',$user->city) }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputKana">番地・アパート名</label>
                    <input type="text" name="address" value="{{ old('address',$user->address) }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">備考欄
                        <small>
                            @if( $errors->has('remark') )
                                <li>{{ $errors->first('remark') }}</li>
                            @endif
                        </small>
                    </label>
                    <textarea name="remark"  class="form-control" id="exampleFormControlTextarea1" rows="4">{{ old('remark',$user->remark)}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
