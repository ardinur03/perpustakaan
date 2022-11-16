<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberTransactionController extends Controller
{
    public function index()
    {
        return view('member-transaction.index');
    }

    public function peminjamanBuku()
    {
        $data = [
            'title' => 'Peminjaman Buku',
            'books' => Book::all(),
        ];
        return view('member-transaction.peminjaman-buku', $data);
    }

    public function storePemijamanBuku($id)
    {
        $book = Book::find($id);
        $borrowTransactions = BorrowTransaction::where('user_id', Auth::user()->id)
            ->where('status', 'borrowed')
            ->first();

        if ($borrowTransactions != null) {
            return redirect()->back()->with('warning_message', 'Anda sudah meminjam buku');
        }

        if ($book->stock >= 0) {
            $book->stock -= 1;
            $book->save();

            BorrowTransaction::create([
                'user_id' => auth()->user()->id,
                'book_id' => $id,
                'borrow_date' => date('Y-m-d'),
                'return_date' => date('Y-m-d', strtotime('+7 days')),
                'fine' => 0,
                'status' => 'borrowed',
            ]);
        }
        return redirect()->back()->with('success_message', 'Berhasil meminjam buku');
    }

    public function borrowTransactionList()
    {
        $get_user_borrow = BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'borrowed')->first();
        $data = [
            'title' => 'Daftar Peminjaman Buku',
            'borrowTransactions' => BorrowTransaction::where('user_id', Auth::user()->id)->with('book')->orderBy('id', 'desc')->get(),
            'isBorrowed' => $get_user_borrow != null ? true : false,
        ];
        return view('member-transaction.borrow-transaction-list', $data);
    }

    public function borrowTransactionReturn()
    {
        $data = [
            'title' => 'Pengembalian Buku',
            'borrowTransactions' => BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'borrowed')->with('book')->first(),
        ];
        return view('member-transaction.borrow-transaction-return', $data);
    }

    public function borrowTransactionReturnStore()
    {
        $borrowTransaction = BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'borrowed')->first();
        $book = Book::find($borrowTransaction->book_id);

        $book->stock += 1;
        $book->save();

        $borrowTransaction->status = 'returned';
        $borrowTransaction->save();

        return redirect()->route('member.borrow-transaction-list')->with('success_message', 'Berhasil mengembalikan buku');
    }
}
