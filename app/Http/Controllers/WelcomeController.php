<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index()
    {
        return view('welcome', [
            'title' => 'Welcome to Perpustakaan WebApp',
        ]);
    }

    public function listBuku(Request $request)
    {
        $book = $request->input('book');
        $category = $request->input('category');
        $data = [
            'title' => 'Peminjaman Buku',
            'books' => $book || $category ? Book::where('book_name', 'like', '%' . $book . '%')->whereHas('category', function ($query) use ($category) {
                $query->where('category_id', 'like', '%' . $category . '%');
            })->paginate(12) : Book::paginate(12),
            'categories' => Category::all(),
        ];
        return view('welcome-lihat-buku', $data);
    }
}
