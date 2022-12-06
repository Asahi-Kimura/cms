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
                                <p>{{ $news->start_show }}</p>
                            </td>
                            <td>
                                <p>{{ $news->end_show }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pager-wrapper bottom">
        <div class="pager_ar">
            <p class="search-result"></p>
        </div>
    </div>
</div>
@endsection

@section('pageJs')
@endsection
