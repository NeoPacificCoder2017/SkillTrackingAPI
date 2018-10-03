<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'id',
        'room_id',
        'module_id',
        'date_start_at',
        'date_end_at',
        'time_start_at',
        'time_end_at',
    ];
}
