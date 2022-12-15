<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Librarian extends Model
{
    use HasFactory, LogsActivity, CausesActivity;
    protected $table = 'librarians';
    protected $fillable = [
        'librarian_name',
        'position',
        'gender',
        'phone_number',
        'address'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Master ' . $this->table)
            ->logFillable();
    }
}
