<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Auth::routes();
Route::get('/', [PlanController::class, 'index'])->name('plans.index');
Route::resource('/plans', PlanController::class)->except(['index', 'show'])->middleware('auth'); 
Route::resource('/plans', PlanController::class)->only(['show']);
Route::prefix('plans')->name('plans.')->group(function () {
  Route::put('/{plan}/interest', [PlanController::class, 'interest'])->name('interest')->middleware('auth');
  Route::delete('/{plan}/interest', [PlanController::class, 'uninterest'])->name('uninterest')->middleware('auth');
});
Route::get('/tags/{name}', [TagController::class, 'show'])->name('tags.show');
Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', [UserController::class, 'show'])->name('show');
  Route::get('/{name}/interests', [UserController::class, 'interests'])->name('interests');
});
Route::get('guest', [LoginController::class, 'guestLogin'])->name('login.guest');

Route::get('/home', [HomeController::class, 'index'])->name('home');




