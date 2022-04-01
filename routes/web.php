<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
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

Route::get('/test/{name}/{age?}', [TestController::class, 'test'])->name('test');

Route::get('/test2', [TestController::class, 'test2'])->name('test2')->middleware('can:create posts');

Route::get('/test3', [TestController::class, 'test3'])->name('test3');

Route::prefix('/posts')->name('post.')->middleware('modifyRequestParams')->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::delete('/', [PostController::class, 'destroy'])->name('destroy');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PostController::class, 'update'])->name('update');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/{post}/image', [ImageController::class, 'getImage'])->name('image');

});

Route::get('switchLocale/{locale}', [LocaleController::class, 'switchLocale'])->name('switchLocale');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

