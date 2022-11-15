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
            <form method="POST" action="{{route('admin_store',$user)}}">
                @csrf
                @if($user->id != null)
                    <input type="hidden" value="{{$user->id}}">
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
                            @if( $errors->has('name') )
                                <li>{{ $errors->first('name') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="name" name="name" value="{{old('name',$user->name)}}" class="form-control" id="exampleInputEmail1" placeholder="山田">
                </div>
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>フリガナ
                        <small>
                            @if( $errors->has('kana') )
                                <li>{{ $errors->first('kana') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="text" name="kana" value="{{old('kana',$user->kana)}}" placeholder="タロウ">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail"><span class="Form-Item-Label-Required">必須</span>メールアドレス
                        <small>
                            @if( $errors->has('email') )
                                <li>{{ $errors->first('email') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="email" name="email"  value="{{old('email',$user->email)}}" class="form-control" id="exampleInputEmail" placeholder="example@hoge.com">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1"><span class="Form-Item-Label-Required">必須 </span>パスワード
                        <small>
                            @if( $errors->has('password') )
                                <li>{{ $errors->first('password') }}</li>
                            @endif
                        </small>
                    </label>
                        

                            <input type="password" name="password" value="{{old('password',$user->password)}}" class="form-control" id="exampleInputPassword1" placeholder="Password">


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
                    @php $phone_number = explode('-',$user->phone_number) @endphp
                    <input type="tel" name="phone_number[0]"  value="{{old('phone_number[0]',$phone_number[0])}}" class="form-control"  placeholder="000">
                </div>
                <div class="col">
                    <input type="tel" name="phone_number[1]"  value="{{old('phone_number[1]',$phone_number[1])}}" class="form-control"  placeholder="000">
                </div>
                <div class="col">
                    <input type="tel" name="phone_number[2]"  value="{{old('phone_number[2]',$phone_number[2])}}" class="form-control"  placeholder="000">
                </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>郵便番号
                        <small>
                            @if( $errors->has('post_code') )
                                <li>{{ $errors->first('post_code') }}</li>
                            @endif
                        </small>
                    </label>
                    <div class="col">
                        @php $post_code = explode('-',$user->post_code) @endphp
                        <input type="tel" name="post_code[0]" value="{{old('post_code[0]',$post_code[0])}}" class="form-control" placeholder="000">
                    </div>
                    <div class="col">
                        <input type="tel" name="post_code[1]" value="{{old('post_code[1]',$post_code[1])}}" class="form-control" placeholder="0000">
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
                    <select name="prefecture"class="custom-select" id="inputGroupSelect01">
                            @foreach ($pref as $key => $value)
                                <option value="{{$key}}" selected>{{$value}}</option>
                            @endforeach
                            <option value="" selected>選択してください</option>
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
                    <input type="text" name="city" value="{{old('city',$user->city)}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputKana">番地・アパート名</label>
                    <input type="text" name="address" value="{{old('address',$user->address)}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">備考欄
                        <small>
                            @if( $errors->has('remark') )
                                <li>{{ $errors->first('remark') }}</li>
                            @endif
                        </small>
                    </label>
                    <textarea name="remark"  class="form-control" id="exampleFormControlTextarea1" rows="4">{{old('remark',$user->remark)}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
