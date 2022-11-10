<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = \App\Models\Faculty::all();
            return view(
                'faculties.index',
                [
                    'title' => 'Faculties',
                    'faculties' => $data
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
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
        return view(
            'faculties.create',
            [
                'title' => 'Create Faculty',
                'study_programs' => \App\Models\StudyProgram::all()
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
        try {
            $request->validate([
                'faculty_name' => 'required'
            ]);

            \App\Models\Faculty::create([
                'faculty_name' => $request->faculty_name,
                'study_program_id' => $request->study_program_id
            ]);

            return redirect()->route('faculties.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
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
            $data = \App\Models\Faculty::find($id);
            return view(
                'faculties.edit',
                [
                    'title' => 'Edit Faculty',
                    'faculty' => $data,
                    'study_programs' => \App\Models\StudyProgram::all()
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
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
        try {
            $request->validate([
                'faculty_name' => 'required',
                'study_program_id' => 'required'
            ]);

            \App\Models\Faculty::find($id)->update([
                'faculty_name' => $request->faculty_name,
                'study_program_id' => $request->study_program_id
            ]);

            return redirect()->route('faculties.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
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
            \App\Models\Faculty::find($id)->delete();
            return redirect()->route('faculties.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
        }
    }
}
