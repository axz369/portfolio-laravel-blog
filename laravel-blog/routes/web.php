<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\OtherPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function(){
    // 新規投稿画面表示
    Route::get('post/create',[PostController::class,'create'])->name('post.create');
    // 新規投稿処理
    Route::post('post',[PostController::class,'store'])->name('post.store');
    // 自分の投稿一覧画面表示
    Route::get('post',[PostController::class,'index'])->name('post.index');
    // 自分の投稿を個別に表示する
    Route::get('post/show/{post}',[PostController::class,'show'])->name('post.show');
    // 編集画面の表示
    Route::get('post/{post}/edit',[PostController::class,'edit'])->name('post.edit');
    // 編集処理
    Route::patch('post/{post}',[PostController::class,'update'])->name('post.update');
    // 削除
    Route::delete('post/{post}',[PostController::class,'destroy'])->name('post.destroy');

    // 他ユーザについて
    // ほかユーザの投稿一覧
    Route::get('otherPost',[OtherPostController::class,'index'])->name('otherPost.index');
    // 個別表示
    Route::get('otherPost/show/{post}', [OtherPostController::class, 'show'])->name('otherPost.show');

    // 記事へのコメント投稿画面
    Route::get('comments/create/{post}', [CommentController::class, 'create'])->name('comments.create');
    // コメント投稿処理
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');

    // コメント一覧表示
    Route::get('/post/{post}/comments', [CommentController::class, 'index'])->name('comments.index');
    //コメント編集画面
    Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    //コメント編集機能
    Route::patch('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    //コメント削除
    Route::delete('comments/{comment}',[CommentController::class,'destroy'])->name('comments.destroy');
});
