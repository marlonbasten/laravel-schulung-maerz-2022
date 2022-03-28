<?php

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

Route::get('/test2', [TestController::class, 'test2'])->name('test2');

Route::prefix('/posts')->name('post.')->group(function () {

    Route::get('/', [])->name('index');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/create', [PostController::class, 'create'])->name('create');

});
