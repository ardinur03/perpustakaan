<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = \App\Models\Book::all();
            return view(
                'books.index',
                [
                    'title' => 'Books',
                    'books' => $data
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('books.index')->with('error', 'Error');
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
            'books.create',
            [
                'title' => 'Create Book'
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
                'book_name' => 'required',
                'page' => 'required',
                'description' => 'required',
                'publisher' => 'required',
                'author' => 'required',
                'stock' => 'required',
                'category' => 'required',
                'published_year' => 'required'
            ]);

            \App\Models\Book::create($request->all());

            return redirect()->route('books.index')
                ->with('success', 'Book created successfully.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('books.index')->with('error', 'Error');
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
            $book = \App\Models\Book::find($id);
            return view(
                'books.edit',
                [
                    'title' => 'Edit Book',
                    'book' => $book
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('books.index')->with('error', 'Error');
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
                'book_name' => 'required',
                'page' => 'required',
                'description' => 'required',
                'publisher' => 'required',
                'author' => 'required',
                'stock' => 'required',
                'category' => 'required',
                'published_year' => 'required'
            ]);

            $book = \App\Models\Book::find($id);
            $book->update($request->all());

            return redirect()->route('books.index')
                ->with('success', 'Book updated successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('books.index')->with('error', 'Error');
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
            $book = \App\Models\Book::find($id);
            $book->delete();

            return redirect()->route('books.index')
                ->with('success', 'Book deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('books.index')->with('error', 'Error');
        }
    }
}
