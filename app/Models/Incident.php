<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'title',
        'type',
        'location',
        'lat',
        'lng',
        'status',
    ];
}