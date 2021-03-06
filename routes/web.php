<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ANRController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
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

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::post('/home', [HomeController::class, 'submit'])->name('home.submit');

    Route::get('/anr', [ANRController::class, 'index'])->name('anr.index');

    Route::get('/submitted', [HomeController::class, 'submitted'])->name('home.submitted');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin', [AdminController::class, 'update'])->name('admin.update');

    Route::post('/comment/{id}', [CommentController::class, 'create'])->name('comment.create');


    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');

    Route::post('/favorite/{id}', [FavoriteController::class, 'add'])->name('favorite.add');
    Route::get('/favorite', [FavoriteController::class, 'show'])->name('favorite.show');
    Route::post('/deleteFavorite/{id}', [FavoriteController::class, 'delete'])->name('favorite.delete');


    Route::get('/comment/{id}', [CommentController::class, 'show'])->name('comment.show');
    Route::post('/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
    Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('/update/{id}', [CommentController::class, 'update'])->name('comment.update');
});


Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}
