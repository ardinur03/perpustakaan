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
        'user_id',
        'faculty_id',
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
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
