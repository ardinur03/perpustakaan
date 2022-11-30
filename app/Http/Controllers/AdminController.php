<?php

namespace App\Http\Controllers;

use App\Models\BorrowTransaction;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'transactions' => BorrowTransaction::all()
        ]);
    }
}
