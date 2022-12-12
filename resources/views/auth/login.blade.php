@extends('admin.layouts.base')

@section('title', 'ログイン')

@section('content')
<style>
    main {
        padding: 0;
    }
    .main-contents.active {
        width: 100%;
    }
</style>
<div class="login-wrapper">
    <div id="particles"></div>
    <div>
        <div class="login-title">
        </div>
        <section class="login-box">
            <form class="login-form" method="POST" action="{{ route('storeLogin') }}">
                @csrf
                <h2>管理画面</h2>
                <div class="login-id">
                    <input id="email" type="text" class="form-control" name="email"
                        value="" required autocomplete="email" autofocus>
                </div>
                <div class="login-pw">
                    <input id="password" type="password" class="form-control"
                        name="password" required autocomplete="current-password">
                </div>
                    <div class="login-error">
                        <span class="invalid-feedback" role="alert">
                            <strong>
                                @if (session('error')) 
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                            </strong>
                        </span>
                    </div>

                <div class="main-ck_ar">
                    <input type="checkbox" id="remember" name="remember" />
                    <label for="remember" class="ck-box mg-b_20 mg-t_20">{{ __('ログイン状態を保持する') }}</label>
                </div>
                <button type="submit" class="login-btn-submit">
                    {{ __('Login') }}
                </button>
            </form>
            <div style="display: flex; justify-content:space-around;" class="">
                <p style="margin: 20px 2.5px 0 0">
                    <a class="new-btn" href="{{ route('contact_index') }}"><i class="fas fa-plus-circle mg-r_5"></i>お問い合わせ</a>
                </p>
                <p style="margin: 20px 0 0 2.5px;">
                    <a class="new-btn" href="{{ route('news_index') }}"><i class="fas fa-plus-circle mg-r_5"></i>お知らせ</a>
                </p>
            </div>
        </section>
    </div>
</div>

@endsection
