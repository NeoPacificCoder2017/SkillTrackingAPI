<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Module extends Model
{
    protected $fillable = [
        'name', 'total_hours', 'color', 'code'
    ];
}

