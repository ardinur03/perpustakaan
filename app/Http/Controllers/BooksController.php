<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
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
            // $data = Book::select('books.*', 'categories.category_name')
            //     ->join('categories', 'books.category_id', '=', 'categories.id');

            // get all data from books table and join with categories table using with method
            $data = Book::with('category')->get();

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
        $request->validate([
            'book_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'page' => 'required',
            'description' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'published_year' => 'required'
        ]);
        try {

            // upload image to storage folder and get the path to store in database
            Storage::disk('public')->put('books', $request->file('image'));

            \App\Models\Book::create([
                'book_name' => $request->book_name,
                'image' => $request->file('image')->hashName(),
                'page' => $request->page,
                'description' => $request->description,
                'publisher' => $request->publisher,
                'author' => $request->author,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'published_year' => $request->published_year
            ]);

            return redirect()->route('books.index')
                ->with('success_message', 'Berhasil menambah member baru.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('books.index');
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
            $book = \App\Models\Book::findOrFail($id);
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
            return redirect()->route('books.index');
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'page' => 'required',
            'description' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'published_year' => 'required'
        ]);

        try {

            $book = \App\Models\Book::findOrFail($id);

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('books/' . $book->image);
                Storage::disk('public')->put('books', $request->file('image'));
            }

            $book->update([
                'book_name' => $request->book_name,
                // jika image tidak diubah maka tidak perlu diupdate
                'image' => $request->hasFile('image') ? $request->file('image')->hashName() : $book->image,
                'page' => $request->page,
                'description' => $request->description,
                'publisher' => $request->publisher,
                'author' => $request->author,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'published_year' => $request->published_year
            ]);

            return redirect()->route('books.index')
                ->with('success_message', 'Buku Berhasil diperbaharui.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('books.index');
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

            // cek apakah buku ini ada di borrow_transaction
            $borrowTransaction = \App\Models\BorrowTransaction::where('book_id', $id)->first();
            if ($borrowTransaction) {
                return redirect()->route('books.index')
                    ->with('error_message', 'Buku tidak dapat dihapus karena sedang dipinjam.');
            }

            $book->delete();

            // delete image from storage
            Storage::disk('public')->delete('books/' . $book->image);

            return redirect()->route('books.index')
                ->with('success_message', 'Buku Berhasil Dihapus');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('books.index');
        }
    }
}
