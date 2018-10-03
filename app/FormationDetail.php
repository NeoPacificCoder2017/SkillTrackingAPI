<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormationDetail extends Model
{
    protected $fillable = [
        'formation_id', 'module_id', 'formateur_id'
    ];
}
