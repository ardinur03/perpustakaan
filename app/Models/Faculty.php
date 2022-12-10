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
    ];

    public $timestamps = false;

    public function studyPrograms()
    {
        return $this->hasMany(StudyProgram::class);
    }
}
