<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = \App\Models\Category::all();
            return view(
                'categories.index',
                [
                    'title' => 'Categories',
                    'categories' => $data
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
            'categories.create',
            [
                'title' => 'Create Category'
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
                'category_name' => 'required'
            ]);

            \App\Models\Category::create([
                'category_name' => $request->category_name
            ]);

            return redirect()->route('categories.index');
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
            $data = \App\Models\Category::find($id);
            return view(
                'categories.edit',
                [
                    'title' => 'Edit Category',
                    'category' => $data
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
                'category_name' => 'required'
            ]);

            \App\Models\Category::find($id)->update([
                'category_name' => $request->category_name
            ]);

            return redirect()->route('categories.index');
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
            \App\Models\Category::find($id)->delete();
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
        }
    }
}
