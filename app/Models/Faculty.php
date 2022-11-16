<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';
    protected $fillable = [
        'faculty_name',
        'study_program_id'
    ];

    public $timestamps = false;

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
