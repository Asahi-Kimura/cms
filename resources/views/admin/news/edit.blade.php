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
            <form method="POST" action="">
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>タイトル
                        <small>
                            ※エラー文を表示してください
                        </small>
                    </label>
                    <textarea name="title"  class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail"><span class="Form-Item-Label-Required">必須</span>画像
                        <small>
                            ※エラー文を表示してください
                        </small>
                    </label>
                    <input type="file" name=""  value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"><span class="Form-Item-Label-Required">必須 </span>本文
                        <small>
                            ※エラー文を表示してください
                        </small>
                    </label>
                    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                </div>

                <div class="input-group pb-3">
                    <div class="input-group-prepend">
                        <label class="input-group" for="inputGroupSelect01"><span class="Form-Item-Label-Required">必須</span>公開開始
                            <small>
                                ※エラー文を表示してください
                            </small>
                        </label>
                    </div>
                    {{-- // datetimepickerを利用してください --}}
                    <input type="text" name="" value="" class="form-control">
                </div>
                <div class="input-group pb-3">
                    <div class="input-group-prepend">
                        {{-- // datetimepickerを利用してください --}}
                        <label class="input-group" for="inputGroupSelect01">公開終了</label>
                    </div>
                    <input type="text" name="" value="" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
