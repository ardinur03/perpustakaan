<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LibrarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $librarians = Librarian::all();
            return view('librarians.index', [
                'title' => 'Daftar Petugas Perpustakaan',
                'librarians' => $librarians
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('home');
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
        //
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
            return redirect()->route('home');
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
            return redirect()->route('home');
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
            return redirect()->route('home');
        }
    }
}
