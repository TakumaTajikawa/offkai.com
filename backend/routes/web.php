<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\HomeController;

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
Route::resource('/plans', PlanController::class)->except(['index'])->middleware('auth'); 

Route::get('/home', [HomeController::class, 'index'])->name('home');




