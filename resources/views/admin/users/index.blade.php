@extends('admin.layouts.base')

@section('title', '会員一覧')
@section('web-active' , 'active')

@include('admin.layouts.sub')
@include('admin.layouts.header')
@section('content')
<div class="main-contet-inner">
    <div class="page-ttl_ar">
        <h1 class="page-ttl">会員一覧</h1>
        <p><a class="new-btn" href="{{ route('new') }}"><i class="fas fa-plus-circle mg-r_5"></i>新規作成</a></p>
    </div>
    <div class="list-contents">
        <div class="search_ar submit-area">
            <form method="GET" action="{{ route('search_user') }}">
                <div class="search-cont">
                    <label class="label-ttl">名前</label>
                    <input type="text" class="form-input" name="name" value="@if(isset($keyword_name)){{ $keyword_name }}@endif">
                </div>
                <div class="search-cont">
                    <label class="label-ttl" >電話番号</label>
                    <input type="text" class="form-input" name="phone_number" value="@if(isset($keyword_phone_number)){{ $keyword_phone_number }}@endif">
                </div>
                <div class="search-cont">
                    <label class="label-ttl">都道府県</label>
                    <select class="form-input" name="prefecture_id">
                        <option value="">選択してください</option>
                        @foreach ($pref as $key => $value)
                            <option value="{{ $key }}" @if(isset($keyword_prefecture_id)){{ $key == $keyword_prefecture_id ? 'selected':'' }}@endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-cont">
                    <label class="label-ttl">並び替え</label>
                    <select class="form-input sort_click" name="sort_name">
                        <option value=""></option>
                            @foreach ($sort_name as $key => $value)
                                <option value="{{ $key }}"@if(isset($keyword_sort_name)){{ $key == $keyword_sort_name ? 'selected':'' }}@endif>{{ $value }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="search-cont" @if(!isset($keyword_sort)) @endif id="display">
                    <label class="label-ttl">並び順</label>
                    <select class="form-input" name="sort">
                        @foreach ($sort as $key => $value)
                            <option value="{{ $key }}"@if(isset($keyword_sort)){{ $key == $keyword_sort ? 'selected':'' }}@endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-cont search-btn">
                    <button class="form-input" type="submit">検索</button>
                </div>
            </form>
        </div>
        <div class="alert-danger"></div>
        <div class="table_ar">
            <table class="list-table">
                <thead>
                    <tr>
                        <th style="width: 50px">
                            編集
                        </th>
                        <th style="width: 20px">
                            <p>削除</p>
                        </th>
                        <th style="width: 30px">
                            <p>権限</p>
                        </th>
                        <th style="width: 50px" class="arrow-top">
                            <p>名前</p>
                        </th>
                        <th style="width: 70px" class="arrow-bottom">
                            <p>メールアドレス</p>
                        </th>
                        <th style="width: 70px">
                            <p>電話番号</p>
                        </th>
                        <th style="width: 30px">
                            <p>都道府県</p>
                        </th>
                        <th style="width: 70px">
                            <p>市町村</p>
                        </th>
                        <th style="width: 70px">
                            <p>番地・アパート名</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $user )
                    <tr>
                        <td class="edit-icon">
                            <p><a class="tooltip" title="編集する" href="{{ route('user_edit',$user) }}" ><i class="fas fa-edit"></i></a></p>
                        </td>
                        <td class ="edit-icon">
                            {{-- 管理者ユーザー以外削除可能 --}}
                            @if($user->authority == 'guest')
                                <a href="{{ route('delete_user',$user) }}"><p class="delete-btn tooltip"  title="削除する" data-id=""><i class="fas fa-trash"></i></p></a>
                            @endif
                        </td>
                        <td>
                            <p>{{$user->authority}}</p>
                        </td>
                        <td>
                            <p>{{$user->name}}</p>
                        </td>
                        <td>
                            <p>{{$user->email}}</p>
                        </td>
                        <td>
                            <p>{{$user->phone_number}}</p>
                        </td>
                        <td> 
                            <p>{{ $user->prefecture->prefecture_chinese_name }}</p>
                        </td>
                        <td>
                            <p>{{$user->city}}</p>
                        </td>
                        <td>
                            <p>{{$user->address}}</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pager-wrapper bottom">
            <div class="pager_ar">
                <p class="search-result"></p>
            </div>
        </div>
    </div>
</div>
<div class="modal-content delete">
    <div class="modal-ttl">
    <h4>削除</h4>
        <p class="modal-close"></p>
    </div>

    <div class="modal-inner">
    <p>削除しますか？</p>
        <div class="modal-btn_ar">
        <button type="button" class="no">いいえ</button>
            <form method="POST" action="" id="delete">
                <input type="hidden" value="" name="id" id="deleteInput">
                <button type="submit" class="yes">はい</button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection

@section('pageJs')
<script src="{{ asset('js/admin/modal.js') }}"></script>
<script>
</script>
@endsection
