<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 既存のコード: ユーザー情報取得の例
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 新しく追加したコード: PostControllerのindexメソッドを呼び出すルート
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index']);
