<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//お問い合わせ側

//入力フォーム
Route::get('/contact', [ContactsController::class,'index'])->name('contact_index');
// 確認フォーム
Route::post('/contact/confirm', [ContactsController::class,'confirm'])->name('contact_confirm');
//送信フォーム
Route::post('/contact/send', [ContactsController::class,'send'])->name('contact_send');



Route::get('/notice', function () {
    return view('news.index');
})->name('news');

Route::get('/notice/detail', function () {
    return view('news.detail');
})->name('news_detail');

//ログインページ
Route::get('/login', [LoginController::class,'show'])->name('login');
//処理
Route::post('login', [LoginController::class,'login']);
//ログアウト
Route::post('logout', [LoginController::class,'logout'])->name('logout');



// 管理画面TOP
Route::get('/home', function () {
    return view('admin.home.index');
})->name('home');


//会員一覧
Route::get('/users', [UserController::class,'show'])->name('user');
//ユーザー新規作成、編集画面
Route::get('/users/edit', [UserController::class,'create'])->name('user_edit');
//ユーザー新規作成、編集画面処理
Route::post('/users/edit/store/{user?}', [UserController::class,'store'])->name('admin_store');
//論理削除
Route::post('/delete/{user}', [UserController::class,'delete'])->name('delete');
Route::get('/received', [ContactController::class,'show'])->name('admin_contact');
Route::get('/received/edit/', [ContactController::class,'edit'])->name('admin_contact_edit');
Route::get('/news', [NewsController::class,'index'])->name('admin_news');
Route::get('/news/edit/', [NewsController::class,'edit'])->name('admin_news_edit');