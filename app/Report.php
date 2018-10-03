<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'rate','date','text','student_id','is_daily','title'
    ];
}
