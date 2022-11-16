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
        'study_name'
    ];

    public function faculty()
    {
        return $this->hasMany(Faculty::class);
    }
}
