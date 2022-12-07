<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberTransactionController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\TestQueueEmails;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('lihat-buku', [WelcomeController::class, 'listBuku'])->name('lihat-buku');

Route::get('/printed-transaction', function () {
    return view('member-transaction.printed-transaction');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
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

// , 'role:member'
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [MemberTransactionController::class, 'index'])->name('member.dashboard');
    Route::get('/books-list', [MemberTransactionController::class, 'peminjamanBuku'])->name('member.peminjaman-buku');
    Route::get('/peminjaman-buku/{Book}', [MemberTransactionController::class, 'storePemijamanBuku'])->name('member.peminjaman-buku.store');
    Route::get('/search-buku', [MemberTransactionController::class, 'searchBuku'])->name('searchBuku');
    Route::get('/borrow-transaction-list', [MemberTransactionController::class, 'borrowTransactionList'])->name('member.borrow-transaction-list');
    Route::get('/borrow-transaction-list/return', [MemberTransactionController::class, 'borrowTransactionReturn'])->name('member.borrow-transaction-return');
    Route::get('/borrow-transaction-list/{id}', [MemberTransactionController::class, 'borrowTransactionShow'])->name('member.borrow-transaction-show');
    Route::post('/borrow-transaction-return', [MemberTransactionController::class, 'borrowTransactionReturnStore'])->name('member.borrow-transaction-return-store');
    Route::post('/borrow-transaction-print', [MemberTransactionController::class, 'transactionPrint'])->name('member.borrow-transaction-print');
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

// give roles to user by route (member)
Route::get('/get-role-member', function () {
    $user = \App\Models\User::find(Auth::id());
    $user->assignRole('member');
    return $user;
});

// give roles to user by route (petugas)
Route::get('/get-role-petugas', function () {
    $user = \App\Models\User::find(Auth::id());
    $user->assignRole('petugas');
    return $user;
});



Route::get('/send-mail', [TestQueueEmails::class, 'sendTestEmails']);

Route::get('send', function () {
    $cek = session()->get('success');
    echo $cek;
    echo "<a href=\"http://localhost:8000/send-mail\"> Send Email</a>";
});
