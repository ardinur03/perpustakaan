<?php

namespace App\Http\Controllers;

use App\Jobs\SendTransactionReports;
use App\Models\Book;
use App\Models\BorrowTransaction;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Mpdf\Mpdf as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\StudyProgram;

class MemberTransactionController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Member',
            'countAllBorrowTransaction' => BorrowTransaction::where('user_id', Auth::user()->id)->get()->count(),
            'countAllBorrowTransactionReturned' => BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'returned')->count(),
            'countAllBorrowTransactionOverdue' => BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'overdue')->count(),
            'countAllBorrowTransactionFineNow' => BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'Overdue')->sum('fine'),
            'countAllBorrowTransactionBorrowed' => BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'borrowed')->count(),
            'borrowTransactionNow' => BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'borrowed')->first(),
        ];

        if (Auth::user()->member->member_name == null) {
            return redirect()->route('member.edit-profile')->with('warning_message', 'Silahkan lengkapi data diri anda terlebih dahulu!');
        }

        return view('member-transaction.index', $data);
    }

    public function editProfile()
    {
        try {
            $user = Auth::user();
            return view('member-transaction.edit-profile', [
                'title' => 'Edit Profile',
                'user' => $user,
                'member' => Member::where('user_id', $user->id)->first(),
                'study_programs' => StudyProgram::with('Faculty')->get()
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('member.profile')->with('error_message', 'Gagal mengubah data diri');
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'member_name' => 'required',
            'gender' => 'required',
            'study_program_id' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        try {
            $user = Auth::user();

            $member = Member::where('user_id', $user->id)->first();
            $member->update([
                'member_name' => $request->member_name,
                'gender' => $request->gender,
                'study_program_id' => $request->study_program_id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);

            return redirect()->route('member.profile')->with('success_message', 'Profile berhasil diubah.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('member.profile')->with('error_message', 'Gagal mengubah data diri');
        }
    }

    public function profile()
    {
        try {
            $user = Auth::user();
            return view('member-transaction.profile', [
                'title' => 'Detail Member',
                'user' => $user,
                'member' => Member::where('user_id', $user->id)->first(),
                'study_programs' => StudyProgram::with('Faculty')->get()
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('member.profile')->with('error_message', 'Gagal mengubah data diri');
        }
    }

    public function peminjamanBuku(Request $request)
    {
        $book = $request->input('book');
        $category = $request->input('category');
        $data = [
            'title' => 'Peminjaman Buku',
            'books' => $book || $category ? Book::where('book_name', 'like', '%' . $book . '%')->whereHas('category', function ($query) use ($category) {
                $query->where('category_id', 'like', '%' . $category . '%');
            })->paginate(12) : Book::paginate(12),
            'categories' => Category::all(),
        ];

        return view('member-transaction.peminjaman-buku', $data);
    }

    public function storePemijamanBuku($id)
    {
        try {
            $book = Book::find($id);
            $borrowTransactions = BorrowTransaction::where('user_id', Auth::user()->id)
                ->where('status', 'borrowed')
                ->first();
            if ($borrowTransactions != null) {
                return redirect()->back()->with('warning_message', 'Anda hanya bisa meminjam 1 buah buku, Selesaikan pengembalian terlebih dahulu untuk bisa meminjam buku kembali!');
            }

            if ($book->stock >= 0) {
                $book->stock -= 1;
                // $book->save();
                // BorrowTransaction::create([
                //     'transaction_code' => 'TC' . time(),
                //     'user_id' => auth()->user()->id,
                //     'book_id' => $id,
                //     'borrow_date' => date('Y-m-d'),
                //     'return_date' => date('Y-m-d', strtotime('+7 days')),
                //     'fine' => 0,
                //     'status' => 'borrowed',
                // ]);
            }
            // dispact event send email transaction borrow book
            dispatch(new SendTransactionReports(Auth::user()->id));
            return redirect()->route('member.borrow-transaction-list')->with('success_message', 'Berhasil meminjam buku');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->back()->with('error_message', 'Gagal meminjam buku');
        }
    }

    public function borrowTransactionList()
    {
        try {
            $get_user_borrow = BorrowTransaction::where('user_id', Auth::user()->id)->where('status', 'borrowed')->first();
            $data = [
                'title' => 'Daftar Peminjaman Buku',
                'borrowTransactions' => BorrowTransaction::where('user_id', Auth::user()->id)->with('book')->orderBy('id', 'desc')->get(),
                'isBorrowed' => $get_user_borrow != null ? true : false,
            ];
            return view('member-transaction.borrow-transaction-list', $data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('member.dashboard')->with('error_message', 'Gagal menampilkan list transaksi');
        }
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
        try {
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
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->back()->with('error_message', 'Gagal mengembalikan buku');
        }
    }

    public function borrowTransactionShow($id)
    {
        $borrowTransaction = BorrowTransaction::where('id', $id)->first();
        if ($borrowTransaction->user_id != Auth::user()->id) {
            return redirect()->route('member.borrow-transaction-list')->with('warning_message', 'Ops.. Anda tidak memiliki akses untuk melihat detail peminjaman buku ini');
        }
        $data = [
            'title' => 'Detail Peminjaman Buku',
            'borrowTransaction' => BorrowTransaction::with('user.member', 'book')->findOrFail($id),
            'isShow' => true,
        ];
        return view('member-transaction.print-transaction', $data);
    }

    public function transactionPrint()
    {
        $borrowTransaction = BorrowTransaction::where('id', request()->id)->with(['book', 'user'])->first();
        $member_name = str_replace(' ', '-', $borrowTransaction->user->member->member_name);
        $documentFileName = "{$member_name}_Laporan-Peminjaman.pdf";

        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);

        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        $document->SetTitle("Laporan Peminjaman Buku {$borrowTransaction->user->member->member_name}");

        $document->WriteHTML(view('member-transaction.printed-transaction', [
            'borrowTransaction' => $borrowTransaction,
            'isPrint' => true,
        ]));

        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        return response()->download(storage_path('app/public/' . $documentFileName), $documentFileName, $header);
    }
}
