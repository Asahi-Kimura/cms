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
            <div class="alert-danger">エラーがあります</div>
            <form method="POST" action="">
                <div class="form-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">ステータス
                    </div>
                    <select name="status"class="status-select" id="inputGroupSelect01">
                        <option value="">未対応</option>
                        <option value="">対応中</option>
                        <option value="">対応済</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">対応者
                        <small>
                            ※エラーを表示してください
                        </small>
                    </div>
                    <select name="status"class="status-select" id="inputGroupSelect01">
                        <option value="">会員一覧が表示されます</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="input-group-text" for="inputGroupSelect01">お問い合わせ内容
                    </label>
                    <div>
                        お問い合わせ内容が入ります
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">備考
                        <small>
                            ※エラーを表示してください
                        </small>
                    </div>
                    <textarea name="remark" form-control  rows="20"></textarea>
                </div>
                <div class="form-group">
                    <label class="input-group-text" for="inputGroupSelect01">お問い合わせ情報</label>
                    <ul>
                        <li class="contact-list">
                            種別:アンケート　会社事業
                        </li>
                        <li class="contact-list">
                            会社名:revite
                        </li>
                        <li class="contact-list">
                            氏名:hoge
                        </li>
                        <li class="contact-list">
                            電話番号:000-111-222
                        </li>
                        <li class="contact-list">
                            メールアドレス:test@gmail.com
                        </li>
                        <li class="contact-list">
                            生年月日: 2022/10/01
                        </li>
                        <li class="contact-list">
                            性別:男
                        </li>
                        <li class="contact-list">
                            職業:エンジニア
                        </li>
                    </ul>
                </div>
                <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
