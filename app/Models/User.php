<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity, CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function librarian()
    {
        return $this->hasOne(Librarian::class);
    }

    public function BorrowTransaction()
    {
        return $this->hasMany(BorrowTransaction::class);
    }

    public function adminlte_profile_url()
    {
        if (Auth::user()->hasRole('petugas')) {
            return 'admin/profile';
        } else if (Auth::user()->hasRole('super-admin')) {
            return 'super-admin/settings';
        } else {
            return 'profile';
        }
    }

    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()
            ->useLogName($this->table)
            ->logFillable();
    }
}
