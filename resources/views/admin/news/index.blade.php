@extends('admin.layouts.base')

@section('title', '新着情報一覧')
@section('web-active' , 'active')

@include('admin.layouts.sub')
@include('admin.layouts.header')
@section('content')

<div class="main-contet-inner">
    <div class="page-ttl_ar">
        <h1 class="page-ttl">新着情報一覧</h1>
        <p><a class="new-btn" href="{{ route('admin_news_edit') }}"><i class="fas fa-plus-circle mg-r_5"></i>新規作成</a></p>
    </div>
    <div class="list-contents">
        <div class="search_ar submit-area">
            <form action="{{ route('search_news') }}" method="GET">
                <div class="search-cont">
                    <label class="label-ttl">ステータス</label>
                    <select name="status" class="form-input">
                        <option value=''>選択してください</option>
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}" @if(isset($keyword_status)){{ $key == $keyword_status ? 'selected':'' }}@endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-cont">
                    <label class="label-ttl">タイトル</label>
                    <input class="form-input" name="title" value="@if(isset($keyword_title)){{ $keyword_title }}@endif">
                </div>

                <div class="search-cont search-btn">
                    <button class="form-input" type="submit">検索</button>
                </div>
                <div class="search-cont search-btn" id="search_delete">
                    <button class="form-input submit_switch">検索削除</button>
                </div>
            </form>
        </div>
        <div class="table_ar">
            <table class="list-table">
                <thead>
                    <tr>
                        <th style="width: 20px">
                            <p>編集</p>
                        </th>
                        <th style="width: 20px">
                            <p>削除</p>
                        </th>
                        <th style="width: 50px">
                            <p>ステータス</p>
                        </th>
                        <th style="width: 80px">
                            <p>タイトル</p>
                        </th>
                        <th style="width: 50px">
                            <p>公開開始</p>
                        </th>
                        <th style="width: 70px">
                            <p>公開終了</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $news)
                        <tr>
                            <td class="edit-icon">
                                @if($news->id != null)
                                    <p><a class="tooltip" title="編集する" href="{{ route('admin_news_edit',$news) }}" ><i class="fas fa-edit"></i></a></p>
                                @endif
                            </td>
                            <td class ="edit-icon">
                                {{-- 管理者ユーザー以外削除可能 --}}
                                @if($news->user != null)
                                    @if($news->user->authority != 'guest')
                                        <p class="delete-btn tooltip" title="削除する" data-id=""><a href="{{ route('delete_news',$news) }}"><i class="fas fa-trash"></i></a></p>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @php
                                    $start_show = new DateTime($news->start_show);
                                    $now_time = new DateTime();
                                    $now_time->format('Y-m-d H:i');
                                    $end_show = new DateTime($news->end_show);
                                @endphp
                                @if($end_show != null)
                                    @if($now_time < $start_show)
                                        <p>公開開始前</p>
                                    @elseif($start_show < $now_time && $now_time < $end_show)
                                        <p>公開中</p>
                                    @elseif( $end_show < $now_time )
                                        <p>公開終了</p>
                                    @else
                                        <p>エラー</p>
                                    @endif
                                @elseif($end_show == null)
                                    @if($now_time < $start_show)
                                        <p>公開開始前</p>
                                    @elseif($start_show < $now_time)  
                                        <p>公開中</p>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <p>{{ $news->title }}</p>
                            </td>
                            <td>
                                @if($news->id != null)
                                    <p>{{ $news->start_show = substr($news->start_show,0,-3) }}</p>
                                @endif
                            </td>
                            <td>
                                @if($news->id != null)
                                    <p>{{ $news->end_show = substr($news->end_show,0,-3) }}</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- modal-window --}}
<div class="modal-content delete">
    <div class="modal-ttl">
    <h4>削除</h4>
        <p class="modal-close"></p>
    </div>

    <div class="modal-inner">
    <p>検索削除しますか？</p>
        <div class="modal-btn_ar">
        <button type="button" class="no">いいえ</button>
            <form class="form_search_delete" method="GET" action="{{ route('search_news_delete') }}">
                <input type="hidden" value="" name="id" id="deleteInput">
                <button type="submit" class="yes">はい</button>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- modal-window --}}
<script>
    $('#search_delete').click(function (e) { 
        e.preventDefault();
        $('.modal-content').fadeIn();
    });
    $('.no').click(function (e) { 
        e.preventDefault();
        $('.modal-content').fadeOut();
    });
    $('.yes').click(function () { 
        $('.form_search_delete').submit();
    });
</script>

    <div class="pager-wrapper bottom">
        <div class="pager_ar">
            <p class="search-result"></p>
        </div>
    </div>
</div>
@endsection

@section('pageJs')
@endsection
