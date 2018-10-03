<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportComment extends Model
{
    protected $fillable = [
        'text','user_id','report_id'
    ];
}
