<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Event extends Model
{
    use HasFactory, LogsActivity, CausesActivity;

    protected $table = 'events';
    protected $fillable = [
        'event_name',
        'event_description',
        'event_start_date',
        'event_end_date',
    ];

    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Master ' . $this->table)
            ->logFillable();
    }
}
