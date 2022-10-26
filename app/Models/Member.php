<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'member_name',
        'member_code',
        'gender',
        'phone_number',
        'address'
    ];
}
