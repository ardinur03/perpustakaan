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

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => view('home'))->name('home')->middleware('auth');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('members', \App\Http\Controllers\MemberController::class);
    Route::resource('librarians', \App\Http\Controllers\LibrarianController::class);
    Route::resource('books', \App\Http\Controllers\BooksController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware('auth');
});

Route::get('/dashboard', fn () => 'dashboard')->name('dashboard')->middleware('auth');
