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
            <form method="POST" action="{{ route('admin_news_store',$news) }}" enctype="multipart/form-data">
                @csrf
                {{-- 新規作成者 --}}
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                @if($news->id != null)
                    <input type="hidden" name="id" value="{{ $news->id }}">
                @endif
                <div class="form-group">
                    <label for="exampleInputKana"><span class="Form-Item-Label-Required">必須</span>タイトル
                        <small>
                            @if( $errors->has('title') )
                                <li>{{ $errors->first('title') }}</li>
                            @endif
                        </small>
                    </label>
                    <textarea name="title"  class="form-control" id="exampleFormControlTextarea1" rows="4">{{ old('title',$news->title) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail"><span class="Form-Item-Label-Required">必須</span>画像
                        <small>
                            @if( $errors->has('file_image') )
                                <li>{{ $errors->first('file_image') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="file" name="file_image"  value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"><span class="Form-Item-Label-Required">必須 </span>本文
                        <small>
                            @if( $errors->has('content') )
                                <li>{{ $errors->first('content') }}</li>
                            @endif 
                        </small>
                    </label>
                    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ old('content',$news->content) }}</textarea>
                </div>

                <div class="input-group pb-3">
                    <div class="input-group-prepend">
                        <label class="input-group" for="inputGroupSelect01"><span class="Form-Item-Label-Required">必須</span>公開開始
                            <small>
                                    @if( $errors->has('start_show') )
                                        <li>{{ $errors->first('start_show') }}</li>
                                    @endif 
                            </small>
                        </label>
                    </div>
                    {{-- // datetimepickerを利用してください --}}
                    <input type="date" id="start_show" name="start_show" value="{{ old('start_show',$news->start_show) }}" class="form-control">
                </div>
                <div class="input-group pb-3">
                    <div class="input-group-prepend">
                        {{-- // datetimepickerを利用してください --}}
                        <label class="input-group" for="inputGroupSelect01">公開終了</label>
                    </div>
                    <input type="text" id="end_show" name="end_show" value="{{ old('end_show',$news->end_show) }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- jQuery-datetimepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" />
<script>
    $(function() {
        $('#start_show').datetimepicker({
        });
        $('#end_show').datetimepicker({
        });
    });
</script>
@endsection
