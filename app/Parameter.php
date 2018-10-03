<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $fillable = [
        'request_doc_id','name','type','position','required','description'
    ];
}
