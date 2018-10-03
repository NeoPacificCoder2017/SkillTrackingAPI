<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDoc extends Model
{
    protected $fillable = [
        'title','url','method','response','description','user_type_id'
    ];
}
