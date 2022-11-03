<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
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

            // activity log by spatie
            // activity()
            //     ->causedBy(auth()->user())
            //     ->performedOn($members)
            //     ->withProperties(['ip' => request()->ip()])
            //     ->log('View all members');

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
            'title' => 'Tambah Member'
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
                'member_name' => 'required',
                'member_code' => 'required|unique:members',
                'gender' => 'required',
                'phone_number' => 'required',
                'address' => 'required'
            ]);

            Member::create($request->all());

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
                'members' => $member
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
        try {
            $request->validate([
                'member_name' => 'required',
                'member_code' => 'required|unique:members,member_code,' . $id,
                'gender' => 'required',
                'phone_number' => 'required|numeric',
                'address' => 'required'
            ]);

            Member::where('id', $id)
                ->update([
                    'member_name' => $request->member_name,
                    'member_code' => $request->member_code,
                    'gender' => $request->gender,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address
                ]);

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
