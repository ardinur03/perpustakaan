<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \Yajra\DataTables\DataTables;

class LibrarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Librarian::all();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('librarians.edit', $row->id) . '" class="btn btn-sm text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pen"></i></a>';
                        $btn = $btn . ' <a href="' . route('librarians.show', $row->id) . '" class="btn btn-sm text-warning" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fas fa-eye"></i></a>';
                        $btn = $btn . ' <a href="' . route('librarians.destroy', $row->id) . '" class="btn btn-sm text-danger"  onclick="notificationBeforeDelete(event, this)" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash" aria-hidden="true"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('librarians.index', [
                'title' => 'Data Petugas'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarians.create', [
            'title' => 'Tambah Data Petugas'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'librarian_name' => 'required',
            'position' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);
        try {
            Librarian::create($request->all());
            return redirect()->route('librarians.index')
                ->with('success_message', 'Data petugas berhasil ditambahkan');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('librarians.index')
                ->with('error', 'Data petugas gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title' => 'Detail Data Petugas',
            'librarian' => Librarian::findOrFail($id)
        ];
        return view('librarians.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $librarian = Librarian::findOrFail($id);
            return view('librarians.edit', [
                'title' => 'Edit Data Petugas',
                'librarian' => $librarian
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('librarians.index')
                ->with('error', 'Data petugas tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'librarian_name' => 'required',
            'position' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        try {
            Librarian::where('id', $id)
                ->update([
                    'librarian_name' => $request->librarian_name,
                    'position' => $request->position,
                    'gender' => $request->gender,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address
                ]);

            return redirect()->route('librarians.index')
                ->with('success_message', 'Data petugas berhasil diubah');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('librarians.index')
                ->with('error', 'Data petugas gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Librarian::destroy($id);
            return redirect()->route('librarians.index')
                ->with('success_message', 'Data petugas berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('librarians.index')
                ->with('error', 'Data petugas gagal dihapus');
        }
    }
}
