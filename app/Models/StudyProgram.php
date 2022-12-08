<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;
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
}
