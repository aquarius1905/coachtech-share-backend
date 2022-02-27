<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// store: ユーザー新規登録 OK
Route::apiResource('/register', UserController::class)->only([
  'store'
]);

// index：投稿一覧の表示　OK
// store: 投稿の追加　OK
// show: 特定のユーザーの投稿を表示 OK
// destroy: 投稿の削除 OK
Route::apiResource('/posts', PostController::class)->only([
  'index', 'store', 'show', 'destroy'
]);

// show: 特定の投稿に対するコメントの表示 OK
// store: コメントの追加 OK
Route::apiResource('/posts/comments', CommentController::class)->only([
  'show', 'store'
]);

// store: 良いね追加 OK
// destroy: 良いね削除
Route::apiResource('/posts/likes', LikeController::class)->only([
  'store', 'destroy'
]);