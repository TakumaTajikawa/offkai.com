<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

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

#ユーザー新規登録、ログイン、ログアウト
Auth::routes();

#プラン一覧
Route::get('/', [PlanController::class, 'index'])->name('plans.index');

#プラン投稿・編集・削除
Route::resource('/plans', PlanController::class)->except(['index', 'show'])->middleware('auth'); 

#プラン詳細
Route::resource('/plans', PlanController::class)->only(['show']);

#興味あり！機能
Route::prefix('plans')->name('plans.')->group(function () {
  Route::put('/{plan}/interest', [PlanController::class, 'interest'])->name('interest')->middleware('auth');
  Route::delete('/{plan}/interest', [PlanController::class, 'uninterest'])->name('uninterest')->middleware('auth');
});

#タグ別プラン詳細
Route::get('/tags/{name}', [TagController::class, 'show'])->name('tags.show');

#ユーザー詳細（投稿したプラン一覧・興味あり！を押したプラン一覧）
Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', [UserController::class, 'show'])->name('show');
  #フォロー機能
  Route::middleware('auth')->group(function () {
    Route::put('/{name}/follow', [UserController::class, 'follow'])->name('follow');
    Route::delete('/{name}/follow', [UserController::class, 'unfollow'])->name('unfollow');
  });
  Route::get('/{name}/interests', [UserController::class, 'interests'])->name('interests');
  Route::get('/{name}/edit', [UserController::class, 'edit'])->name('edit')->middleware('auth');
  Route::patch('/{name}', [UserController::class, 'update'])->name('update')->middleware('auth'); 
});

#ゲストログイン
Route::get('guest', [LoginController::class, 'guestLogin'])->name('login.guest');

#コメント
Route::resource('/comments', CommentController::class)->only(['store', 'destroy']);

#ホーム
Route::get('/home', [HomeController::class, 'index'])->name('home');

#参加
Route::get('/plan/participation/{id}', [PlanController::class, 'participation'])->name('plan.participation');
Route::get('/plan/unparticipation/{id}', [PlanController::class, 'unparticipation'])->name('plan.unparticipation');