<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Book extends Model
{
    use HasFactory, LogsActivity, CausesActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Master ' . $this->table)
            ->logFillable();
    }
}
