<?php

namespace App\Http\Controllers;

use App\Models\BorrowTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Librarian;

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
                    $btn = $btn . '<a href="' . route('admin.transaction-list-show', $row->id) . '" class="btn btn-sm text-warning" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fas fa-eye"></i></a>';
                    $btn = $btn . ' <a href="' . route('admin.transaction-list-destroy', $row->id) . '" class="btn btn-sm text-danger"  onclick="notificationBeforeDelete(event, this)" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash" aria-hidden="true"></i></a>';
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

    public function editProfile()
    {
        try {
            $user = Auth::user();
            return view('admin.edit-profile', [
                'title' => 'Edit Profile',
                'user' => $user,
                'member' => Librarian::where('user_id', $user->id)->first(),
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('admin.profile')->with('error_message', 'Gagal mengubah data diri');
        }
    }

    public function updateProfile(Request $request)
    {
        // $request->validate([
        //     'member_name' => 'required',
        //     'gender' => 'required',
        //     'study_program_id' => 'required',
        //     'phone_number' => 'required',
        //     'address' => 'required',
        // ]);

        try {
            $user = Auth::user();

            $member = Librarian::where('user_id', $user->id)->first();
            $member->update([
                'member_name' => $request->member_name,
                'gender' => $request->gender,
                'study_program_id' => $request->study_program_id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);

            return redirect()->route('admin.profile')->with('success_message', 'Profile berhasil diubah.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('admin.profile')->with('error_message', 'Gagal mengubah data diri');
        }
    }

    public function profile()
    {
        try {
            $user = Auth::user();
            return view('admin.profile', [
                'title' => 'Profile',
                'user' => $user,
                'librarian' => Librarian::where('user_id', $user->id)->first(),
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('admin.dashboard')->with('error_message', 'Gagal membuka profile');
        }
    }

    public function settings()
    {
        try {
            $user = Auth::user();
            return view('superadmin.edit-profile', [
                'title' => 'Edit Profile',
                'admin' => $user,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('admin.dashboard')->with('error_message', 'Gagal membuka pengaturan');
        }
    }
}
