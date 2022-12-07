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
            <form action="{{ route('search_contact') }}" method="GET">
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
                            <option value="{{ $user->name }}" @if(isset($keyword_authority)){{ $user == $keyword_authority ? 'selected':'' }}@endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-cont">
                    <label class="label-ttl">会社名</label>
                    <input type="text" class="form-input" name="company" value=" @if(isset($keyword_company)){{ $keyword_company }}@endif" >
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
                            <p>対応者</p>
                        </th>
                        <th style="width: 80px">
                            <p>会社名</p>
                        </th>
                        <th style="width: 50px">
                            <p>氏名</p>
                        </th>
                        <th style="width: 70px">
                            <p>電話番号</p>
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
@endsection

@section('pageJs')
@endsection
