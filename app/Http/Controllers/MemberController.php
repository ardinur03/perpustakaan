<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();

        return view('members.index', [
            'title' => 'Daftar Member',
            'members' => $members
        ]);
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
        $member = Member::findOrFail($id);
        return view('members.edit', [
            'title' => 'Edit Member',
            'members' => $member
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::destroy($id);
        return redirect()->route('members.index')
            ->with('success_message', 'Berhasil menghapus data member');
    }
}
