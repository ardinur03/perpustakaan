<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Member extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'members';
    protected static $logName = 'members';

    protected $fillable = [
        'member_name',
        'member_code',
        'gender',
        'phone_number',
        'address'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('members')
            ->logFillable();
        // ->logOnly(['name', 'description']);
        // Chain fluent methods for configuration options
    }
}
