<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{

    public function index()
    {
        return view('welcome', [
            'title' => 'Welcome to Perpustakaan WebApp',
        ]);
    }

    public function listBuku()
    {
        // get all book data from database using eager loading
        $books = Book::with('category')->paginate(12);
        return view('welcome-lihat-buku', [
            'books' => $books
        ]);
    }

    public function kontak()
    {
        return view('welcome-kontak', [
            'title' => 'Kontak'
        ]);
    }
    public function tentang()
    {
        return view('welcome-tentang', [
            'title' => 'Tentang'
        ]);
    }
}
