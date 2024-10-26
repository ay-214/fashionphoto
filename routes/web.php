<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//(FashionController::class)->prefix('admin')のRouting設定
use App\Http\Controllers\Admin\FashionController;
Route::controller(FashionController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('fashion/create', 'add')->name('fashion.add');
    Route::post('fashion/create', 'create')->name('fashion.create');
    Route::get('fashion', 'index')->name('fashion.index');
    Route::get('fashion/edit', 'edit')->name('fashion.edit');
    Route::post('fashion/edit', 'update')->name('fashion.update');
    Route::get('fashion/delete', 'delete')->name('fashion.delete'); 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\FashionController as PublicFashionController;
Route::controller(PublicFashionController::class)->group(function() {
    Route::get('/', 'index')->name('fashion.index');

    //⇩front.blade.phpでユーザーが検索する機能をつけるために追加
    Route::get('search', 'search')->name('fashion.search'); 
});
