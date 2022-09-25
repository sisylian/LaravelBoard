<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ApiController;

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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('board')->group(function () {
    Route::get('/', [BoardController::class, 'index'])->name('board.index')->middleware('auth');
    Route::get('create', [BoardController::class, 'create'])->name('board.create');
    Route::post('store', [BoardController::class, 'store'])->name('board.store');
    Route::get('show/{boardInfo}', [BoardController::class, 'show'])->name('board.show');
    Route::get('edit', [BoardController::class, 'edit'])->name('board.edit');
    Route::put('update/{boardInfo}', [BoardController::class, 'update'])->name('board.update');
    Route::get('destroy/{boardInfo}', [BoardController::class, 'destroy'])->name('board.destroy');
});

Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('auth.login');
    Route::post('loginauth', [LoginController::class, 'loginauth'])->name('auth.loginauth');
    Route::get('register', [LoginController::class, 'register'])->name('auth.register');
    Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
    Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');
});

Route::prefix('api')->group(function () {
    Route::post('cmtwrite', [ApiController::class, 'cmtwrite'])->name('api.cmtwrite');
    Route::post('cmtremove', [ApiController::class, 'cmtremove'])->name('api.cmtremove');
});
Auth::routes();
