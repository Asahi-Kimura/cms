@extends('admin.layouts.base')

@section('title','HOME')

@include('admin.layouts.sub')
@include('admin.layouts.header')
@section('content')
<div class="main-contet-inner">
    <div class="page-ttl_ar">
        <h1 class="page-ttl">HOME</h1>
    </div>
    <div class="page-contents">
        <div class="dashbord_ar">
            <div class="all-nav">
                <ul>
                    <li>
                        <h4>会員登録</h4>
                        <ul>
                            <li>
                                <a href="{{ route('user') }}">会員一覧</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>お問い合わせ</h4>
                        <ul>
                            <li>
                                <a href="{{ route('admin_contact') }}">お問い合わせ一覧</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>新着情報</h4>
                        <ul>
                            <li>
                                <a href="{{ route('admin_news') }}">新着情報</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pageJs')
@endsection
