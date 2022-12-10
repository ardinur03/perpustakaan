<?php

namespace App\Http\Controllers;

use App\Models\BorrowTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function transactionList(Request $request)
    {
        if ($request->ajax()) {
            $data = BorrowTransaction::with('user.member', 'book')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                    $btn = $btn . '<a href="' . route('admin.transaction-list-show', $row->id) . '" class="btn btn-sm text-warning"><i class="fas fa-eye"></i></a>';
                    $btn = $btn . ' <a href="' . route('admin.transaction-list-destroy', $row->id) . '" class="btn btn-sm text-danger"  onclick="notificationBeforeDelete(event, this)"><i class="fas fa-trash" aria-hidden="true"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.borrow-transaction.index');
    }

    public function transactionListShow($id)
    {
        $data = [
            'borrowTransaction' => BorrowTransaction::with('user.member', 'book')->findOrFail($id),
            'isShow' => true,
            'title' => 'Detail Transaksi'
        ];
        return view('admin.borrow-transaction.show', $data);
    }

    public function transactionListDestroy($id)
    {
        $borrowTransaction = BorrowTransaction::find($id);
        $borrowTransaction->delete();
        return redirect()->route('admin.transaction-list')->with('success_message', 'Berhasil menghapus data');
    }
}
