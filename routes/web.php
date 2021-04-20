<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('posts')->group(function () {

    Route::get('/', [PostController::class,'index'])->name('posts.index');
    Route::get('/create', [PostController::class,'create'])->name('posts.create');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::get('/show/{post:slug}', [PostController::class,'show'])->name('posts.show');
    Route::get('/edit/{post:slug}',[postController::class,'edit'])->name('posts.edit');

    Route::prefix('{id}')->group(function () {

        Route::put('/',[PostController::class,'update'])->name('posts.update');
        Route::delete('/',[PostController::class,'destroy'])->name('posts.destroy');
        Route::prefix('comment')->group(function () {
            Route::post('/store', [CommentController::class,'store'])->name('posts.comments.store');
        });
    });
});
Route::prefix('comment')->group(function () {
    Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');
    Route::put('/', [CommentController::class, 'update'])->name('comments.update');
    Route::get('/{comment}', [CommentController::class, 'edit'])->name('comments.edit');
    Route::delete('/',[CommentController::class,'destroy'])->name('comment.destroy');
});


