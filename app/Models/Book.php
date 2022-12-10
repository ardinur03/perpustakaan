<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'book_name',
        'image',
        'page',
        'description',
        'publisher',
        'author',
        'stock',
        'category_id',
        'published_year'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
