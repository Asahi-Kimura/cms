@extends('admin.layouts.base')

@section('title', 'ユーザー作成')
@section('web-active' , 'active')

@include('admin.layouts.sub')
@include('admin.layouts.header')
@section('content')

<div class="main-contet-inner">
	<div class="page-ttl_ar">
		<h1 class="page-ttl">新着情報</h1>
	</div>
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('admin_news_store',$news) }}" enctype="multipart/form-data">
                @csrf
                {{-- 新規作成者 --}}
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                @if($news->id != null)
                    <input type="hidden" name="id" value="{{ $news->id }}">
                @else
                    <input type="hidden" name="id" value="">
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
                    @php
                        $image_array = explode('/',$news->file_image);
                        $image = str_replace('public','',$news->file_image);
                    @endphp
                    
                    <label for="exampleInputEmail"><span class="Form-Item-Label-Required">必須</span>画像
                        @if($user->id != null)
                            <a href="{{ asset('storage'.$image)}}">{{ end($image_array) }}</a>
                        @endif 
                        <small>
                            @if( $errors->has('file_image') )
                                <li>{{ $errors->first('file_image') }}</li>
                            @endif
                        </small>
                    </label>
                    <input type="file" name="file_image" value="" id="file_image" class="form-control" accept="image/*">
                {{-- js練習中 --}}
                    <img id="preview">
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
                    <input type="text" id="start_show" name="start_show" value="{{ old('start_show',$news->start_show) }}" class="form-control">
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
        $.datetimepicker.setLocale('ja');
        $('#start_show').datetimepicker({
            });
        $('#end_show').datetimepicker({
        });
    });
</script>

<script>
    $('#file_image').on('change', function (e) {
        // js練習中
        const reader = new FileReader();
        const fileName = e.target.files[0].name;
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result).css('width', '150px').css('height', '150px');
        }
        reader.readAsDataURL(this.files[0]);
    })
</script>
@php
    $image_array = explode('/',$news->file_image);
    $image = str_replace('public','',$news->file_image);
@endphp

{{-- 高さ幅調整が効かない　cssファイルが原因か？ --}}
表示画像名：{{ end($image_array) }}
<img src="{{ asset('storage'.$image)}}" alt="ニュース画像" >
@endsection