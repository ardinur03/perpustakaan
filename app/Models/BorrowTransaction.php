<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class BorrowTransaction extends Model
{
    use HasFactory, LogsActivity, CausesActivity;

    protected $table = 'borrow_transactions';

    protected $fillable = [
        'transaction_code',
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'fine',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName($this->table)
            ->logFillable();
    }
}
