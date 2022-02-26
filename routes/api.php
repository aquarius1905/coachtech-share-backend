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

// store: ユーザー新規登録
Route::apiResource('/register', UserController::class)->only([
  'store'
]);

// index：投稿一覧の表示
// store: 投稿の追加
// show: 特定のユーザーの投稿を表示
// destroy: 投稿の削除
Route::apiResource('/posts', PostController::class)->only([
  'index', 'store', 'show', 'destroy'
]);

// index: 特定の投稿に対するコメントの表示
// store: コメントの追加
Route::apiResource('/posts/{id}/comments', CommentController::class)->only([
  'index', 'store'
]);

// store: 良いね追加
// destroy: 良いね削除
Route::apiResource('/posts/{id}/likes', LikeController::class)->only([
  'store', 'destroy'
]);