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

        // cek apakah user sudah meminjam buku 
        $borrow = BorrowTransaction::where('user_id', Auth::id())->first();
        if ($borrow) {
            return redirect()->back()->with('info_message', 'Anda sudah meminjam buku');
        }
        if ($book->stock >= 0) {
            $book->stock -= 1;
            $book->save();

            // add to table borrow_transaction
            BorrowTransaction::create([
                'user_id' => auth()->user()->id,
                'book_id' => $id,
                'borrow_date' => date('Y-m-d'),
                'return_date' => date('Y-m-d', strtotime('+7 days')),
                'fine' => 0,
                'status' => 'borrowed',
            ]);
        }
        return redirect()->back();
    }
}
