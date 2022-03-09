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

// ユーザー新規登録
Route::apiResource('/register', UserController::class)->only([
  'store'
]);

//ユーザー名又はメールアドレスからユーザー情報を取得
Route::get('/user', [UserController::class, 'show']);

// index：投稿一覧の表示
// store: 投稿の追加
// show: 特定の投稿を表示
// destroy: 投稿の削除
Route::apiResource('/posts', PostController::class)->only([
  'index', 'store', 'show', 'destroy'
]);

// show: 特定の投稿に対するコメントの表示
// store: コメントの追加
// destroy: 投稿が削除された場合はコメントも削除
Route::apiResource('/comments/posts', CommentController::class)->only([
  'show', 'store', 'destroy'
]);

// 特定の投稿の良いね数取得
Route::apiResource('/likes/posts', LikeController::class)->only([
  'show'
]);

// 良いね追加
Route::apiResource('/posts/likes', LikeController::class)->only([
  'store'
]);

// 良いね削除
Route::apiResource('/likes/users/{user}/posts', LikeController::class)->only([
  'destroy'
]);

//特定の人から特定の投稿に対する「良いね」が存在するかどうか取得
Route::get('/likes', [LikeController::class, 'exists']);
