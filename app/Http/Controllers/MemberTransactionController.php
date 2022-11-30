<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowTransaction;
use Illuminate\Support\Facades\Auth;
use \Mpdf\Mpdf as PDF;
use Illuminate\Support\Facades\Storage;

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
                'transaction_code' => 'TC' . time(),
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

        if ($borrowTransaction->return_date < date('Y-m-d')) {
            // denda 500 berdasakan hari
            $borrowTransaction->fine = (strtotime(date('Y-m-d')) - strtotime($borrowTransaction->return_date)) / (60 * 60 * 24) * 500;
            $borrowTransaction->status = 'overdue';
        } else {
            $borrowTransaction->status = 'returned';
        }

        $borrowTransaction->save();
        $book->save();

        return redirect()->route('member.borrow-transaction-list')->with('success_message', 'Berhasil mengembalikan buku');
    }

    public function borrowTransactionShow($id)
    {
        $data = [
            'title' => 'Detail Peminjaman Buku',
            // get data from borrow transaction table where user_id and id
            'borrowTransaction' => BorrowTransaction::where('id', $id)->with(['book', 'user'])->first(),
        ];
        return view('member-transaction.print-transaction', $data);
    }

    public function transactionPrint()
    {
        // get data member transaction where user_id and status
        $borrowTransaction = BorrowTransaction::where('user_id', Auth::user()->id)->with(['book', 'user'])->first();

        // Setup a filename 
        $member_name = str_replace(' ', '-', $borrowTransaction->user->member->member_name);
        $documentFileName = "{$member_name}_Laporan-Peminjaman.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        // Set the document title
        $document->SetTitle("Laporan Peminjaman Buku {$borrowTransaction->user->member->member_name}");

        // render dari component transaction-report
        $document->WriteHTML(view('components.rtransaction', [
            'borrowTransaction' => $borrowTransaction,
            'isPrint' => true,
        ]));

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Return the PDF as a response to the browser and download it
        return response()->download(storage_path('app/public/' . $documentFileName), $documentFileName, $header);
    }
}
