<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StudyProgram extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'study_programs';
    public $timestamps = false;
    protected $fillable = [
        'faculty_id',
        'study_name'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Master ' . str_replace('_', ' ', $this->table))
            ->logFillable();
    }
}
