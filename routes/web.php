<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('posts', 'PostController');

// 一覧表示から詳細ページへ遷移
Route::get('/posts/{id}', 'PostController@show')->name('posts.show');
// 更新ページ
Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit');
Route::put('/posts/{id}', 'PostController@update')->name('posts.update');
// 削除機能
Route::delete('/posts/{id}', 'PostController@destroy')->name('posts.destroy');
// 違反報告機能
Route::get('/posts/{id}/violation', 'PostController@violation_create')->name('posts.violation');
Route::post('/posts/{id}/violationstore', 'PostController@violation_store')->name('posts.violation_store');
// 予約機能
Route::get('/posts/{id}/reserve', 'PostController@reserve_create')->name('posts.reserve');
Route::post('/posts/{id}/reservestore', 'PostController@reserve_store')->name('posts.reserve_store');

// ユーザー
Route::resource('users', 'UserController')->only(['index', 'store', 'update', 'destroy', 'edit', 'show']);

Route::resource('admin.users', 'AdminController')->names([
    'index' => 'admin.users.index',
    'create' => 'admin.users.create',
    'store' => 'admin.users.store',
    'show' => 'admin.users.show',
    'edit' => 'admin.users.edit',
    'update' => 'admin.users.update',
    'destroy' => 'admin.users.destroy',
])->parameters([
    'users' => 'admin_user', // パラメータ名を 'admin_user' に更新
]);

Route::get('/admin/users', 'AdminController@showUsers')->name('admin.users.index');

Route::resource('admin.posts', 'AdminController')->names([
    'index' => 'admin.posts.index',
    'create' => 'admin.posts.create',
    'store' => 'admin.posts.store',
    'show' => 'admin.posts.show',
    'edit' => 'admin.posts.edit',
    'update' => 'admin.posts.update',
    'destroy' => 'admin.posts.destroy',
])->parameters([
    'posts' => 'admin_post', // パラメータ名を 'admin_post' に変更
]);

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // 管理者向けルート
    Route::get('/', 'AdminController@index')->name('index');
    // 管理者用のユーザー一覧のルート
    Route::get('/users', 'AdminController@showUsers')->name('users.index');
    // 管理者用の投稿一覧のルート
    Route::get('/posts', 'AdminController@showPosts')->name('posts.index');
});
