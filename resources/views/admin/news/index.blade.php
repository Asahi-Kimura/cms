@extends('admin.layouts.base')

@section('title', '新着情報一覧')
@section('web-active' , 'active')

@include('admin.layouts.sub')
@include('admin.layouts.header')
@section('content')

<div class="main-contet-inner">
    <div class="page-ttl_ar">
        <h1 class="page-ttl">新着情報一覧</h1>
        <p><a class="new-btn" href=""><i class="fas fa-plus-circle mg-r_5"></i>新規作成</a></p>
    </div>
    <div class="list-contents">
        <div class="search_ar submit-area">
            <form>
                <div class="search-cont">
                    <label class="label-ttl">ステータス</label>
                    <select class="form-input">
                        <option>選択してください</option>
                        <option>未対応</option>
                        <option>対応中</option>
                        <option>対応済</option>
                    </select>
                </div>
                <div class="search-cont">
                    <label class="label-ttl">タイトル</label>
                    <input class="form-input">
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
                    <tr>
                        <td class="edit-icon">
                            <p><a class="tooltip" title="編集する" href="" ><i class="fas fa-edit"></i></a></p>
                        </td>
                        <td class ="edit-icon">
                            {{-- 管理者ユーザー以外削除可能 --}}
                            <p class="delete-btn tooltip" title="削除する" data-id=""><i class="fas fa-trash"></i></p>
                        </td>
                        <td>
                            <p>公開中</p>
                        </td>
                        <td>
                            <p>タイトル</p>
                        </td>
                        <td>
                            <p>2022/10/01 00:00</p>
                        </td>
                        <td>
                            <p>2022/10/01 00:00</p>
                        </td>
                    </tr>
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
