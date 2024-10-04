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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
