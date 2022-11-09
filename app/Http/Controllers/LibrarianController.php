<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Librarian::all();
        return view('librarians.index', [
            'title' => 'Data Petugas',
            'librarians' => $data
        ]);
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

        Librarian::create($request->all());

        return redirect()->route('librarians.index')
            ->with('success_message', 'Data petugas berhasil ditambahkan');
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
        $librarian = Librarian::find($id);
        return view('librarians.edit', [
            'title' => 'Edit Data Petugas',
            'librarian' => $librarian
        ]);
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

        $librarian = Librarian::find($id);
        $librarian->librarian_name = $request->librarian_name;
        $librarian->position = $request->position;
        $librarian->gender = $request->gender;
        $librarian->phone_number = $request->phone_number;
        $librarian->address = $request->address;
        $librarian->save();

        return redirect()->route('librarians.index')
            ->with('success_message', 'Data petugas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $librarian = Librarian::find($id);
        $librarian->delete();

        return redirect()->route('librarians.index')
            ->with('success_message', 'Data petugas berhasil dihapus');
    }
}
