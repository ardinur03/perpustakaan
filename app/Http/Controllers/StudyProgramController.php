<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $study_programs = StudyProgram::all();
            return view('study-programs.index', [
                'title' => 'Daftar Program Studi',
                'studyprograms' => $study_programs
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
        return view('study-programs.create', [
            'title' => 'Tambah Data Program Studi'
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
        try {
            $request->validate([
                'study_name' => 'required'
            ]);

            StudyProgram::create([
                'study_name' => $request->study_name
            ]);

            return redirect()->route('study-programs.index')
                ->with('success_message', 'Data Program Studi Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('study-programs.index')
                ->with('error', 'Data Program Studi Gagal Ditambahkan');
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
            $study_program = StudyProgram::findOrFail($id);
            return view('study-programs.edit', [
                'title' => 'Edit Data Program Studi',
                'study_program' => $study_program
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('study-programs.index')->with('error', 'Data Program Studi Gagal Diubah');
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
        try {
            $request->validate([
                'study_name' => 'required'
            ]);

            StudyProgram::where('id', $id)
                ->update([
                    'study_name' => $request->study_name
                ]);

            return redirect()->route('study-programs.index')
                ->with('success_message', 'Data Program Studi Berhasil Diubah');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('study-programs.index')->with('error', 'Data Program Studi Gagal Diubah');
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
            StudyProgram::destroy($id);
            return redirect()->route('study-programs.index')
                ->with('success', 'Data Program Studi Berhasil Dihapus');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('study-programs.index')->with('error', 'Data Program Studi Gagal Dihapus');
        }
    }
}
