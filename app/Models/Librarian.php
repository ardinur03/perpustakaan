<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Librarian extends Model
{
    use HasFactory;
    protected $table = 'librarians';
    protected $fillable = [
        'librarian_name',
        'position',
        'gender',
        'phone_number',
        'address'
    ];
}
