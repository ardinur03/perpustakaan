<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $members = Member::all();
            return view('members.index', [
                'title' => 'Daftar Member',
                'members' => $members
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
        return view('members.create', [
            'title' => 'Tambah Member',
            'faculties' => Faculty::with('StudyProgram')->get()
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
            'member_name' => 'required',
            'member_code' => 'required|unique:members',
            'faculty_id' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        try {
            Member::create([
                'member_name' => $request->member_name,
                'member_code' => $request->member_code,
                'faculty_id' => $request->faculty_id,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ]);

            return redirect()->route('members.index')
                ->with('success_message', 'Berhasil menambah member baru');
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
            $member = Member::findOrFail($id);
            return view('members.edit', [
                'title' => 'Edit Member',
                'members' => $member,
                'faculties' => Faculty::with('StudyProgram')->get()
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
    public function update(Request $request, Member $member)
    {

        $request->validate([
            'member_name' => 'required',
            'member_code' => 'required|unique:members,member_code,' . $member->id,
            'gender' => 'required',
            'phone_number' => 'required|numeric',
            'address' => 'required'
        ]);

        try {
            $Data = $request->all();
            $member->update($Data);
            return redirect()->route('members.index')
                ->with('success_message', 'Berhasil mengubah data member');
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
            Member::destroy($id);
            return redirect()->route('members.index')
                ->with('success_message', 'Berhasil menghapus data member');
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
