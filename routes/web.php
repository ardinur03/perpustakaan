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

Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');

Route::resource('members', \App\Http\Controllers\MemberController::class)->middleware('auth');

Route::resource('librarians', \App\Http\Controllers\LibrarianController::class)->middleware('auth');

Route::resource('books', \App\Http\Controllers\BooksController::class)->middleware('auth');

Route::resource('study-programs', \App\Http\Controllers\StudyProgramController::class)->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/dashboard', fn () => 'dashboard')->name('dashboard')->middleware('auth');
