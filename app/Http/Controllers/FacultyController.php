<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Faculty;
use App\Models\StudyProgram;
use \Yajra\DataTables\DataTables;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faculty::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('faculties.edit', $row->id) . '" class="btn btn-sm text-primary"><i class="fas fa-pen"></i></a>';
                    $btn = $btn . ' <a href="' . route('faculties.show', $row->id) . '" class="btn btn-sm text-warning"><i class="fas fa-eye"></i></a>';
                    $btn = $btn . ' <a href="' . route('faculties.destroy', $row->id) . '" class="btn btn-sm text-danger"  onclick="notificationBeforeDelete(event, this)"><i class="fas fa-trash" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('faculties.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'faculties.create',
            [
                'title' => 'Create Faculty',
            ]
        );
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
            'faculty_name' => 'required',
        ]);
        try {
            Faculty::create([
                'faculty_name' => $request->faculty_name,
            ]);

            return redirect()->route('faculties.index')->with('success_message', 'Berhasil menambah member baru.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('faculties.index');
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
        try {
            $data = Faculty::find($id);
            return view(
                'faculties.show',
                [
                    'title' => 'Show Faculty',
                    'faculty' => $data,
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('faculties.index');
        }
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
            $data = Faculty::find($id);
            return view(
                'faculties.edit',
                [
                    'title' => 'Edit Faculty',
                    'faculty' => $data,
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('faculties.index');
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
            'faculty_name' => 'required',
        ]);
        try {

            Faculty::find($id)->update([
                'faculty_name' => $request->faculty_name,
            ]);

            return redirect()->route('faculties.index')->with('success_message', 'Kategori berhasil diperbaharui.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('faculties.index');
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
            Faculty::find($id)->delete();
            return redirect()->route('faculties.index')->with('success_message', 'Kategori berhasil dihapus.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('faculties.index')->with('error_message', 'Kategori gagal dihapus. Kategori masih memiliki data di tabel lain.');
        }
    }
}
