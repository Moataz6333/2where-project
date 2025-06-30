<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable=[
        'place_id',
        'hotel_id',
        'plan_id',
        'rest_id',
        'sum',
        'counts',
        'ave',
    ];
}
