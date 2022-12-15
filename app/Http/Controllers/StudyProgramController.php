<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \Yajra\DataTables\DataTables;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StudyProgram::with('faculty')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('study-programs.edit', $row->id) . '" class="btn btn-sm text-primary"><i class="fas fa-pen"></i></a>';
                    $btn = $btn . ' <a href="' . route('study-programs.show', $row->id) . '" class="btn btn-sm text-warning"><i class="fas fa-eye"></i></a>';
                    $btn = $btn . ' <a href="' . route('study-programs.destroy', $row->id) . '" class="btn btn-sm text-danger"  onclick="notificationBeforeDelete(event, this)"><i class="fas fa-trash" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('study-programs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('study-programs.create', [
            'title' => 'Tambah Data Program Studi',
            'faculties' => Faculty::all()
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
            'study_name' => 'required|unique:study_programs',
            'faculty_id' => 'required'
        ]);
        try {
            StudyProgram::create([
                'faculty_id' => $request->faculty_id,
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
        $data = [
            'title' => 'Detail Program Studi',
            'study_program' => StudyProgram::with('faculty')->findOrFail($id)
        ];
        return view('study-programs.show', $data);
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
                'study_program' => $study_program,
                'faculties' => Faculty::all()
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
        $request->validate([
            'faculty_id' => 'required',
            'study_name' => 'required'
        ]);

        try {
            $study_program = StudyProgram::find($id);
            $study_program->update([
                'faculty_id' => $request->faculty_id,
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
            $study_program = StudyProgram::find($id);
            $study_program->delete();
            return redirect()->route('study-programs.index')
                ->with('success_message', 'Data Program Studi Berhasil Dihapus');
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
