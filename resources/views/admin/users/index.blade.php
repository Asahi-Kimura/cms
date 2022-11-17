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
            <form>
                <div class="search-cont">
                    <label class="label-ttl">名前</label>
                    <input class="form-input">
                </div>
                <div class="search-cont">
                    <label class="label-ttl">電話番号</label>
                    <input class="form-input">
                </div>
                <div class="search-cont">
                    <label class="label-ttl">都道府県</label>
                    <select class="form-input">
                        <option>選択してください</option>
                        <option>都道府県一覧を表示してください</option>
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
                            <p>編集</p>
                        </th>
                        <th style="width: 20px">
                            <p>削除</p>
                        </th>
                        <th style="width: 30px">
                            <p>権限</p>
                        </th>
                        <th style="width: 50px">
                            <p>名前</p>
                        </th>
                        <th style="width: 70px">
                            <p>メールアドレス</p>
                        </th>
                        <th style="width: 70px">
                            <p>電話番号</p>
                        </th>
                        {{-- <th style="width: 30px">
                            <p>都道府県</p>
                        </th> --}}
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
                            <a href="{{ route('delete',$user) }}"><p class="delete-btn tooltip"  title="削除する" data-id=""><i class="fas fa-trash"></i></p></a>
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
                        {{-- <td>
                            <p>{{$user->prefecture}}</p>
                        </td> --}}
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
@endsection

@section('pageJs')
<script src="{{ asset('js/admin/modal.js') }}"></script>
<script>
</script>
@endsection
