@extends('admin.layouts.base')

@section('title', 'お問い合わせ一覧')
@section('web-active' , 'active')

@include('admin.layouts.sub')
@include('admin.layouts.header')
@section('content')
<div class="main-contet-inner">
    <div class="page-ttl_ar">
        <h1 class="page-ttl">お問い合わせ一覧</h1>
    </div>
    <div class="list-contents">
        <div class="search_ar submit-area">
            <form action="{{ route('search_contact') }}" method="GET" name="contact_form">
                <div class="search-cont">
                    <label class="label-ttl">ステータス</label>
                    <select class="form-input" name="status">
                        <option value="">選択してください</option>
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}" @if(isset($keyword_status)){{ $key == $keyword_status ? 'selected':'' }}@endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-cont">
                    <label class="label-ttl">対応者</label>
                    <select class="form-input" name="authority">
                        <option value="">選択してください</option>
                        @foreach($user as $user)
                            <option value="{{ $user->name }}" @if(isset($keyword_authority)){{ $user->name == $keyword_authority ? 'selected':'' }}@endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-cont">
                    <label class="label-ttl">会社名</label>
                    <input type="text" class="form-input" name="company" value=" @if(isset($keyword_company)){{ $keyword_company }}@endif" >
                </div>
                <div class="sort_event"></div>
                <div class="search-cont search-btn">
                    <button id="submit" class="form-input" type="submit">検索</button>
                </div>
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
                            ステータス
                            <button class="on_asc_status">⇧</button>
                            <button class="on_desc_status">⇩</button>
                        </th>
                        <th style="width: 80px">
                            対応者
                            <button class="on_asc_authority">⇧</button>
                            <button class="on_desc_authority">⇩</button>
                        </th>
                        <th style="width: 80px">
                            会社名
                            <button class="on_asc_company">⇧</button>
                            <button class="on_desc_company">⇩</button>
                        </th>
                        <th style="width: 50px">
                            氏名
                            <button class="on_asc_name">⇧</button>
                            <button class="on_desc_name">⇩</button>
                        </th>
                        <th style="width: 70px">
                            電話番号
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($contact))
                        @foreach($contact as $contact )
                            <tr>
                                <td class="edit-icon">
                                    <p><a class="tooltip" title="編集する" href="{{ route('admin_contact_edit',$contact) }}" ><i class="fas fa-edit"></i></a></p>
                                </td>
                                <td class ="edit-icon">
                                    {{-- 管理者ユーザー以外削除可能 --}}
                                    @if($contact->user != null)
                                        @if($contact->user->authority == 'guest')
                                            <a href="{{ route('delete_contact',$contact) }}"><p class="delete-btn tooltip" title="削除する" data-id=""><i class="fas fa-trash"></i></p><a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <p>{{ $status[$contact->status] }}</p>
                                </td>
                                <td>
                                    @if($contact->user != null)
                                        <p>{{ $contact->user->name }}</p>
                                    @endif
                                </td>
                                <td>
                                    <p>{{ $contact->company_name }}</p>
                                </td>
                                <td>
                                    <p>{{ $contact->user_name }}</p>
                                </td>
                                <td>
                                    <p>{{ $contact->tele_num }}</p>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
    $(function()
    {
        //ステータス
        $('.on_asc_status').click(function() {
            $('.sort_event').append('<input type="hidden" name="sort" value=" asc">');
            $('.sort_event').append('<input type="hidden" name="sort_name" value="sort_status">');
            $('#submit').trigger('click');
        });
        $('.on_desc_status').click(function() {
            $('.sort_event').append('<input type="hidden" name="sort" value=" desc">');
            $('.sort_event').append('<input type="hidden" name="sort_name" value="sort_status">');
            $('#submit').trigger('click');
        });

        //対応者
        $('.on_asc_authority').click(function() {
            $('.sort_event').append('<input type="hidden" name="sort" value=" asc">');
            $('.sort_event').append('<input type="hidden" name="sort_name" value="sort_authority">');
            $('#submit').trigger('click');
        });
        $('.on_desc_authority').click(function() {
            $('.sort_event').append('<input type="hidden" name="sort" value=" desc">');
            $('.sort_event').append('<input type="hidden" name="sort_name" value="sort_authority">');
            $('#submit').trigger('click');
        });   

        //会社名
        $('.on_asc_company').click(function() {
            $('.sort_event').append('<input type="hidden" name="sort" value=" asc">');
            $('.sort_event').append('<input type="hidden" name="sort_name" value="sort_company">');
            $('#submit').trigger('click');
        });
        $('.on_desc_company').click(function() {
            $('.sort_event').append('<input type="hidden" name="sort" value=" desc">');
            $('.sort_event').append('<input type="hidden" name="sort_name" value="sort_company">');
            $('#submit').trigger('click');
        }); 

        //氏名
        $('.on_asc_name').click(function() {
            $('.sort_event').append('<input type="hidden" name="sort" value=" asc">');
            $('.sort_event').append('<input type="hidden" name="sort_name" value="sort_name">');
            $('#submit').trigger('click');
        });
        $('.on_desc_name').click(function() {
            $('.sort_event').append('<input type="hidden" name="sort" value=" desc">');
            $('.sort_event').append('<input type="hidden" name="sort_name" value="sort_name">');
            $('#submit').trigger('click');
        }); 
    });
</script>
@endsection

@section('pageJs')
@endsection
