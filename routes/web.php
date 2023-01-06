<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\NewsGuestController;

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

    //お知らせ一覧
    Route::get('/notice/{news?}', [NewsGuestController::class,'news_index'])->name('news_index');

    // 詳細情報
    Route::get('/notice/detail/{news?}', [NewsGuestController::class,'news_detail'])->name('news_detail'); 
    
    //ログインページ
    Route::get('/', [LoginController::class,'show'])->name('login');
    //処理
    Route::post('login', [LoginController::class,'storeLogin'])->name('storeLogin');
});

Route::group(['middleware' => 'auth'], function () {

    // 管理画面TOP
    Route::get('/home', function () {
        return view('admin.home.index');
    })->name('home');
    //ログアウト
    Route::post('logout', [LoginController::class,'logout'])->name('logout');
    //会員一覧
    Route::get('/users/{user?}/', [UserController::class,'show'])->name('user');
    //ユーザー編集画面
    Route::get('/users/edit/{user?}', [UserController::class,'create'])->name('user_edit');
    //ユーザー新規作成、編集画面
    Route::get('/new', [UserController::class,'create'])->name('new');
    //ユーザー新規作成、編集画面処理
    Route::post('/users/edit/store/{user?}', [UserController::class,'store'])->name('admin_store');
    //会員検索機能、並び替え機能
    Route::get('/search', [UserController::class,'search'])->name('search_user');
    //お問い合わせ.検索機能
    Route::get('/contacts/search', [ContactController::class,'search'])->name('search_contact');
    //論理削除（ユーザー）
    Route::get('/du/{user}', [UserController::class,'delete'])->name('delete_user');
    //論理削除（お問い合わせ）
    Route::get('/dc/{contact}', [ContactController::class,'delete'])->name('delete_contact');
    //お問い合わせ一覧
    Route::get('/received', [ContactController::class,'show'])->name('admin_contact');
    //お問い合わせ編集
    Route::get('/received/edit/{contact?}', [ContactController::class,'edit'])->name('admin_contact_edit');
    //お問い合わせ処理
    Route::post('store/{contact}', [ContactController::class,'store'])->name('admin_contact_store');

    //新着情報画面
    Route::get('/news', [NewsController::class,'index'])->name('admin_news');
    //新着情報新規作成、編集
    Route::get('/news/edit/{news?}', [NewsController::class,'edit'])->name('admin_news_edit');
    //編集処理
    Route::post('admin/store/{news?}', [NewsController::class,'store'])->name('admin_news_store');
    //新着検索機能
    Route::get('/news/search', [NewsController::class,'search'])->name('search_news');
    //論理削除（お問い合わせ
    Route::get('/dn/{news}', [NewsController::class,'delete'])->name('delete_news');

});



