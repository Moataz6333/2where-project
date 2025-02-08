<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessability extends Model
{
    use HasFactory;
    protected $fillable=[
        'place_id',
        'description',
        'ramps',
        'elevators',
        'facilities',

    ];
}
