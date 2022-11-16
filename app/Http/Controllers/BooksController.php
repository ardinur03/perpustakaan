<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

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
            $data = Book::all();
            return view(
                'books.index',
                [
                    'title' => 'Books',
                    'books' => $data
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
            'books.create',
            [
                'title' => 'Create Book',
                'categories' => \App\Models\Category::all()
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
            'book_name' => 'required',
            'page' => 'required',
            'description' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'published_year' => 'required'
        ]);
        try {
            \App\Models\Book::create($request->all());

            return redirect()->route('books.index')
                ->with('success_message', 'Berhasil menambah member baru.');
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
            $book = \App\Models\Book::find($id);
            return view(
                'books.edit',
                [
                    'title' => 'Edit Book',
                    'book' => $book,
                    'categories' => \App\Models\Category::all()
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
        $request->validate([
            'book_name' => 'required',
            'page' => 'required',
            'description' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'published_year' => 'required'
        ]);

        try {

            $book = \App\Models\Book::find($id);
            $book->update($request->all());

            return redirect()->route('books.index')
                ->with('success_message', 'Buku Berhasil Diupdate.');
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
            $book = \App\Models\Book::find($id);
            $book->delete();

            return redirect()->route('books.index')
                ->with('success_message', 'Buku Berhasil Dihapus');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
        }
    }
}
