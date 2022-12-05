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
        $books = Book::paginate(12);
        return view('welcome-lihat-buku', [
            'books' => $books
        ]);
    }
}
