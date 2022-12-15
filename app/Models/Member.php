<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Member extends Model
{
    use HasFactory, LogsActivity, CausesActivity;

    protected $table = 'members';
    protected static $logName = 'members';

    protected $fillable = [
        'member_name',
        'user_id',
        'study_program_id',
        'member_code',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
