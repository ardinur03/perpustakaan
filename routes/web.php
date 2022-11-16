<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberTransactionController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

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
    Route::resource('users', UserController::class);
    Route::resource('members', MemberController::class);
    Route::resource('librarians', LibrarianController::class);
    Route::resource('books', BooksController::class);
    Route::resource('categories', CategoryController::class)->middleware('auth');
    Route::resource('study-programs', StudyProgramController::class)->middleware('auth');
    Route::resource('faculties', FacultyController::class)->middleware('auth');
});

Route::get('/dashboard', fn () => 'dashboard')->name('dashboard')->middleware('auth');

// , 'role:member'
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [MemberTransactionController::class, 'index'])->name('member.dashboard');
    Route::get('/peminjaman-buku', [MemberTransactionController::class, 'peminjamanBuku'])->name('member.peminjaman-buku');
    Route::get('/peminjaman-buku/{Book}', [MemberTransactionController::class, 'storePemijamanBuku'])->name('member.peminjaman-buku.store');
});

// give permission to user with role petugas by route
Route::get('/get-permission-petugas', function () {
    $user = \App\Models\User::find(Auth::id());
    $user->givePermissionTo('crud master');
    return $user;
});

// give permission to user with role super-admin by route
Route::get('/get-permission-super-admin', function () {
    // cara memberikan akses melalui command line tinker
    // php artisan tinker
    // $user = \App\Models\User::find(1);
    // $user->assignRole('super-admin');
    // $user->givePermissionTo(Spatie\Permission\Models\Permission::all());
    // exit
    $user = \App\Models\User::find(Auth::id());
    $user->givePermissionTo(Permission::all());
    return $user;
});

// give permission to user with role member by route
Route::get('/get-permission-member', function () {
    $user = \App\Models\User::find(Auth::id());
    $user->givePermissionTo('akses member');
    return $user;
});
