<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Auth;

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
Route::group(['middleware' => 'guest'], function () {
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
    Route::get('/', [LoginController::class,'show'])->name('login');
    //処理
    Route::post('login', [LoginController::class,'storeLogin'])->name('storeLogin');
});

Route::group(['middleware' => 'auth'], function () {

    // 管理画面TOP
    Route::get('/home', function () {
        // dd(Auth::user());
        return view('admin.home.index');
    })->name('home');
    //ログアウト
    Route::post('logout', [LoginController::class,'logout'])->name('logout');
    //会員一覧
    Route::get('/users/{user?}', [UserController::class,'show'])->name('user');
    //ユーザー編集画面
    Route::get('/users/edit/{user?}', [UserController::class,'create'])->name('user_edit');
    //ユーザー新規作成、編集画面
    Route::get('/new', [UserController::class,'create'])->name('new');
    //ユーザー新規作成、編集画面処理
    Route::post('/users/edit/store/{user?}', [UserController::class,'store'])->name('admin_store');
    //検索機能
    Route::get('/search', [UserController::class,'search'])->name('search');
    //論理削除
    Route::get('/delete/{user}', [UserController::class,'delete'])->name('delete');
    //論理削除
    Route::get('/delete/{contact}', [ContactController::class,'delete'])->name('delete');
    //お問い合わせ一覧
    Route::get('/received', [ContactController::class,'show'])->name('admin_contact');
    //お問い合わせ編集
    Route::get('/received/edit/', [ContactController::class,'edit'])->name('admin_contact_edit');
    //お問い合わせ処理
    Route::get('/received/edit/{contact?}', [ContactController::class,'edit'])->name('admin_contact_store');
    Route::get('/news', [NewsController::class,'index'])->name('admin_news');
    Route::get('/news/edit/', [NewsController::class,'edit'])->name('admin_news_edit');
});




