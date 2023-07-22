<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\StopUserMiddleware;
use App\Post;
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
Auth::routes();

Route::redirect('/','/posts');
    
Route::get('posts', 'PostController@index')->name('posts.index');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset/{token}', 'Auth\ResetPasswordController@reset');
Route::post('/posts/more', 'PostController@more')->name('posts.more');


Route::group(['middleware' =>['auth',StopUserMiddleware::class]], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController',['except' => ['index']]);
    Route::get('/posts/{id}', 'PostController@show')->name('posts.show');
    
    Route::get('/reservations', 'UserController@reservations')->name('reservations.index');
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

    //在庫一覧
    
    Route::resource('users', 'UserController')->only(['index','update', 'destroy', 'edit', 'show','create','reservations','stock']);
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::get('/stock', 'UserController@stock')->name('users.stock');

    Route::get('posts/pdelete/{id}','PostController@pdelete')->name('posts.pdelete');
    // 管理者向けルート
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // 管理者用のユーザー一覧のルート
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users.index');
    // 管理者用の投稿一覧のルート
    Route::get('/admin/posts', [AdminController::class, 'showPosts'])->name('admin.posts.index');

    Route::post('stop_user_function', 'AdminController@stopUserFunction')->name('stop_user_function');
});
