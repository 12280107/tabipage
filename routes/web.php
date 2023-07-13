<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

//一覧表示から詳細ページへ遷移
Route::get('/posts/{id}', 'PostController@show')->name('posts.show');
//更新ページ
Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit');
Route::put('/posts/{id}', 'PostController@update')->name('posts.update');
//削除機能
Route::delete('/posts/{id}', 'PostController@destroy')->name('posts.destroy');
//違反報告機能
Route::get('/posts/{id}/violation','PostController@violation_create')->name('posts.violation');
Route::post('/posts/{id}/violationstore', 'PostController@violation_store')->name('posts.violation_store');
//予約機能
Route::get('/posts/{id}/reserve','PostController@reserve_create')->name('posts.reserve');
Route::post('/posts/{id}/reservestore', 'PostController@reserve_store')->name('posts.reserve_store');
//ユーザー
Route::resource('users', 'UserController')->only(['index', 'store', 'update', 'destroy', 'edit', 'show',]);
