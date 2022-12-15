<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberTransactionController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('lihat-buku', [WelcomeController::class, 'listBuku'])->name('lihat-buku');

Auth::routes();

// role admin petugas
Route::prefix('admin')->middleware(['auth', 'role:petugas|super-admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile')->middleware('role:petugas');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings')->middleware('role:super-admin');
    Route::get('/edit-profile', [AdminController::class, 'editProfile'])->name('admin.edit-profile');
    Route::post('/update-profile', [AdminController::class, 'updateProfile'])->name('admin.update-profile');
    Route::resource('users', UserController::class);
    Route::resource('members', MemberController::class);
    Route::resource('librarians', LibrarianController::class);
    Route::resource('books', BooksController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('study-programs', StudyProgramController::class);
    Route::resource('faculties', FacultyController::class);
    Route::resource('events', EventController::class);
    Route::post('share-event/{id}', [EventController::class, 'sendEventToAllMemberEmail'])->name('send.event.to.all.member');
    Route::get('transaction-list', [AdminController::class, 'transactionList'])->name('admin.transaction-list');
    Route::get('transaction-list/{id}', [AdminController::class, 'transactionListShow'])->name('admin.transaction-list-show');
    Route::delete('transaction-list/{id}', [AdminController::class, 'transactionListDestroy'])->name('admin.transaction-list-destroy');
});

// role member
Route::group(['middleware' => ['auth', 'role:member']], function () {
    Route::get('/dashboard', [MemberTransactionController::class, 'index'])->name('member.dashboard');
    Route::get('/profile', [MemberTransactionController::class, 'profile'])->name('member.profile');
    Route::get('/edit-profile', [MemberTransactionController::class, 'editProfile'])->name('member.edit-profile');
    Route::post('/update-profile', [MemberTransactionController::class, 'updateProfile'])->name('member.update-profile');
    Route::get('/books-list', [MemberTransactionController::class, 'peminjamanBuku'])->name('member.peminjaman-buku');
    Route::get('/peminjaman-buku/{Book}', [MemberTransactionController::class, 'storePemijamanBuku'])->name('member.peminjaman-buku.store');
    Route::get('/search-buku', [MemberTransactionController::class, 'searchBuku'])->name('searchBuku');
    Route::get('/borrow-transaction-list', [MemberTransactionController::class, 'borrowTransactionList'])->name('member.borrow-transaction-list');
    Route::get('/borrow-transaction-list/return', [MemberTransactionController::class, 'borrowTransactionReturn'])->name('member.borrow-transaction-return');
    Route::get('/borrow-transaction-list/{id}', [MemberTransactionController::class, 'borrowTransactionShow'])->name('member.borrow-transaction-show');
    Route::post('/borrow-transaction-return', [MemberTransactionController::class, 'borrowTransactionReturnStore'])->name('member.borrow-transaction-return-store');
    Route::post('/borrow-transaction-print', [MemberTransactionController::class, 'transactionPrint'])->name('member.borrow-transaction-print');
});

// role superadmin
Route::prefix('super-admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/activity-log', [SuperAdminController::class, 'activityLog'])->name('superadmin.activity-log');
});
