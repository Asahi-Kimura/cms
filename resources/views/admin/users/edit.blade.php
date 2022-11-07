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
            <form method="POST" action="{{route('admin_store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUserName"><span class="Form-Item-Label-Required">必須</span>権限
                        <small>
                            @if( $errors->has('authority') )
                                <li>{{ $errors->first('authority') }}</li>
                            @endif
                        </small>
                    </label>
                    <div class="">
                        <div class="radio-wrapper" >
                            <input class="radio01-input" id="1" checked="checked" name="authority" type="radio" value="auth">
                            <label for="1" class="radio01-parts">管理者</label>
                        </div>
                        <div class="radio-wrapper">
                            <input class="radio01-input" id="2" name="authority" type="radio" value="guest">
                            <label for="2" class="radio01-parts">一般</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputUserName"><span class="Form-Item-Label-Required">必須</span>会員名
                        <small>
                            @if( $errors->has('authority') )
                                <li>{{ $errors->first('authority') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="name" name="name" value="" class="form-control" id="exampleInputEmail1" placeholder="山田">
                </div>
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>フリガナ
                        <small>
                            @if( $errors->has('name') )
                                <li>{{ $errors->first('name') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="text" name="kana" value="" placeholder="タロウ">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail"><span class="Form-Item-Label-Required">必須</span>メールアドレス
                        <small>
                            @if( $errors->has('kana') )
                                <li>{{ $errors->first('kana') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="email" name="email"  value="" class="form-control" id="exampleInputEmail" placeholder="example@hoge.com">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"><span class="Form-Item-Label-Required">必須 </span>パスワード
                        <small>
                            @if( $errors->has('password') )
                                <li>{{ $errors->first('password') }}</li>
                            @endif
                        </small>
                    </label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPhone_Number"><span class="Form-Item-Label-Required">必須</span>電話番号
                        <small>
                            @if( $errors->has('phone_number') )
                                <li>{{ $errors->first('phone_number') }}</li>
                            @endif
                        </small>
                    </label>
                <div class="col">
                    <input type="tel" name="phone_number['0']"  value="" class="form-control"  placeholder="000">
                </div>
                <div class="col">
                    <input type="tel" name="phone_number['1']"  value="" class="form-control"  placeholder="000">
                </div>
                <div class="col">
                    <input type="tel" name="phone_number['2']"  value="" class="form-control"  placeholder="000">
                </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>郵便番号
                        <small>
                            @if( $errors->has('kana') )
                                <li>{{ $errors->first('kana') }}</li>
                            @endif
                        </small>
                    </label>
                    <div class="col">
                        <input type="tel" name="post_code" value="" class="form-control" placeholder="000">
                    </div>
                    <div class="col">
                        <input type="tel" name="post_code" value="" class="form-control" placeholder="000">
                    </div>
                </div>
                <div class="input-group pb-3">
                    <div class="input-group-prepend">
                        <label class="input-group" for="inputGroupSelect01"><span class="Form-Item-Label-Required">必須</span>都道府県
                            <small>
                                @if( $errors->has('post_code') )
                                <li>{{ $errors->first('post_code') }}</li>
                            @endif
                            </small>
                        </label>
                    </div>
                    <select name="prefecture_id"class="custom-select" id="inputGroupSelect01">
                        <option value="" selected>選択してください</option>
                        <option value="">都道府県を表示してください</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>市区町村
                        <small>
                            @if( $errors->has('prefecture_id') )
                                <li>{{ $errors->first('prefecture_id') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="text" name="city" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputKana">番地・アパート名</label>
                    <input type="text" name="address" value="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">備考欄
                        <small>
                            @if( $errors->has('remark') )
                                <li>{{ $errors->first('remark') }}</li>
                            @endif
                        </small>
                    </label>
                    <textarea name="remark"  class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
