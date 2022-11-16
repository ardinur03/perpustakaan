<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Book;
use Yajra\DataTables\DataTables;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // get all data from books table and join with categories table using eloquent with
            $data = Book::select('books.*', 'categories.category_name')
                ->join('categories', 'books.category_id', '=', 'categories.id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('books.edit', $row->id) . '" class="btn btn-sm text-primary"><i class="fas fa-pen"></i></a>';
                    $btn = $btn . ' <a href="' . route('books.destroy', $row->id) . '" class="btn btn-sm text-danger"  onclick="notificationBeforeDelete(event, this)"><i class="fas fa-trash" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('books.index');
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
        try {
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

            \App\Models\Book::create($request->all());

            return redirect()->route('books.index')
                ->with('success', 'Book created successfully.');
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
        try {
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

            $book = \App\Models\Book::find($id);
            $book->update($request->all());

            return redirect()->route('books.index')
                ->with('success', 'Book updated successfully');
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
                ->with('success', 'Book deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
        }
    }
}
